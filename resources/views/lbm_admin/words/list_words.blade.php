@extends('lbm_admin.master_list')

@section('list')
	<div class='top_content'>
		<h2 class="list-h2-capa">Lịch sử từ vựng 
			<span id="addVocabulary" class='glyphicon glyphicon-plus'></span>
		</h2>
		<div class="divAddVocabulary">
			<label for="txtEnVocabulary">English</label><input type="text" name="txtEnVocabulary" id="txtEnVocabulary"><br>
			<label for="txtNghia">Nghĩa</label><input type="text" name="txtNghia" id="txtNghia">
			<p id="okAddVoca">Xong</p>
		</div>
	</div>
	
	<div class='table_content'>
			<table>
				<tr>
					<th class="center">STT</th>
					<th>Từ Tiếng Anh</th>
					<th class="align_right">Sửa</th>
				</tr>	
				<?php $stt=0 ?>
				@if($vocabulary != null )
					@foreach($vocabulary as $valueV)
						<tr>
							<td align="center">{{++$stt}}</td>
							<td>{{$valueV->english_words}}
								<div class="editSen">
									<br><b>Anh:</b> <input type="text" name="txten" class="txten" value="{{$valueV->english_words}}">
									<br><b>Nghĩa:</b> <input type="text" name="txtvi" class="txtvi" value="{{$valueV->vietnamese_words}}">
									<button class="XongEditVocabulary">Xong</button>
								</div>						
							</td>
							
							<td class="align_right">
								<a id="editSen"><span id="editVocabulary" class="glyphicon glyphicon-pencil"></span></a>
							</td>
						</tr>
					@endforeach
				@else
					<tr>
						<td colspan="3">Không có từ nào cả.</td>
					</tr>
				@endif
			</table>

			<script>
				var addVocabulary = '{{route('addVocabulary')}}';
				var editVocabulary = '{{route('editVocabulary')}}';
			</script>
	</div>

@stop
