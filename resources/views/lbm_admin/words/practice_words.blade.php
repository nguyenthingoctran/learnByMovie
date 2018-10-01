@extends('lbm_admin.master_list')

@section('list')
	<div id="practiceVocabolary">
		<h2>Luyện tập từ vựng</h2>
		<div class="audio">
			<audio src='{{asset('public/sound/Correct Answer Sound Effect.mp3')}}' controls='controls' autoplay/>
		</div>

		<p class="vietnamese_word">{{$vocabulary->vietnamese_words}} <span class="times-word">{{$vocabulary->times}}</span></p>
		
		<form action="{{route('checkVocabulary')}}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="vietnamese_words" value="{{$vocabulary->vietnamese_words}}">
			<input type="text" name="txtVocabulary" placeholder="Nhập đáp án của bạn ở đây" autocomplete="off">
			@include('errors.error-form')
			<input type="submit" value="Xong">
		</form>
		<p class="amount">Bạn có {{$countV}} từ cần học.</p>
	</div>
@stop