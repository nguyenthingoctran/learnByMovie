<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;



use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Http\Requests\DeleUserRequest;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\SearchRequest;
use Auth;
use File;


use App\User;
use DateTime;
use DB;
use App\Lib\Library;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::select('id','img','name','email','updated_at','level')
        ->where('id','<>',3)
        ->orderBy('id', 'desc')
        ->paginate(10);
        return view('lbm_admin.users.list_user')->with('dataUser', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lbm_admin.users.add_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User;
        $user->name = $request->txtname;
        $user->email = $request->txtemail;
        $user->password = bcrypt($request->txtpass);
        $user->remember_token = $request->_token;
        $user->created_at = new DateTime();
        $user->level = $request->level;
        $file = $request->file('myFile');
        if(strlen($file) > 0){
            $filename = $file->getClientOriginalName();
            $destinationPath = 'public/upload/avatar';
            $file->move($destinationPath,$filename);
            $user->img = $filename;
        }
        $user->save();
        return redirect()->route('listUser');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('lbm_admin.users.editProfile');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EditProfileRequest $request)
    {
        $user = User::find(Auth::user()->id);

        if(strlen($request->file('myFile')) > 0 && $request->txtpass == ''){
            $user->name = $request->txtname;
            $user->email=$request->txtemail;
            $user->remember_token = $request->_token;
            $user->updated_at = new DateTime;
            File::delete('public/upload/avatar/'.Auth::user()->img);
            $file = $request->file('myFile');
            if(strlen($file) > 0){
                $filename = Addslashes($file->getClientOriginalName());
                $destinationPath = 'public/upload/avatar';
                $file->move($destinationPath,$filename);
                $user->img = $filename;
            }
            $user->update();
            return redirect()->route('listUser');
        }

        if(strlen($request->file('myFile')) == 0 && $request->txtpass){
            $user->name = $request->txtname;
            $user->email=$request->txtemail;
            $user->remember_token = $request->_token;
            $user->updated_at = new DateTime;
            $user->password = bcrypt($request->txtpass);
            $user->update();
            return redirect()->route('getLogin');
        }

        if(strlen($request->file('myFile')) > 0 && $request->txtpass){
            $user->name = $request->txtname;
            $user->email=$request->txtemail;
            $user->remember_token = $request->_token;
            $user->updated_at = new DateTime;
            $user->password = bcrypt($request->txtpass);
            File::delete('public/upload/avatar/'.Auth::user()->img);
            $file = $request->file('myFile');
                $filename = Addslashes($file->getClientOriginalName());
                $destinationPath = 'public/upload/avatar';
                $file->move($destinationPath,$filename);
                $user->img = $filename;
            $user->update();
            return redirect()->route('getLogin');
        }

        if(strlen($request->file('myFile')) == 0 && $request->txtpass==""){
            $user->name = $request->txtname;
            $user->email=$request->txtemail;
            $user->remember_token = $request->_token;
            $user->updated_at = new DateTime;
            $user->update();
            return redirect()->route('getLogin');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(SearchRequest $request)
    {
        $search= DB::table('users')->where('name','like','%'.$request->txtsearch.'%')->get();
        return view('lbm_admin.users.search')->with('search',$search);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyall(DeleUserRequest $request)
    {
        $user = User::whereIn('id',$request->check);
        $del = $user->get();
        foreach ($del as $value) {
            File::delete('public/upload/avatar/' . $value->img);
        }
        $user->delete();
        return redirect()->route('listUser');
    }

    public function dashboard(){

        $wrong = DB::table('user_episodes')->where('user_id','=',Auth::user()->id);
        $userWrong = $wrong->count();

        $sentence = DB::table('sentence')
        ->select('episodes_id','english','vietnamese','numOrder')
        ->where('vietnamese','=',"");

        $countS = $sentence->count();
        $getS = $sentence->get();

        $userSentence = DB::table('user_sentence')
        ->select('user_id','episodes_id','numOrder')
        ->where('user_id','=',Auth::user()->id);

        $getUserSentence = $userSentence->get();
        $countUS = $userSentence->count();

        foreach ($getS as $valueGS) {
            foreach ($getUserSentence as $valueGUS) {
                if($valueGS->episodes_id == $valueGUS->episodes_id && $valueGS->numOrder == $valueGUS->numOrder){
                    $eid = $valueGS->episodes_id;
                }
            }
        }

        if($countUS == 0){
            return redirect()->route('listFilm');
        }

        if($countS != 0){
            return view('lbm_admin.home.home_ask_check')
            ->withErrors("Bạn có $countS câu chưa kiểm duyệt")
            ->with('eid',$eid);
        }

        if($userWrong != 0){
            $wrongData = $wrong->first();
            $infoData = $wrong->first();
            $infoMovie = $infoData->episodes_id;
            $sentence = DB::table('sentence')->where('episodes_id','=',$infoMovie)->get();
            $soCauSaiConLai = $userWrong - 1;

            $movie = DB::table('movie')
            ->select('movie.movie_id','movie.movie_name_1','episodes.episodes_id','episodes.link','episodes.completed','episodes.epi_name')
            ->join('episodes','movie.movie_id','=','episodes.movie_id')
            ->where('episodes.episodes_id','=',$infoMovie)->first();

            return view('lbm_admin.sentence.wrong')->with([
                'movie'=>$movie,
                'sentence'=>$sentence,
                'wrongData'=>$wrongData,
                'soCauSaiConLai'=>$soCauSaiConLai
                ]);
        }else{
            $eid = Db::table('user_sentence')
            ->where('user_id','=',Auth::user()->id)
            ->orderBy('created_at',' desc')
            ->first();
            
            include(app_path() . '\Lib\getPreId.php');
            $prevEp = getPreId();

            return view('lbm_admin.home.home_completed_wrong')
            ->with(['eid'=> $eid->episodes_id,
                'prevEp' => $prevEp
                    ]);
        }
    }
}
