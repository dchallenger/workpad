<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Basic Information</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('employee_benefit.benefit_type') }}
				<span class="required">*</span>
			</label>
			<div class="col-md-7">							
				<input type="text" class="form-control" name="users_benefit[benefit_type]" id="users_benefit-branch_code" value="{{ $record['users_benefit.benefit_type'] }}" placeholder="{{ lang('employee_benefit.p_benefit_type') }}" /> 				
			</div>	
		</div>
    	<div class="form-group">
            <label class="control-label col-md-3">{{ lang('employee_benefit.company') }}<span class="required">*</span></label>
            <div class="col-md-7">
            	<?php	$db->select('company_id,company');
            			$db->where('deleted', '0');
                        $db->order_by('company');
            			$options = $db->get('users_company');

            			$users_profile_company_options = array();
            			foreach($options->result() as $option)
            			{
            				$users_profile_company_options[$option->company_id] = $option->company;
            			}
                        $company_ids_val = '';
                        if (!empty($record['users_benefit.company_id']))
                            $company_ids_val = explode(',', $record['users_benefit.company_id']);	
            	?>
            	<div class="input-group">
					<span class="input-group-addon">
                    	<i class="fa fa-list-ul"></i>
                    </span>
                {{ form_multiselect('users_benefit[company_id][]',$users_profile_company_options, $company_ids_val, 'class="form-control select2me" data-placeholder="Select..." id="benefit-company_id"') }}
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">{{ lang('employee_benefit.rank') }}<span class="required">*</span></label>
            <div class="col-md-7">
                <?php   $db->select('job_grade_id,job_level');
                        $db->where('deleted', '0');
                        $db->order_by('job_level');
                        $options = $db->get('users_job_grade_level');

                        $partners_job_grade_options = array('' => '');
                        foreach($options->result() as $option)
                        {
                            $partners_job_grade_options[$option->job_grade_id] = $option->job_level;
                        } ?>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-list-ul"></i>
                    </span>
                {{ form_dropdown('users_benefit[job_grade_id]',$partners_job_grade_options, $record['users_benefit.job_grade_id'], 'class="form-control select2me" data-placeholder="Select..."') }}
                </div>
            </div>  
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">{{ lang('employee_benefit.benefit_package') }}<span class="required">*</span></label>
            <div class="col-md-5">
                <div class="radio-list">
                    <label class="radio-inline"><input class="form-filter option" type="radio" name="users_benefit[old_new]" id="optionsRadios2" value="0" @if ($record['users_benefit.old_new'] == 0) checked="" @endif >Old</label>
                    <label class="radio-inline"><input class="form-filter option" type="radio" name="users_benefit[old_new]" id="optionsRadios2" value="1" @if ($record['users_benefit.old_new'] == 1) checked="" @endif >New</label>
                </div>                        
            </div>
        </div>  			
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('employee_benefit.description') }}</label>
			<div class="col-md-7">							
				<textarea class="wysihtml5 form-control" name="users_benefit[description]" id="users_benefit-description" placeholder="{{ lang('employee_benefit.p_description') }}" rows="4">{{ $record['users_benefit.description'] }}</textarea> 				
			</div>	
		</div>	
		<div class="form-group">
			<label class="control-label col-md-3">Active</label>
			<div class="col-md-7">							
				<div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
					<input type="checkbox" value="1" @if( $record['users_benefit.status_id'] || $record['users_benefit.status_id'] == '') checked="checked" @endif name="users_benefit[status_id][temp]" id="users_benefit-status_id-temp" class="dontserializeme toggle"/>
					<input type="hidden" name="users_benefit[status_id]" id="users_benefit-status_id" value="<?php echo $record['users_benefit.status_id'] ||$record['users_benefit.status_id'] == '' ? 1 : 0 ?>"/>
				</div> 				
			</div>	
		</div>	
	</div>
</div>