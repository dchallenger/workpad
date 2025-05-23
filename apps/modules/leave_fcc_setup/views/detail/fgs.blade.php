<div class="portlet">
	<div class="portlet-title">
		<div class="caption">{{ lang('leave_fcc_setup.title') }}</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">			
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('leave_fcc_setup.company') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="leave_setup_policy[job_level]" id="leave_setup_policy-job_level" value="{{ $record['time_form_balance_fcc_setup.company'] }}"/> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('leave_fcc_setup.employment_status') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="leave_setup_policy[job_grade_code]" id="leave_setup_policy-job_grade_code" value="{{ $record['time_form_balance_fcc_setup.employment_status'] }}"/> 				
			</div>	
		</div>		
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('leave_fcc_setup.rank') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="leave_setup_policy[job_grade_code]" id="leave_setup_policy-job_grade_code" value="{{ $record['time_form_balance_setup_policy.job_level'] }}"/> 				
			</div>	
		</div>		
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('leave_fcc_setup.employment_type') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="leave_setup_policy[job_grade_code]" id="leave_setup_policy-job_grade_code" value="{{ $record['time_form_balance_fcc_setup.employment_type'] }}"/> 				
			</div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('leave_fcc_setup.description') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="leave_setup_policy[job_grade_code]" id="leave_setup_policy-job_grade_code" value="{{ $record['time_form_balance_fcc_setup.description'] }}"/> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('leave_fcc_setup.leave_type') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="leave_setup_policy[job_grade_code]" id="leave_setup_policy-job_grade_code" value="{{ $record['time_form_balance_fcc_setup.form'] }}"/> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('leave_fcc_setup.max_balance_carry_over') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="leave_setup_policy[job_grade_code]" id="leave_setup_policy-job_grade_code" value="{{ $record['time_form_balance_fcc_setup.max_balance_carry_over'] }}"/> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('leave_fcc_setup.in_excess_to_pay') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="leave_setup_policy[job_grade_code]" id="leave_setup_policy-job_grade_code" value="{{ $record['time_form_balance_fcc_setup.in_excess_to_pay'] }}"/> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('leave_fcc_setup.in_excess_to_forfeit') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="leave_setup_policy[job_grade_code]" id="leave_setup_policy-job_grade_code" value="{{ $record['time_form_balance_fcc_setup.in_excess_to_forfeit'] }}"/> 				
			</div>	
		</div>
            <div class="form-group">
                <label class="col-md-3 control-label">{{ lang('leave_fcc_setup.benefit_package') }}</label>
                <div class="col-md-5">
                    <div class="radio-list">
                        <label class="radio-inline"><input class="form-filter option" type="radio" name="q5[]" id="optionsRadios2" value="0" @if ($record['time_form_balance_fcc_setup.old_new'] == 0) checked="" @endif disabled>Old</label>
                        <label class="radio-inline"><input class="form-filter option" type="radio" name="q5[]" id="optionsRadios2" value="1" @if ($record['time_form_balance_fcc_setup.old_new'] == 1) checked="" @endif disabled>New</label>
                    </div>                        
                </div>
            </div>			
	</div>
</div>