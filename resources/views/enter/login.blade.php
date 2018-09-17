<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('public/css/styles-login.css') }}">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="shortcut icon" href="{!! asset('public/pictures/favicon.png') !!}" type="image/png">	
	<title>Ngôn Ngữ Và Phim</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<div id='wrapper'>
		<div id='logo'>
			<img src="{!! asset('public/pictures/logoLearnByMovie.png') !!}" alt="">
		</div>
		<h2>Đăng nhập</h2>
		<div id='form'>
			<form action="" method='post'>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="text" name="txtname" placeholder="Nhập tên truy cập"><br>
				<input type="password" name="txtpass" placeholder="Nhập mật khẩu"><br>
				<input type="submit" value="vào thôi !!!">
			</form>
			@include('errors.error-form')
		</div>
		
	</div>
</body>
	<script src={!! asset('public/js/bootstrap.min.js') !!}></script>
</html>