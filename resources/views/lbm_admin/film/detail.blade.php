@extends('lbm_admin.master_list')

@section('detail')
	@foreach($detail as $itemDetail)
	<div class='wrapper_detail'>
		<div class='introduce'>
			<img src="{{asset('public/upload/poster/'.$itemDetail->movie_poster.'')}}" alt="">
			<div class='detail'>
				<h1>{{$itemDetail->movie_name_1}}</h1>
				<label for="">Thể loại:&nbsp;</label><span>{{$itemDetail->kind_name}}</span><br>
				<label for="">Ngày thêm:&nbsp;</label><span>{{substr($itemDetail->movie_created_at,0,10)}}</span><br>
				<label for="">Số lượng câu:&nbsp;</label><span>{{$senten}}</span><br>
				<label for="">Số lượng người học:&nbsp;</label><span>???</span>
			</div>
			<div class='add_ep'><a href="{{url('lbm_admin/episodes/addEp/'.$itemDetail->movie_id.'')}}">Thêm tập phim</a></div>
			<div class='add_ep'><a id="editEnFile" href="#">Sửa bản Tiếng Anh gốc</a></div>
			
			<div id="errors-en">@include('errors.error-form')</div>
			
			<div class="editEn">
				<form action="{{url('lbm_admin/film/editEn/'.$itemDetail->movie_id.'')}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<textarea name="txtEditEn" id="">{{$itemDetail->fileEnglish}}</textarea>
					<script src="{{asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
					<script>
					    CKEDITOR.replace( 'txtEditEn' );
					</script>
					<button type="submit" id="btnEditEn">Xong</button>
				</form>
			</div>
		</div>
		
		<div class='episodes'>
			@foreach($epi as $itemEpi)
				<div class='epWhat'>
					<a href="{{url('lbm_admin/episodes/learn/'.$itemEpi->episodes_id.'')}}">
						<img src="{{asset('public/upload/img_ep/'.$itemEpi->episodes_img.'')}}" alt="">
					</a>
						<div class='epWhat-info'>
							<a href=""><p class='name_mov'>{{$itemDetail->movie_name_1}} - {{$itemEpi->epi_name}}</p></a>
					
							@if($itemEpi->completed == '1')
								<p class='done'>Đã hoàn thành</p>
							@else
								<p class='done'>Chưa hoàn thành</p>
							@endif
						<div class='act'>
							<input type="hidden" id="{{$itemDetail->movie_id}}" class="mid">
							<a href="{{url('lbm_admin/episodes/edit/'.$itemEpi->episodes_id.'')}}"><span class='glyphicon glyphicon-pencil'></span></a>
							<a id="{{$itemEpi->completed}}" class="lock_episodes"><span id="{{$itemEpi->episodes_id}}" class='glyphicon glyphicon-lock'></span></a>
							<a href="{{url('lbm_admin/episodes/delEp/'.$itemEpi->episodes_id.'')}}" onclick="return WannaDel()"><span class='glyphicon glyphicon-remove'></span></a>
						</div>
						</div>
				</div>
			@endforeach

		</div>
		@endforeach
		
		<script>
			var lockUrl = '{{route('lockEpisodes')}}';
		</script>

	</div>
@stop