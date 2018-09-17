@include('template.top')
@include('template.menu_left')
		<div class='content'>
			<div class="content_left">@yield('content')</div>
			<div class='content_right'>@yield('right')</div>
			<div class='content_right'>@yield('js')</div>
		</div>
	</div>
@include('template.bottom')