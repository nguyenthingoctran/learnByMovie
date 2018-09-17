<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\WrongSentenceRequest;
use App\Http\Requests\EditEnRequest;
use App\Http\Requests\DeleUserRequest;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use DateTime;

class SentenceController extends Controller
{
    public function check($eid){
    	$sentence = DB::table('sentence')->where('episodes_id','=',$eid)
    	->where('vietnamese','=','')->get();
    	$episodes = DB::table('episodes')->where('episodes_id','=',$eid)->first();
    	$englishFile = DB::table('episodes')->join('movie', 'episodes.movie_id','=','movie.movie_id')->first();
    	return view('lbm_admin.sentence.check')->with(['episodes' => $episodes,
    		'sentence' => $sentence,
    		'englishFile' => $englishFile]);
    }


    public function wrongSen(WrongSentenceRequest $request, $eid, $now){
        $enRight = DB::table('sentence')
        ->where([
            ['episodes_id','=',$eid],
            ['numOrder','=',$now]
        ])->first();

        $strWrong = trim($request->txtwrong);
        $strWdelDoc = chop($strWrong,".");
        $strenRight = chop($enRight->english,".");

        if(strcasecmp($strWdelDoc,$strenRight) == 0){
            $del = DB::table('user_episodes')
            ->where('user_id','=',Auth::user()->id)
            ->limit(1)->delete();
            return redirect()->route('dashboard');

        }else{
            $del = DB::table('user_episodes')
            ->where('user_id','=',Auth::user()->id)
            ->limit(1)->delete();

            $insert = DB::table('user_episodes')
            ->insert([
                'episodes_id' => $eid,
                'user_id' => Auth::user()->id,
                'created_at' => new DateTime,
                'numOrderWrong' => $now
            ]);

            $movie = DB::table('movie')
            ->select('movie.movie_id','movie.movie_name_1','epi_name')
            ->join('episodes','movie.movie_id','=','episodes.movie_id')
            ->where('episodes.episodes_id','=',$eid)
            ->first();

            $soCauSaiConLai = DB::table('user_episodes')
            ->where('user_id','=',Auth::user()->id)
            ->count();



            return view('lbm_admin.sentence.resultWrong')->with([
                'movie'=>$movie,
                'enRight'=>$enRight,
                'soCauSaiConLai'=>$soCauSaiConLai,
                'yourAnswer' => $request->txtwrong
            ]);
        }
    }

    public function videoPage($eid){
        $movie = Db::table('movie')
        ->select('movie.movie_id','movie.movie_name_1','episodes.episodes_id','episodes.link','episodes.epi_name')
        ->join('episodes','movie.movie_id','=','episodes.movie_id')
        ->where('episodes.episodes_id','=',$eid)
        ->first();

        return view('lbm_admin.sentence.videoPage')->with([
            'movie' => $movie
        ]);
    }

    public function editFileInCheck(EditEnRequest $request, $mid){
        DB::table('movie')->where('movie_id','=',$mid)
        ->update([
            'fileEnglish' => $request->input('txtEditEn'),
            'movie_updated_at' => new DateTime
        ]);
        return redirect()->route('dashboard');
    }

    public function listSen($mid,$eid){

        $movie = DB::table('movie')
        ->select('movie_id','movie_name_1')
        ->where('movie_id','=',$mid)->first();

        $episodes = DB::table('episodes')->where('episodes_id','=',$eid)->first();

        $sentence = DB::table('sentence')
        ->where('episodes_id','=',$eid)
        ->orderBy('numOrder','desc')->get();

        return view('lbm_admin.sentence.listSen')->with([
            'movie' => $movie,
            'episodes' => $episodes,
            'sentence' => $sentence
        ]);
    }

}
