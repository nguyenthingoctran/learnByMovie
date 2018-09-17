@extends('lbm_admin.master_list')

@section('list')
	<div class='top_content'>
		<h2>Danh sách thể loại <a href="{!! route('addKind') !!}">
			<span class='glyphicon glyphicon-plus'></span></a></h2>

		<form action='{{ route('search.kind') }}' method='post'>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class='search'>
				<input type='text' name='txtsearch' placeholder='Tìm kiếm...'/>
				<input type='submit' name='btsearch' value=''/><span class='glyphicon glyphicon-search'></span>
			</div>
		</form>
	</div>
	
	<div class='table_content'>
		<form action="{{route('listKind')}}" method='post'>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<table>
				<div class='nocheck'>
					@include('errors.error-form')
				</div>
				<tr>
					<th class="center">STT</th>
					<th>Tên thể loại</th>
					<th class="center">Sửa</th>
					<th class="center">Xóa</th>
				</tr>	
				@if($kind != 0)
				<?php $stt=1 ?>
					@foreach($kind as $itemKind)
						<tr>
							<td align='center'>{{$stt++}}</td>
							<td>{{$itemKind->kind_name}}</td>
							<td align="center"><a href="{{ url('lbm_admin/kind/editKind/'.$itemKind->kind_id.'') }}"><span class='glyphicon glyphicon-pencil'></span></a></td>
							<td align="center"><input type="checkbox" name='check[]' value='{{$itemKind->kind_id}}'></td>
						</tr>
					@endforeach
				@endif

			</table>

			@if(Auth::user()->id == 3)
				<input type="submit" value='Xóa' onclick='return WannaDel()'>
			@endif
		</form>
	</div>
@stop
