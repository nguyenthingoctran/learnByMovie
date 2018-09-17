@extends('lbm_admin.master')

@section('content')

<div class='wrap_add'>
	<div class='title_add'>
		<h2>Sửa phim</h2>
	</div>
	
	<div class='add_lbm'>
		<form action="" method='post' enctype="multipart/form-data">
			@include('errors.error-form')
			@foreach($film as $itemfilm)
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<label for="txtkind">Chọn thể loại phim</label> &nbsp;
					<select name="chooseKind" id="selectOption" >
						@if($kind != null)
								<option value="0">...</option>
							@foreach($kind as $itemkind)
								@if($itemfilm->kindId == $itemkind->kind_id)
									<option value="{{ $itemkind->kind_id }}" selected='selected'>{{ $itemkind->kind_name }}</option>
								@else 
									<option value="{{ $itemkind->kind_id }}">{{ $itemkind->kind_name }}</option>
								@endif
							@endforeach
						@endif
					</select>
					&nbsp;
			<a href="{{ route('addKind') }}"><span class='glyphicon glyphicon-plus-sign'></span></a>
			<br>
			<label for="txtname">Tên phim</label><br>
				<input type="text" name='txtname' placeholder="Nhập tên phim" value='{{$itemfilm->movie_name_1}}'><br>
			<label for="chosseAvatar">Chọn ảnh poster</label>
				<img src="{{ asset('public/upload/poster/'.$itemfilm->movie_poster.'') }}" alt="">
				<input name="myFile" type="file" >
			<span>(Tên ảnh không có dấu nhé bạn)</span><br>
			<input type="submit" value='Sửa'>

		@endforeach
		</form>
	</div>
	</div>
</div>


@stop