@extends('lbm_admin.master')

@section('content')

<div class='wrap_add'>
	<div class='title_add'>
		<h2>Thêm thể loại</h2>
	</div>
	
	<div class='add_lbm'>
		<form action="" method='post'>
			@include('errors.error-form')
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<label for="txtname">Tên thể loại</label><br>
				<input type="text" name='txtname' placeholder="Nhập tên thể loại" value='{{ old('txtname') }}'><br>
			<input type="submit" value='Thêm'>
		</form>
	</div>
</div>

@stop