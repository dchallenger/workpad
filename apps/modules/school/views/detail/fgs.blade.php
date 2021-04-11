<div class="portlet">
	<div class="portlet-title">
		<div class="caption">School Information</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">
		<div class="form-group">
			<label class="control-label col-md-3">School</label>
			<div class="col-md-7">
				<input disabled="disabled" type="text" class="form-control" name="users_education_school[education_school]" id="users_education_school-education_school" value="{{ $record['users_education_school_education_school'] }}"/>
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Active</label>
			<div class="col-md-7">							
				<div class="make-switch" data-on-label="&nbsp;{{ lang('common.option_yes') }}&nbsp;" data-off-label="&nbsp;{{ lang('common.option_no') }}&nbsp;">
			    	<input disabled="disabled" type="checkbox" value="1" @if( $record['users_education_school_status_id'] ) checked="checked" @endif name="users_education_school[status_id][temp]" id="users_education_school-status_id-temp" class="dontserializeme toggle"/>
			    	<input type="hidden" name="users_education_school[status_id]" id="users_education_school-status_id" value="<?php echo $record['users_education_school_status_id'] ? 1 : 0 ?>"/>
				</div> 				
			</div>	
		</div>		
	</div>
</div>