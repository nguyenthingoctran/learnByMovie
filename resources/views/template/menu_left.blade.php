	<div id='middle'>
		<div class='left'>
			<div class='profile'>
				<img src="{!! asset('public/upload/avatar/'.Auth::user()->img.'') !!}" class="rounded-circle" alt="Avatar" >
				<p>{!! Auth::user()->name !!} <a href="{{ route('editProfile') }}"><span class="glyphicon glyphicon-chevron-down"></span></a></p>
				<div class='edit_profile'>
				</div>
			</div>
			<div class='menu'>
				<a href="{!! route('dashboard') !!}" class='button-home'><span class='glyphicon glyphicon-home'></span></a>
				<a href="{!! route('listUser') !!}" class='button-home'><span class='glyphicon glyphicon-user'></span></a>
				<a href="{{ route('listKind') }}" class='button-home'><span class='glyphicon glyphicon-asterisk'></span></a>
				<a href="{{ route('listFilm') }}" class='button-home'><span class='glyphicon glyphicon-film'></span></a>
				<a href="{{route('listVocabulary')}}" class='button-home'><span class='glyphicon glyphicon-list-alt'></span></a>
				<a href="" class='button-home'><span class='glyphicon glyphicon-comment'></span></a>
				<a href="{!! route('logout') !!}" class='button-home'><span class='glyphicon glyphicon-off'></span></a>
			</div>
		</div>