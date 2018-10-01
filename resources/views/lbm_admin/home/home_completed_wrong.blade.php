@extends('lbm_admin.master')

@section('content')
	<div id="action-home">
		@if($prevEp == 'null')
			<a href="{{url("lbm_admin/episodes/learn/$eid")}}" class="continues">Tiếp tục bài học</a>
		@else
			<a href="{{url("lbm_admin/episodes/learn/$prevEp")}}" class="continues">Tiếp tục bài học</a>
		@endif
		<a href="{{route('practiceWord')}}" class="continues">Luyện tập từ vựng</a>
	</div>
@stop