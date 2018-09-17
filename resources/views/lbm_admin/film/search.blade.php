@extends('lbm_admin.master_list')

@section('list')
	<div class='top_content'>
		<h2>Danh sách phim <a href="{!! route('addfilm') !!}"><span class='glyphicon glyphicon-plus'></span></a></h2>

		<form action='{{ route('search') }}' method='post'>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class='search'>
				<input type='text' name='txtsearch' placeholder='Tìm kiếm...'/>
				<input type='submit' name='btsearch' value=''/><span class='glyphicon glyphicon-search'></span>
			</div>
		</form>
	</div>
	
	<div class='table_content'>
		<form action="" method='post'>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<table>
				<div class='nocheck'>
					@include('errors.error-form')
				</div>
				<tr>
					<th class="center">STT</th>
					<th>Poster</th>
					<th>Tên phim</th>
					<th>Thể loại</th>
					<th class="center">Số lượng tập</th>
					<th class="center">Sửa</th>
					<th class="center">Xóa</th>

				</tr>	
				<?php $stt=1; ?>
				@if($film != null)
					@foreach($film as $itemfilm)
						<tr>
							<td align="center">{{ $stt++ }}</td>
							<td><img src="{{asset('public/upload/poster/'.$itemfilm->movie_poster.'')}}" alt=""></td>
							<td><a href="">{{ $itemfilm->movie_name_1 }}</a></td>
							<td>{{ $itemfilm->kind_name }}</td>
							<td align="center">1</td>
							<td align="center"><a href="{{url('lbm_admin/film/editfilm/'.$itemfilm->movie_id.'')}}"><span class='glyphicon glyphicon-pencil'></span></a></td>
							<td align="center"><input type="checkbox" name='check[]' value='{{$itemfilm->movie_id}}'></td>
						</tr>
					@endforeach
				@else 
					<tr>
						<td colspan='9'>Chưa có dữ liệu</td>
					</tr>
				@endif

			</table>

			@if(Auth::user()->id == 3)
				<input type="submit" value='Xóa' onclick='return WannaDel()'>
			@endif
		</form>

	</div>

@stop
