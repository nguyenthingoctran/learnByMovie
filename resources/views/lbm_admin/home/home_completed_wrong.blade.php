@extends('lbm_admin.master')


@section('content')
	<div>
		@include('errors.message_success')
	</div>
	<div id="action-home">
		<a href="{{url("lbm_admin/episodes/learn/$eid")}}" class="continues">Tiếp tục bài học</a>
		<a href="{{route('practiceWord')}}" class="continues">Luyện tập từ vựng</a>
	</div>
@stop