@extends('lbm_admin.master')

@section('content')
	<div class='learn_wrapper'>

		@foreach($dataFilm as $itemDataFilm)

			@if($itemDataFilm->completed != 2)
				<div class="alert alert-info">
				  <strong>Nhắc nhớ:</strong> Hãy luyện nghe lại video cũ trước khi học bài mới nhé.
				</div>
			@endif

			<h2><a href="{{url('lbm_admin/film/detail/'.$itemDataFilm->movie_id.'')}}">{{$itemDataFilm->movie_name_1}}</a> tập {{$itemDataFilm->epi_name}} </h2>
			<div class='video_and_control'>
				<video controls >
				  <source src="{{asset('public/upload/movie/'.$itemDataFilm->link.'')}}">
				Your browser does not support the video tag.
				</video>
				@if($itemDataFilm->completed == 2)
					<div class="cheVietsub">Listen</div>	
				@endif			
			</div>

			@if($itemDataFilm->completed != 2)
				<div class="action-learn">
					<a href="{{url('lbm_admin/episodes/learn/'.$getIdEC.'')}}">Tiếp tục bài học</a>
				</div>
			@endif

			@if($itemDataFilm->completed == 2)			
				<div class='learn_area'>
					<div class="soTT"><h3>{{ ++$numOrder}}</h3></div>
					<div class="form_text">
						<input type="hidden" id="BlockOrNone" class="{{$itemDataFilm->completed}}">
						<div class="enter_your_code"><textarea placeholder="Bạn hãy nhập câu nghe được theo số thứ tự ở trên" id="english"></textarea></div> 
						<input type="hidden" value="{{$itemDataFilm->episodes_id}}" id="eid">
						<input type="submit" value="Xong" id="xong">
					</div>			
				</div>

			@endif

		@endforeach
	</div>
	<script>
		var url = '{{route('insert')}}';
	</script>
@stop

@section('right')
	<h4 class="older">
		<div class="added">Số câu đã thêm: {{$countSen}} 
			<a href="{{url('lbm_admin/sentence/listSen/'.$dataFilmFirst->movie_id.'/'.$dataFilmFirst->episodes_id.'')}}" class="list-sentence"><span class="glyphicon glyphicon-th-list"></span></a>
		</div>
		<div class="oldSen">
			@foreach($getSentense as $valueGS)
				<p>{{$valueGS->english}}</p>
			@endforeach
		</div>
	</h4>
	<h4 class="older">
		<div class="added">Mới nhất - <span class="amount">{{$countNSNV}}</span></div>
		<div class="senNotVi">
			@foreach($getNSNV as $valueGNSNV)
				{{$valueGNSNV->numOrder}}. {{$valueGNSNV->english}} <br>
			@endforeach
		</div>
		@foreach($dataFilm as $itemDataFilm)
			<div class="newSen"></div>
			<div class="check"><a class="check-a" href="{{url('lbm_admin/sentence/check/'.$itemDataFilm->episodes_id.'')}}">Kết thúc</a></div>
		@endforeach
		
	</h4>

@stop


