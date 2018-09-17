@include('template.top')
@include('template.menu_small')
 	<div id="area-check">
 		
		<div id="video">
			<h2>
				{{$movie->movie_name_1}} - Tập: {{$movie->epi_name}}
			</h2>	
	
			<div class="audio"><audio src='{{asset('public/sound/Buzzer Wrong Answer - Gaming Sound Effect (HD).mp3')}}' controls='controls' autoplay/></div>

		</div>
		
		<div id="practice">
			<h2 class="titleH2">Không đúng rồi!!!</h2>
			<div class="onlyWrong">
				<div class="sttWrong">
					<span id="numOrderWrong">{{$enRight->numOrder}}</span>
				</div>
				<div class="textEnterWrong">
					<p id="enRight">{{$enRight->vietnamese}}</p>
					<p id="enRight">Đáp án của bạn là: <b>{{$yourAnswer}}</b></p>
					<p id="enRight">Đáp án đúng là: <b>{{$enRight->english}}</b></p>
					<div id="divPractice">
						<textarea id="practiceWrong" placeholder="Luyện tập lại cho nhớ nhé!!!" autocomplete="off"></textarea>
					</div>
				</div>
				<div class="actionWrong">
					<a id="iGotDid" href="{{route('dashboard')}}">Tôi đã hiểu</a>
					<p class="soCauSaiConLai">Còn {{$soCauSaiConLai}} câu sai nữa!!!</p>
				</div>
			</div>
			
		</div>

	</div>

	<script>
			
	</script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="{{asset('public/js/myscript.js')}}"></script>

</body>
</html>