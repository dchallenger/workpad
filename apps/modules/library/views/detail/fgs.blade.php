<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Library</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">			
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Library</label>
			<div class="col-md-7">							
				<input type="text" class="form-control" name="performance_setup_library[library]" id="performance_setup_library-library" value="{{ $record['performance_setup_library_library'] }}" placeholder="Enter Library" readonly/>
			</div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3">Description</label>
			<div class="col-md-7">							
				<input type="text" class="form-control" name="performance_setup_library[description]" id="performance_setup_library-description" value="{{ $record['performance_setup_library_description'] }}" placeholder="Enter Description" /> 				
			</div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3">Is Active</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="performance_setup_library[description]" id="performance_setup_library-description" value="{{ $record['performance_setup_library_status_id'] }}" placeholder="Enter Description" /> 				
			</div>	
		</div>	
	</div>
	<div class="portlet-title">
		<div class="caption">Library Value</div>
	</div>					                            	
	<div class="portlet-body form libary_value_container">
		@if(isset($library_value) && $library_value->num_rows() > 0)
			@foreach($library_value->result() as $row)
				<div class="form-group">
					<div class="col-md-5">
						<input type="text" class="form-control" placeholder="Value" name="library_value[{{ $row->library_value_id }}]" value="{{ $row->library_value }}" readonly>
					</div>
					<div class="col-md-7">
						<textarea class="form-control" rows="3" placeholder="Description" name="library_value_description[{{ $row->library_value_id }}]" readonly>{{ $row->library_value_description }}</textarea>
					</div>
				</div>		
			@endforeach
		@else
			<div class="form-group">
				<div class="col-md-5">
					<input type="text" class="form-control" placeholder="Value" name="library_value[]">
				</div>
				<div class="col-md-6">
					<textarea class="form-control" rows="3" placeholder="Description" name="library_value_description[]"></textarea>
				</div>
				<div class="col-md-1">
					<div class="btn-group">
					    <a href="javascript:void(0)" class="btn btn-danger btn-sm delete_row">
					      	<i class="fa fa-trash-o"></i>
					    </a>
					</div>				
				</div>
			</div>		
		@endif
	</div>
</div>