@extends('lbm_admin.master_list')

@section('list')
	<div class='top_content'>
		<h2 class="list-h2-capa">{{$movie->movie_name_1}} - Tập {{$episodes->epi_name}}</h2>
	</div>
	
	<div class='table_content'>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<table>
				<div class='nocheck'>
					@include('errors.error-form')
				</div>
				<tr>
					<th class="center">STT</th>
					<th>English</th>
					<th class="center">Sửa</th>
				</tr>	
				@if($sentence != null)
					@foreach($sentence as $valueS)
						<tr>
							<td align="center" id='numOrder'>{{$valueS->numOrder}}</td>
							<td>{{$valueS->english}} <br>	
								{{$valueS->vietnamese}}
								<div class="editSen">
									<input type="hidden" class="{{$movie->movie_id}}" id="eid" value="{{$valueS->episodes_id}}">
									<br><b>Anh:</b> <input type="text" name="txten" class="txten" value="{{$valueS->english}}">
									<br><b>Việt:</b> <input type="text" name="txtvi" class="txtvi" value="{{$valueS->vietnamese}}">
									<button class="XongEditSen">Xong</button>
								</div>
							</td>
							<td align="center"><a id="editSen"><span class='glyphicon glyphicon-pencil'></span></a></td>
						</tr>
					@endforeach
				@else 
					<tr>
						<td colspan='9'>Chưa có dữ liệu</td>
					</tr>
				@endif

			</table>

			<script>
				var editSentence = '{{route('editSentence')}}'
			</script>
	</div>

@stop
