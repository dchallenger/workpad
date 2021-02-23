<tr>
	<td>
		<div class="no-padding col-md-12">
			<select name="" class="form-control select2me">
				<option value=""></option>
				@if($areas_development && $areas_development->num_rows() > 0)
					@foreach($areas_development->result() as $row)
						<option value="{{$row->appraisal_areas_development_id}}">{{$row->appraisal_areas_development}}</option>
					@endforeach
				@endif
			</select>
		</div>
	</td>
	<td>
		<div class="no-padding col-md-12">
			<select name="" class="form-control select2me">
				<option value=""></option>
				@if($learning_mode && $learning_mode->num_rows() > 0)
					@foreach($learning_mode->result() as $row)
						<option value="{{$row->learning_mode_id}}">{{$row->learning_mode}}</option>
					@endforeach
				@endif
			</select>
		</div>
	</td>
	<td>
		<div class="no-padding col-md-12">
			<select name="" class="form-control select2me">
				<option value=""></option>
				@if($competencies && $competencies->num_rows() > 0)
					@foreach($competencies->result() as $row)
						<option value="{{$row->category_id}}">{{$row->category}}</option>
					@endforeach
				@endif
			</select>
		</div>
	</td>
	<td>
		<div class="no-padding col-md-12">
			<select name="" class="form-control select2me">
				<option value=""></option>
				@if($development_category && $development_category->num_rows() > 0)
					@foreach($development_category->result() as $row)
						<option value="{{$row->appraisal_development_category_id}}">{{$row->appraisal_development_category}}</option>
					@endforeach
				@endif
			</select>
		</div>
	</td>
	<td>
		<input type="text" class="form-control" name="" id="" value=""/>
	</td>
	<td>
		<div class="no-padding col-md-12">
			<select name="" class="form-control select2me">
				<option value=""></option>
				@if($target_completion && $target_completion->num_rows() > 0)
					@foreach($target_completion->result() as $row)
						<option value="{{$row->target_completion_id}}">{{$row->target_completion}}</option>
					@endforeach
				@endif
			</select>
		</div>
	</td>
	<td>
		<textarea class="form-control" rows="4" name=""></textarea>
	</td>
	<td>
		<a id="delete_idp" href="javascript:void(0)" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
	</td>
</tr>