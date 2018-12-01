<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\EpisodesAddRequest;
use App\Http\Requests\EditEpisodesRequest;
use App\Http\Controllers\Controller;
use DB;
use DateTime;
use File;
use Auth;

class EpisodesController extends Controller
{
    public function getAdd($id){
    	$episodes= db::table('movie')->where('movie_id','=',$id)->get();
    	$total=db::table('episodes')->where('movie_id','=',$id)->count();
    	$list_ep = db::table('episodes')->where('movie_id','=',$id)->orderBy('epi_name','desc')->get();
    	$senten=db::table('episodes')->join('sentence','episodes.episodes_id','=','sentence.episodes_id')->select('episodes.episodes_id')->get();

    	foreach($senten as $itemSen){
    		$arr[] = $itemSen->episodes_id; 
    	}
	    	$mangPhanBiet=array_count_values($arr);   	 		

    	return view('lbm_admin.episodes.add')->with(['episodes'=>$episodes,
    												 'total'=>$total,
    												 'list_ep'=>$list_ep,
    												 'senten'=>$senten,
    												 'mangPB' => $mangPhanBiet
    												]);
    }
    public function postAdd(EpisodesAddRequest $request,$id){
        $file = $request->file('myFile');
        if(strlen($file) > 0){
            $filename = $file->getClientOriginalName();
            $destinationPath = 'public/upload/img_ep';
            $file->move($destinationPath,$filename);
        }

        $file_video = $request->file('myVideo');
        if(strlen($file) > 0){
            $filename_video = $file_video->getClientOriginalName();
            $destinationPath = 'public/upload/movie';
            $file_video->move($destinationPath,$filename_video);
        }
  		DB::table('episodes')->insert(
		    [
		    	'movie_id' => $id,
		    	'episodes_img' => $filename,
		    	'link' => $filename_video,
		    	'episodes_created_at'=> new DateTime,
		    	'completed' => 2,
		    	'epi_name' => $request->name_ep
			]
		);
  		
  		return redirect()->back();
    }

    public function delEp($id){

    	$del=db::table('episodes')->where('episodes_id','=',$id);
    	$delEp = $del->get();
    	foreach($delEp as $itemEp){   	
	    	File::delete('public/upload/img_ep/'.$itemEp->episodes_img.'');
	    	File::delete('public/upload/movie/'.$itemEp->link.'');
	    }	
	    $del->delete();
    	return redirect()->back();
    }

    public function editEp($id){
    	$episodes= db::table('movie')
    	->join('episodes','movie.movie_id','=','episodes.movie_id')
    	->where('episodes.episodes_id','=',$id)
    	->get();
   
    	$senten=db::table('episodes')->join('sentence','episodes.episodes_id','=','sentence.episodes_id')->select('episodes.episodes_id')->get();
    	foreach($senten as $itemSen){
    		$arr[] = $itemSen->episodes_id; 
    	}
	    	$mangPhanBiet=array_count_values($arr);  

  		foreach($episodes as $itemEpisodes){
  			$idm=$itemEpisodes->movie_id;
  			$nameEp = $itemEpisodes->epi_name;
  		}

  		$total=db::table('episodes')->where('movie_id','=',$idm)->count();
    	$list_ep = db::table('episodes')->where('movie_id','=',$idm)->orderBy('epi_name','desc')->get();

    	return view('lbm_admin.episodes.edit')->with(['episodes'=> $episodes,
    												'total'=>$total,
    												'list_ep'=>$list_ep,
    												 'senten'=>$senten,
    												 'mangPB' => $mangPhanBiet,
    												 'idm' => $idm,
    												 'nameEp' => $nameEp,
    												 'id' => $id
       											]);
  		}

  	public function postEditEp(EditEpisodesRequest $request, $id, $idm, $nameEp){
  		$xoaFileCu=db::table('episodes')->where('movie_id','=',$idm)->where('episodes_id','=',$id)->get();

  		$get_name_ep = $request->name_ep;
        $file = $request->file('myFile');
        $file_video = $request->file('myVideo');


  		$episodes= db::table('episodes')
  		           ->where('movie_id','=',$idm)
  		           ->where('episodes_id','<>',$id)
  		           ->get();

  		foreach($episodes as $itemEpisodes){
  			if($itemEpisodes->epi_name == $get_name_ep){                    
  				return redirect()->back()->withErrors(['messages'=>'Tập '.$get_name_ep.' đã có, vui lòng nhập tập khác']);
  			}
  		}

        if(strlen($file) > 0 && strlen($file_video) == 0){

            foreach($xoaFileCu as $itemXoaFileCu){
            	File::delete('public/upload/img_ep/'.$itemXoaFileCu->episodes_img.'');
            }

            $filename = $file->getClientOriginalName();
            $destinationPath = 'public/upload/img_ep';
            $file->move($destinationPath,$filename);

  		DB::table('episodes')->where('episodes_id','=',$id)->update(
		    [
		    	'episodes_img' => $filename,
		    	'episodes_updated_at'=> new DateTime,
		    	'epi_name' => $get_name_ep
			]
		);   

  		return redirect()->route('detail', ['id' => $idm]);
        }

        if(strlen($file_video) > 0 && strlen($file) == 0){

            foreach($xoaFileCu as $itemXoaFileCu){
            	File::delete('public/upload/movie/'.$itemXoaFileCu->link.'');
            }

            $filename_video = $file_video->getClientOriginalName();
            $destinationPathVideo = 'public/upload/movie';
            $file_video->move($destinationPathVideo,$filename_video);

  		DB::table('episodes')->where('episodes_id','=',$id)->update(
		    [
		    	'episodes_updated_at'=> new DateTime,
		    	'epi_name' => $get_name_ep,
		    	'link' => $filename_video,

			]
		);
  		return redirect()->route('detail', ['id' => $idm]);
        }

        if(strlen($file) == 0 && strlen($file) == 0){
  		DB::table('episodes')->where('episodes_id','=',$id)->update(
		    [
		    	'episodes_updated_at'=> new DateTime,
		    	'epi_name' => $get_name_ep,

			]
		);
		return redirect()->route('detail', ['id' => $idm]);
        }

        if(strlen($file) > 0 && strlen($file) > 0){

            foreach($xoaFileCu as $itemXoaFileCu){
            	File::delete('public/upload/img_ep/'.$itemXoaFileCu->episodes_img.'');
            }
            foreach($xoaFileCu as $itemXoaFileCu){
            	File::delete('public/upload/movie/'.$itemXoaFileCu->link.'');
            }            

            $filename = $file->getClientOriginalName();
            $destinationPath = 'public/upload/img_ep';
            $file->move($destinationPath,$filename);

            $filename_video = $file_video->getClientOriginalName();
            $destinationPathVideo = 'public/upload/movie';
            $file_video->move($destinationPathVideo,$filename_video);

  		DB::table('episodes')->where('episodes_id','=',$id)->update(
		    [
		    	'episodes_updated_at'=> new DateTime,
		    	'epi_name' => $get_name_ep,
		    	'episodes_img' => $filename,
		    	'link' => $filename_video,
			]
		);
		return redirect()->route('detail', ['id' => $idm]);
        }
  	}

  	public function getLearn($ide){
  		$dataFilm=db::table('episodes')
      ->join('movie','episodes.movie_id','=','movie.movie_id')
      ->where('episodes.episodes_id','=',$ide)
      ->get();

      $dataSen=db::table('sentence')
      ->where([['episodes_id','=',$ide],
                ['vietnamese','<>','']]);
      $countSen = $dataSen->count();

      $mountSen = DB::table('sentence')->where('episodes_id','=',$ide);
      $allSen=$mountSen->orderBy('numOrder','desc')->first();

      if(isset($allSen)){
        $numOrder=$allSen->numOrder;
      }else{
        $numOrder=0;
      }

      $getSentense = db::table('sentence')
      ->select('english')
      ->where([['episodes_id','=',$ide],
                ['vietnamese','<>','']])
      ->orderBy('numOrder','asc')
      ->get();

      $dataFilmFirst = db::table('episodes')->where('episodes_id','=',$ide)->first();

      $newSenNotVi = DB::table('sentence')->where([
        ['episodes_id','=',$ide],
        ['vietnamese','=','']
      ]);

      $countNSNV = $newSenNotVi->count();
      $getNSNV = $newSenNotVi->get();
      
      //Hàm lấy id của tập trước
      include(app_path() . '/Lib/getPreId.php');
      $prevEp = getPreId();

      $EpCurrent = DB::table('user_sentence')
      ->where('user_id',Auth::user()->id)
      ->orderBy('created_at','desc')
      ->first();
      $getIdEC = $EpCurrent->episodes_id;

        return view('lbm_admin/episodes/learn')->with([
          'dataFilm'=>$dataFilm,
          'countSen'=>$countSen,
          'numOrder'=>$numOrder,
          'getSentense'=>$getSentense,
          'dataFilmFirst' => $dataFilmFirst,
          'countNSNV' => $countNSNV,
          'getNSNV' => $getNSNV,
          'prevEp' => $prevEp,
          'getIdEC' => $getIdEC
        ]);
  	}

}


