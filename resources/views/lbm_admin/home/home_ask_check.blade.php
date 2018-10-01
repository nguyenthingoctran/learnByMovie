@extends('lbm_admin.master')


@section('content')
	<div id="action-home">
		<a href="{{url("lbm_admin/sentence/check/$eid")}}" class="continues">Đi đến kiểm duyệt</a>
		<a href="{{url("lbm_admin/episodes/learn/$eid")}}" class="continues">Tiếp tục bài học</a>
	</div>
@stop