<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="{{ asset('public/css/styles-video-page.css') }}">
	<link rel="stylesheet" href="">
</head>
<body>
	<div id="cotent-video">
		<h2>{{$movie->movie_name_1}} - Tập {{$movie->epi_name}}</h2>
		<video controls>
		  <source src="{{asset('public/upload/movie/'.$movie->link.'')}}" >
		  Your browser does not support HTML5 video.
		</video>
	</div>
</body>
</html>