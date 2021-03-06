@extends('lbm_admin.master')

@section('content')
<div class='wrap_add'>
	<div class='title_add'>
		@foreach($episodes as $itemEp)
		<h2>Thêm tập cho phim "<span class='move_name_add'>{{$itemEp->movie_name_1}}"</span></h2>
		@endforeach
	</div>
	
	<div class='add_lbm'>
		<form action="" method='post' enctype="multipart/form-data">
			@include('errors.error-form')
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<label for="name_ep">Tập</label>
			<input type="text" name='name_ep' placeholder="Tập mấy?" value="{{old('name_ep')}}">
			<label for="chosseAvatar">Chọn ảnh</label>
				<input name="myFile" type="file" value='{{ old('myFile') }}'>
			<span>(Tên ảnh không có dấu nhé bạn)</span><br>

			<label for="chooseVideo">Chọn video</label>
				<input name="myVideo" type='file'>
			<span>(Tên video không có dấu nhé bạn)</span><br>

			<input type="submit" value='Thêm'>
		</form>
	</div>		
</div>
@stop

@section('right')
	@foreach($episodes as $itemEp)
		<p class='title_list_ep'>danh sách phim: <span>{{$itemEp->movie_name_1}}</span></p>
	@endforeach

	<p class='total'>Tổng số tập: {{$total}}</p>
		@foreach($list_ep as $itemList)
			<div class='list_ep'>
				<img src="{{asset('public/upload/img_ep/'.$itemList->episodes_img.'')}}" alt="">
				<span class='name_ep'>Tập {{$itemList->epi_name}}</span><br>
				@foreach($mangPB as $keyMPB => $itemMPB)
					@if($itemList->episodes_id == $keyMPB)
						<span>{{$itemMPB}} câu</span><br>
					@endif
				@endforeach
			</div>
		@endforeach


@stop


