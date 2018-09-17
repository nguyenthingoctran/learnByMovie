<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\FilmRequest;
use App\Http\Requests\DeleUserRequest;
use App\Http\Requests\EditFilmRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\EditEnRequest;
use App\Http\Controllers\Controller;
use App\Film;
use DB;
use DateTime;
use File;

class FilmController extends Controller
{
    public function listF(){
    	$film = DB::table('movie')->join('kinds','kinds.kind_id','=','movie.kindId')->orderBy('movie_id','desc')->get();


        $movie = DB::table('movie')->select('movie_id')->get();
        $episodes = DB::table('episodes')->select('movie_id')->get();
        foreach ($episodes as $itemEpi) {
            $countEp[] = $itemEpi->movie_id;
        }
        $arrayCountEpisodes = array_count_values($countEp);


        $moiveComplete = DB::table('episodes')->select('movie_id','completed')->get();
        foreach($moiveComplete as $MC){
            if($MC->completed == 1){
                $a1[$MC->movie_id] = 1; 
            }else{
                $a1[$MC->movie_id] = 2;
            }
        }

        foreach($movie as $itemMovie){
            foreach ($arrayCountEpisodes as $key => $ACE) {
                if($itemMovie->movie_id == $key ){
                    $movieNoEpisodes[$itemMovie->movie_id] = $ACE;
                    break;
                }else{
                    $movieNoEpisodes[$itemMovie->movie_id] = 0; 
                }  
            }

            foreach ($a1 as $keyA1 => $itemA1) {
                if($itemMovie->movie_id == $keyA1 && $itemA1 == 1){
                    $endMC[$itemMovie->movie_id] = "<span class='glyphicon glyphicon-ok'></span>";
                    break;
                }else{
                    $endMC[$itemMovie->movie_id] = "Chưa hoàn thành";
                }
            }
        }

    	return view('lbm_admin.film.list')->with([
                                                    'film' => $film,
                                                    'movieNoEpisodes' => $movieNoEpisodes,
                                                    'endMC' => $endMC
                                                 ]);
    }

    public function getadd(){
    	$kind=DB::table('kinds')->get();
    	return view('lbm_admin.film.add')->with('kind',$kind);
    }

    public function postAdd(FilmRequest $request){
        $file = $request->file('myFile');
        if(strlen($file) > 0){
            $filename = $file->getClientOriginalName();
            $destinationPath = 'public/upload/poster';
            $file->move($destinationPath,$filename);
        }
		DB::table('movie')->insert(
		    [
		    	'movie_name_1' => $request->txtname,
				'movie_poster' => $filename,
                'fileEnglish' => $request->input('ckeditor'),
				'kindId' => $request->chooseKind,
				'movie_created_at' => new DateTime
		 	]
		);
        return redirect()->route('listFilm');
    }

    public function delFilm(DeleUserRequest $request){
        $film=Film::whereIn('movie_id',$request->check);
    	$delUp=$film->get();
        foreach($delUp as $itemDelUp){
            File::delete('public/upload/poster/' . $itemDelUp->movie_poster);  
        }
        $film->delete();
        return redirect()->route('listFilm');   
    }

    public function editFilm($id){
    	$film=DB::table('movie')->where('movie_id',$id)->get();
    	$kind=DB::table('kinds')->get();
    	return view('lbm_admin.film.edit')->with(['kind'=> $kind, 'film'=>$film]);
    }

    public function posteditFilm(EditFilmRequest $request,$movie_id){

    	$movie=db::table('movie')->where('movie_id',$movie_id);
        $movie_del=$movie->get();

        $file = $request->file('myFile');
        if(strlen($file) > 0){
            foreach($movie_del as $itemMovie){
                File::delete('public/upload/poster/'.$itemMovie->movie_poster.'');
            }            
            $filename = $file->getClientOriginalName();
            $destinationPath = 'public/upload/poster';
            $file->move($destinationPath,$filename);
            $movie->update([
		    	'movie_name_1' => $request->txtname,
				'movie_poster' => $filename,
				'kindId' => $request->chooseKind,
				'movie_updated_at' => new DateTime
            ]);
            return redirect()->route('listFilm');
        }else{
            $movie->update([
		    	'movie_name_1' => $request->txtname,
				'kindId' => $request->chooseKind,
				'movie_updated_at' => new DateTime
            ]);
        }
        return redirect()->route('listFilm');
    }

    public function search(SearchRequest $request){
        $film=DB::table('movie')->join('kinds','kinds.kind_id','=','movie.kindId')->where('movie_name_1','LIKE','%'.$request->txtsearch.'%')->get();
        return view('lbm_admin.film.search')->with(['film'=>$film]);
    }

    public function detail($id){
        $detail=db::table('movie')
                ->join('kinds', 'kinds.kind_id', '=', 'movie.kindId')
                ->where('movie_id','=',$id)-> get();
     
        $sen = db::table('episodes')
        ->join('sentence', 'episodes.episodes_id', '=', 'sentence.episodes_id')
        ->where('episodes.movie_id','=',$id);
        $senten=$sen->count();

        $episodes = db::table('episodes')
        ->join('movie','episodes.movie_id','=','movie.movie_id')
        ->where('movie.movie_id','=',$id);
        
        $epi = $episodes->orderBy('episodes.episodes_id','desc')->get();
        return view('lbm_admin.film.detail')->with(['detail'=>$detail,
                                                    'senten'=>$senten,
                                                    'epi'=>$epi]);
    }

    public function editEn(EditEnRequest $request, $mid){
        DB::table('movie')->where('movie_id','=',$mid)
        ->update([
            'fileEnglish' => $request->txtEditEn
        ]);
        return redirect()->back();
    }
}
