@include('template.top')
@include('template.menu_small')
	<div id="area-check">
		<div id="video-check">
			<video controls>
			  <source src="{{asset('public/upload/movie/'.$episodes->link.'')}}" >
			Your browser does not support the video tag.
			</video>
		</div>
		<div id="updated-sentense">
			<h2 class="titleH2">Danh sách các câu chưa được kiểm duyệt</h2>
			<ul class="listSenNeedCheck">
				@foreach($sentence as $valueS)
					<li>
						<div class="stt">
							<span id="numOrder">{{$valueS->numOrder}}</span>
						</div>
						<div class="textEnter">
							<p id="enRight">{{$valueS->english}}</p>
							<p id="viet"></p>
							<input id="enterEnRight" type="text" placeholder="Hãy nhập câu English đúng">
							<input id="enterVi" type="text" name="txtvi" placeholder="Hãy nhập câu Tiếng Việt tương ứng">
						</div>
						<div class="action">
							<input type="hidden" id="eid" value="{{$valueS->episodes_id}}">
							<button type="button" id="right" class="{{$valueS->numOrder}}"><span class="glyphicon glyphicon-thumbs-up"></span></button>
							<button type="button" id="wrong" class="{{$valueS->numOrder}}"><span class="glyphicon glyphicon-thumbs-down"></span></button>
							<button type="button" id="doneEnterEn" class="{{$valueS->numOrder}}">Xong</button>
	
							<button type="button" id="edit" class="{{$valueS->numOrder}}"><span class="glyphicon glyphicon-pencil"></span></button>
							<button type="button" id="doneCheck" class="{{$valueS->numOrder}}">Duyệt</button>
						</div>
					</li>
				@endforeach
			</ul>
			
		</div>
		<form action="{{url('lbm_admin/sentence/editFileInCheck/'.$englishFile->movie_id.'')}}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div id="engsub">
				<h2 class="titleH2">Bản English gốc</h2>
				<textarea name="txtEditEn" id="enfile">{!!$englishFile->fileEnglish!!}</textarea>
				<script src="{{asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
				<script>
				    CKEDITOR.replace( 'txtEditEn' );
				</script>
				@include('errors.error-form')
			</div>
			
			
			
			<div id="completed">
				
				<input type="submit" id="hoanTat" value="Hãy chỉnh sửa bản Enlish gốc và nhấn vào đây để hoàn thành quá trình kiểm duyệt" />				
			</div>
		</form>
	</div>

	<script>
			var url = '{{route('enRight')}}';
			var wrong = '{{route('wrong')}}';
	</script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="{{asset('public/js/myscript.js')}}"></script>

</body>
</html>