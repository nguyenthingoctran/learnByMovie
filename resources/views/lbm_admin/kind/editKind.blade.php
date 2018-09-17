@extends('lbm_admin.master')

@section('content')

<div class='wrap_add'>
	<div class='title_add'>
		<h2>Sửa thể loại</h2>
	</div>
	
	<div class='add_lbm'>
		<form action="" method='post'>
			@include('errors.error-form')
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<label for="txtname">Tên thể loại</label><br>
			@foreach($kind as $itemKind)
				<input type="text" name='txtname' placeholder="Nhập tên thể loại" value='{!! $itemKind->kind_name !!}'><br>
			@endforeach
			<input type="submit" value='Sửa'>
		</form>
	</div>
</div>

@stop