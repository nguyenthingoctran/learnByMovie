@extends('lbm_admin.master')

@section('content')

<div class='wrap_add'>
	<div class='title_add'>
		<h2>Chỉnh sửa thông  tin cá nhân</h2>
	</div>
	
	<div class='add_lbm'>
		<form action="" method='post' enctype="multipart/form-data">
			@include('errors.error-form')
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<label for="txtname">Tên người dùng</label><br><input type="text" name='txtname' placeholder="Nhập tên người dùng" value='{{Auth::user()->name}}'><br>
			<label for="txtemail">Email</label><br><input type="text" name='txtemail' placeholder="Nhập email" value='{{ Auth::user()->email }}' ><br>
			<label for="txtpass">Mật khẩu</label><br><input type="password" name='txtpass' placeholder='Nhập mật khẩu mới'><br>
			<label for="txtrepass">Nhập lại mật khẩu</label><br><input type="password" name='txtrepass' placeholder='Nhập lại mật khẩu mới'><br>
			<label for="chosseAvatar">Chọn ảnh đại diện</label> 
			<img src="{{ asset('public/upload/avatar/'.Auth::user()->img.'') }}" alt="avatar"> <br>
			<span>(Tên hình ảnh không có dấu nhé bạn)</span>
			 <input name="myFile" type="file" value=''><br>
			<input type="submit" value='Sửa'>
		</form>
	</div>
</div>

@stop