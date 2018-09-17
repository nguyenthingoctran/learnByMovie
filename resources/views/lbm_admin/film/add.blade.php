@extends('lbm_admin.master')

@section('content')

<div class='wrap_add'>
	<div class='title_add'>
		<h2>Thêm phim</h2>
	</div>
	
	<div class='add_lbm'>

		<form action="" method='post' enctype="multipart/form-data" id="form_add_kind">
			@include('errors.error-form')
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<label for="txtkind">Chọn thể loại phim</label> &nbsp;
					<select name="chooseKind" id="selectOption">
						@if($kind != null)
								<option value="0" selected='selected' class="chosseOption">...</option>
							@foreach($kind as $itemkind)
								<option value="{{ $itemkind->kind_id }}" class="chosseOption">{{ $itemkind->kind_name }}</option>
							@endforeach
						@endif
					</select>
					&nbsp;


			<a href="#" id="addKind"><span class='glyphicon glyphicon-plus-sign' id="addKind"></span></a>
			<br>

	<div class="no_show">
			<label for="txtname">Tên phim</label><br>
			<input type="text" name='txtname' placeholder="Nhập tên phim" value='{{ old('txtname') }}'><br>

			<label for="EnGoc">Thêm văn bản Tiếng Anh gốc</label>
			<textarea name="ckeditor" id="" cols="30" rows="10"></textarea><br>
			<script src="{{asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
			<script>
			    CKEDITOR.replace( 'ckeditor' );
			</script>


			<label for="chosseAvatar">Chọn ảnh poster</label>
				<input name="myFile" type="file" value='{{ old('myFile') }}'>
			<span>(Tên ảnh không có dấu nhé bạn)</span><br>
			<input type="submit" value='Thêm'>
	</div>		
		</form>


	 
	<div class="div_add_kind">
		<label for="enter_kind">Nhập tên thể loại muốn thêm</label>
		<input type="text" id="text_name_kind" >
		<button id="xong_add_kind">Xong</button>
	</div>


			<script>
				var url = '{{route('addKindFromFilm')}}';
			</script>

	</div>
	
	</div>

</div>

@stop

