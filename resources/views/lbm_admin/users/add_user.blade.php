@extends('lbm_admin.master')

@section('content')

<div class='wrap_add'>
	<div class='title_add'>
		<h2>Thêm thành viên</h2>
	</div>
	
	<div class='add_lbm'>
		<form action="" method='post' enctype="multipart/form-data">
			@include('errors.error-form')
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<label for="txtname">Tên người dùng</label><br><input type="text" name='txtname' placeholder="Nhập tên người dùng" value='{{ old('txtname') }}'><br>
			<label for="txtemail">Email</label><br><input type="text" name='txtemail' placeholder="Nhập email" value='{{ old('txtemail') }}' ><br>
			<label for="txtpass">Mật khẩu</label><br><input type="password" name='txtpass' placeholder='Nhập mật khẩu'><br>
			<label for="txtrepass">Nhập lại mật khẩu</label><br><input type="password" name='txtrepass' placeholder='Nhập lại mật khẩu'><br>
			<label for="capbac">Cấp bậc</label> <input type="radio" name='level' value='1'>Quản trị
												<input type="radio" name='level' value='2' checked="checked">Thành viên <br>
			<label for="chosseAvatar">Chọn ảnh đại diện</label> <input name="myFile" type="file" value='{{ old('myFile') }}'>
			<span>(Tên ảnh không có dấu nhé bạn)</span><br>
			<input type="submit" value='Thêm'>
		</form>
	</div>
</div>

@stop