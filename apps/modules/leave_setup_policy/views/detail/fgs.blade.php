<div class="portlet">
	<div class="portlet-title">
		<div class="caption">{{ lang('leave_setup_policy.title') }}</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">			
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('leave_setup_policy.company') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="leave_setup_policy[job_level]" id="leave_setup_policy-job_level" value="{{ $record['time_form_balance_setup_policy.company'] }}"/> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('leave_setup_policy.employment_status') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="leave_setup_policy[job_grade_code]" id="leave_setup_policy-job_grade_code" value="{{ $record['time_form_balance_setup_policy.employment_status'] }}"/> 				
			</div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('leave_setup_policy.rank') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="leave_setup_policy[job_grade_code]" id="leave_setup_policy-job_grade_code" value="{{ $record['time_form_balance_setup_policy.job_level'] }}"/> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('leave_setup_policy.employment_type') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="leave_setup_policy[job_grade_code]" id="leave_setup_policy-job_grade_code" value="{{ $record['time_form_balance_setup_policy.employment_type'] }}"/> 				
			</div>	
		</div>		
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('leave_setup_policy.description') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="leave_setup_policy[job_grade_code]" id="leave_setup_policy-job_grade_code" value="{{ $record['time_form_balance_setup_policy.description'] }}"/> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('leave_setup_policy.leave_type') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="leave_setup_policy[job_grade_code]" id="leave_setup_policy-job_grade_code" value="{{ $record['time_form_balance_setup_policy.form'] }}"/> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('leave_setup_policy.accumulation_type') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="leave_setup_policy[job_grade_code]" id="leave_setup_policy-job_grade_code" value="{{ $record['time_form_balance_setup_policy.accumulation_type'] }}"/> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('leave_setup_policy.credit_1_15') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="leave_setup_policy[job_grade_code]" id="leave_setup_policy-job_grade_code" value="{{ $record['time_form_balance_setup_policy.credit_1_15'] }}"/> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('leave_setup_policy.credit_16_31') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="leave_setup_policy[job_grade_code]" id="leave_setup_policy-job_grade_code" value="{{ $record['time_form_balance_setup_policy.credit_16_31'] }}"/> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('leave_setup_policy.credit') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="leave_setup_policy[job_grade_code]" id="leave_setup_policy-job_grade_code" value="{{ $record['time_form_balance_setup_policy.credit'] }}"/> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('leave_setup_policy.maximum') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="leave_setup_policy[job_grade_code]" id="leave_setup_policy-job_grade_code" value="{{ $record['time_form_balance_setup_policy.max_credit'] }}"/> 				
			</div>	
		</div>
		<div class="form-group" @if($record['time_form_balance_setup_policy.accumulation_type'] != 'Tenure') style="display:none" @endif>
			<label class="control-label col-md-3">{{ lang('leave_setup_policy.tenure') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="leave_setup_policy[tenure]" id="leave_setup_policy-job_grade_code" value="{{ $record['time_form_balance_setup_policy.tenure'] }}"/> 				
			</div>	
		</div>		
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('leave_setup_policy.prorated') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="leave_setup_policy[job_grade_code]" id="leave_setup_policy-job_grade_code" value="{{ $record['time_form_balance_setup_policy.prorated'] }}"/> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('leave_setup_policy.leave_reset_date') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="leave_setup_policy[job_grade_code]" id="leave_setup_policy-job_grade_code" value="{{ $record['time_form_balance_setup_policy.leave_reset_date'] }}"/> 				
			</div>	
		</div>		
	</div>
</div>