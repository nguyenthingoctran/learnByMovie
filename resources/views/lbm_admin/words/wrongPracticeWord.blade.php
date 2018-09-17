@extends('lbm_admin.master_list')

@section('list')
	<div id="practiceVocabolary">
		<h2>Sai rồi!!!</h2>
		<div class="audio">
			<audio src='{{asset('public/sound/Buzzer Wrong Answer - Gaming Sound Effect (HD).mp3')}}' controls='controls' autoplay/>
		</div>

		<p class="vietnamese_word">{{$vietnamese_words}}</p>		
		<p>Đáp án của bạn là: <b>{{$myAnswer}}</b></p>
		<p class="result">Đáp án đúng là: <b>{{$english_words}}</b></p>
		<input type="text" placeholder="Luyện tập vào đây">
		<a href="{{route('practiceWord')}}">Tôi đã hiểu</a>
	</div>
@stop