<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CheckVocabulary;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use DateTime;

class VocabularyController extends Controller
{
    public function listVocabulary(){
    	$vocabulary = DB::table('vocabulary')
    	->where('user_id','=',Auth::user()->id)
    	->orderBy('created_at','desc')
    	->get();
    	return view('lbm_admin.words.list_words')->with('vocabulary',$vocabulary);
    }

    public function practiceWord(){
        
       
    	$vocab = DB::table('vocabulary')->where('user_id','=',Auth::user()->id);

    	$vocabulary = $vocab->first();
    	$countV = $vocab->count();

    	if($countV > 0 ){
	    	return view('lbm_admin.words.practice_words')->with([
	    		'vocabulary' => $vocabulary,
	    		'countV' => $countV
	    	]);
    	}else{
    		return view('lbm_admin.home.home_messages')->withErrors('Không có từ nào cả!');
    	}

    }

    public function checkVocabulary(CheckVocabulary $request){
    	$vocab = DB::table('vocabulary')
    	->where([
    		['user_id','=',Auth::user()->id],
    		['vietnamese_words','=',$request->vietnamese_words]
    	]);
    	$vocabulary = $vocab->first();
    	if(strcasecmp($request->txtVocabulary, $vocabulary->english_words)==0){
    		$time = $vocabulary->times;
    		$time++;
    		if($time < 4){
				DB::table('vocabulary')->insert(
				    [
				    	'user_id' => Auth::user()->id,
				    	'english_words' => $vocabulary->english_words,
				    	'vietnamese_words' => $vocabulary->vietnamese_words,
				    	'created_at' => new DateTime,
				    	'times' => $time
				    ]
				);
				$vocab->delete();
				return redirect()->route('practiceWord');
    		}else{
    			$vocab->delete();
    			return redirect()->route('practiceWord');
    		}
    	}else{
    		$time = $vocabulary->times;
				DB::table('vocabulary')->insert(
				    [
				    	'user_id' => Auth::user()->id,
				    	'english_words' => $vocabulary->english_words,
				    	'vietnamese_words' => $vocabulary->vietnamese_words,
				    	'updated_at' => new DateTime,
				    	'times' => $time
				    ]
				);
				$vocab->delete();
				return view('lbm_admin.words.wrongPracticeWord')->with([
					'english_words' => $vocabulary->english_words,
					'vietnamese_words' => $vocabulary->vietnamese_words,
					'myAnswer' => $request->txtVocabulary
				]);
    	}
    }
}
