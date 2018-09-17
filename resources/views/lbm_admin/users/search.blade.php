@extends('lbm_admin.master_list')
@section('list')
	<div class='top_content'>
		<h2>Danh sách thành viên <a href="{!! route('addUser') !!}"><span class='glyphicon glyphicon-plus'></span></a></h2>

		<form action='{{ route('search.user') }}' method='post'>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class='search'>
				<input type='text' name='txtsearch' placeholder='Tìm kiếm...'/>
				<input type='submit' name='btsearch' value=''/><span class='glyphicon glyphicon-search'></span>
			</div>
		</form>
	</div>
	
	<div class='table_content'>
		<form action="{{ route('listUser') }}" method='post'>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<table>
				<div class='nocheck'>
					@include('errors.error-form')
				</div>
				<tr>
					<th class="center">STT</th>
					<th>Avatar</th>
					<th>Tên truy cập</th>
					<th>Email</th>
					<th>Ngày tạo user</th>
					<th>Cấp bậc</th>

					@if(Auth::user()->id == 3)
						<th class="center">Xóa</th>
					@endif

				</tr>	
				<?php $stt=1; ?>
				@if($search != null)
					@foreach($search as $itemsearch)
				<tr>
					<td align="center">{{ $stt++ }}</td>
					<td><img src="{{ asset('public/upload/avatar/'.$itemsearch->img.'') }}" alt=""></td>
					<td>{{ $itemsearch->name }}</td>
					<td>{{ $itemsearch->email }}</td>
					<td>{{ substr($itemsearch->updated_at,0,10) }}</td>

					@if($itemsearch->level == 1 )
						<td>Quản trị</td>
					@else
						<td>Thành viên</td>
					@endif

					@if(Auth::user()->id ==3 )
						<td align="center"><input type="checkbox" name='check[]' value='{{ $itemsearch->id }}'></td>
					@endif

				</tr>
					@endforeach

				@else
					<tr>
						<td colspan='7' align="center">Không tìm thấy kết quả tìm kiếm của bạn</td>
					</tr>

				@endif
				
			</table>

			@if(Auth::user()->id == 3)
				<input type="submit" value='Xóa' onclick='return WannaDel()'>
			@endif
		</form>
	</div>
	<div class='pagination_mom'>

	</div>
@stop
