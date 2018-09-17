@include('template.top')
@include('template.menu_left')
		<div class='list'>
			@yield('list')
			@yield('detail')
		</div>
@include('template.bottom')