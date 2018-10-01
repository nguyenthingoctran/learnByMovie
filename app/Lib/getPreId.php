<?php
function getPreId(){
	  $useGetQualityEpOfUser = DB::table('user_sentence')
	  ->where('user_id',Auth::user()->id);

	  $getUGQEOU = $useGetQualityEpOfUser->select('episodes_id')->orderBy('created_at','desc')->get();
	  $arrayEid = [];
	  foreach ($getUGQEOU as $value) {
	    array_push($arrayEid, $value->episodes_id);

	  }
	  $uniqueValue = array_unique($arrayEid); //Mảng danh sách id của các tập phim mà người dùng đã học
	  $delUV = array_shift($uniqueValue); //Xóa phần tử đầu tiên
	  if($uniqueValue != null){
	    return $prevEp = $uniqueValue[0];//id của tập phim cũ vừa mới học xong
	  }else{
	    return $prevEp = null;
	  }
}
?>