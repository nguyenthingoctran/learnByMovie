@include('template.top')
@include('template.menu_small')
 	<div id="area-check">
		<div id="video">
			<h2>
				{{$movie->movie_name_1}} - Tập: {{$movie->epi_name}}<br>
				<a id="openVideo" class="{{$wrongData->episodes_id}}">
					<span class="glyphicon glyphicon-play-circle"></span>
				</a>

			<div class="audio">
				<audio src='{{asset('public/sound/Correct Answer Sound Effect.mp3')}}' controls='controls' autoplay/>
			</div>
			</h2>			
		</div>
		
		<div id="practice">
			<h2 class="titleH2">Hãy luyện tập lại những câu bạn đã làm sai nhé</h2>
			<div class="onlyWrong">
				@foreach($sentence as $valueS)
					@if($valueS->numOrder == $wrongData->numOrderWrong)
						<form action="{{url('lbm_admin/sentence/wrongSen/'.$wrongData->episodes_id.'/'.$wrongData->numOrderWrong.'')}}" method="post">
							<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
							<div class="sttWrong">
								<span id="numOrderWrong">{{$valueS->numOrder}}</span>
							</div>
							<div class="textEnterWrong">
								<p id="enRight">{{$valueS->vietnamese}}</p>
								<input id="practiceEN" name="txtwrong" type="text" placeholder="Hãy nhập câu English đúng" autocomplete="off">
								@include('errors.error-wrong-sentence')
							</div>
							<div class="actionWrong">
								<input type="submit" value="Xong" id="xongWrong">
								<p class="soCauSaiConLai">Còn {{$soCauSaiConLai}} câu sai nữa!!!</p>
							</div>
							<br><p>Lưu ý: Bạn hãy luyện tập tính cẩn thận bằng cách viết hoa chữ cái cần thiết hoặc thêm chấm câu hay các dấu câu khác như mẫu câu Tiếng Việt khi hoàn thành kết quả nhé.</p>
						</form>
					@endif
				@endforeach
				
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