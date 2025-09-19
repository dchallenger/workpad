<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Compensation Information</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">
		<div class="form-group">
			<label class="control-label col-md-3">Compensation</label>
			<div class="col-md-7">
				<input type="text" class="form-control" disabled="disabled" name="users_compensation[compensation]" id="users_compensation-compensation" value="{{ $record['users_compensation_compensation'] }}" />
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Description</label>
			<div class="col-md-7">							
				<textarea class="form-control" disabled="disabled" name="users_compensation[description]" id="users_position-job_description" rows="4">{{ $record['users_compensation_description'] }}</textarea> 				
			</div>	
		</div>	
		<div class="form-group">
			<label class="control-label col-md-3">Active</label>
			<div class="col-md-7">							
				<div class="make-switch" disabled="disabled" data-on-label="&nbsp;{{ lang('common.option_yes') }}&nbsp;" data-off-label="&nbsp;{{ lang('common.option_no') }}&nbsp;">
			    	<input type="checkbox" value="1" @if( $record['users_compensation_status_id'] ) checked="checked" @endif name="users_compensation[status_id][temp]" id="users_compensation-status_id-temp" class="dontserializeme toggle"/>
			    	<input type="hidden" name="users_compensation[status_id]" id="users_compensation-status_id" value="<?php echo $record['users_compensation_status_id'] ? 1 : 0 ?>"/>
				</div> 				
			</div>	
		</div>		
	</div>
</div>