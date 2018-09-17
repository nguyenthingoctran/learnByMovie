<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\addKindRequest;
use App\Http\Requests\DeleUserRequest;
use App\Http\Requests\editKindRequest;
use App\Http\Requests\SearchRequest;
use DB;
use App\Kind;
use DateTime;

class KindController extends Controller
{
    public function listKind(){
    	$kind=DB::table('kinds')->get();
    	return view('lbm_admin.kind.list_kind')->with('kind',$kind);
    }

    public function addKind(){
    	return view('lbm_admin.kind.add_kind');
    }

    public function postAddKind(addKindRequest $request){
        DB::table('kinds')->insert(
            [
                'kind_name' => $request->txtname,
                'created_at' => new DateTime
            ]
        );
        return redirect()->route('listKind');
    }

    public function delKind(DeleUserRequest $request){
        Kind::whereIn('kind_id',$request->check)->delete();
    	return redirect()->route('listKind');
    }

    public function editKind($id){
    	$kind=DB::table('kinds')->where('kind_id','=', $id)->get();
    	return view('lbm_admin.kind.editKind')->with('kind',$kind);
    }

    public function postEditKind(editKindRequest $request,$id){
    	$kind=Db::table('kinds')->where('kind_id',$id)->update(
        	[
        		'kind_name' => $request->txtname,
        		'updated_at' => new DateTime
        	]
        );
        return redirect()->route('listKind');
    }

    public function search(SearchRequest $request){
        $kind=DB::table('kinds')->where('kind_name','LIKE','%'.$request->txtsearch.'%')->get();
        return view('lbm_admin.kind.search')->with('kind',$kind);
    }

}
