<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Previous Employee Information</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">			
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>{{ lang('payroll_previous_employer_alphalist.company') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="payroll_partners_previous_employer[company_name]" id="payroll_partners_previous_employer-company_name" value="{{ $record['payroll_partners_previous_employer_company_name'] }}"/> 				
			</div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>{{ lang('payroll_previous_employer_alphalist.address') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="payroll_partners_previous_employer[address]" id="payroll_partners_previous_employer-address" value="{{ $record['payroll_partners_previous_employer_address'] }}"/> 				
			</div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>{{ lang('payroll_previous_employer_alphalist.employee') }}</label>				
			<div class="col-md-7"><?php	                            	                            		
										$db->select('user_id,full_name');
	                            		$db->where('deleted', '0');
	                            		$db->where('active', '1');
	                            		$db->order_by('full_name');
	                            		$options = $db->get('users');
										$users_options = array('' => lang('payroll_previous_employer_alphalist.select'));
	                            		foreach($options->result() as $option)
	                            		{
	                            			$users_options[$option->user_id] = $option->full_name;
	                            		} ?>							
        		<div class="input-group">
					<span class="input-group-addon">
                    <i class="fa fa-list-ul"></i>
                    </span>
                    {{ form_dropdown('payroll_partners_previous_employer[user_id]',$users_options, $record['payroll_partners_previous_employer_prev_user_id'], 'disabled="disabled" id="payroll_partners_previous_employer-user_id" class="form-control select2me" data-placeholder="Select..."') }}
                </div> 				
            </div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('payroll_previous_employer_alphalist.prev_nontax_thirten_month') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="payroll_partners_previous_employer[prev_nontax_thirten_month]" id="payroll_partners_previous_employer-prev_nontax_thirten_month" value="{{ $record['payroll_partners_previous_employer_prev_nontax_thirten_month'] }}"/> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('payroll_previous_employer_alphalist.prev_nontax_deminimis') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="payroll_partners_previous_employer[prev_nontax_deminimis]" id="payroll_partners_previous_employer-prev_nontax_deminimis" value="{{ $record['payroll_partners_previous_employer_prev_nontax_deminimis'] }}"/> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('payroll_previous_employer_alphalist.prev_nontax_sss_etc') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="payroll_partners_previous_employer[prev_nontax_sss_etc]" id="payroll_partners_previous_employer-prev_nontax_sss_etc" value="{{ $record['payroll_partners_previous_employer_prev_nontax_sss_etc'] }}"/> 				
			</div>	
		</div>		
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('payroll_previous_employer_alphalist.prev_nontax_salaries') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="payroll_partners_previous_employer[prev_nontax_salaries]" id="payroll_partners_previous_employer-prev_nontax_salaries" value="{{ $record['payroll_partners_previous_employer_prev_nontax_salaries'] }}"/> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('payroll_previous_employer_alphalist.prev_nontax_comp_income') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="payroll_partners_previous_employer[prev_nontax_comp_income]" id="payroll_partners_previous_employer-prev_nontax_comp_income" value="{{ $record['payroll_partners_previous_employer_prev_nontax_comp_income'] }}"/> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('payroll_previous_employer_alphalist.prev_taxable_basic_salary') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="payroll_partners_previous_employer[prev_taxable_basic_salary]" id="payroll_partners_previous_employer-prev_taxable_basic_salary" value="{{ $record['payroll_partners_previous_employer_prev_taxable_basic_salary'] }}"/> 				
			</div>	
		</div>				
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('payroll_previous_employer_alphalist.prev_taxable_thirten_month') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="payroll_partners_previous_employer[prev_taxable_thirten_month]" id="payroll_partners_previous_employer-prev_taxable_thirten_month" value="{{ $record['payroll_partners_previous_employer_prev_taxable_thirten_month'] }}"/> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('payroll_previous_employer_alphalist.prev_taxable_salaries') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="payroll_partners_previous_employer[prev_taxable_salaries]" id="payroll_partners_previous_employer-prev_taxable_salaries" value="{{ $record['payroll_partners_previous_employer_prev_taxable_salaries'] }}"/> 				
			</div>	
		</div>		
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('payroll_previous_employer_alphalist.prev_total_taxable') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="payroll_partners_previous_employer[prev_total_taxable]" id="payroll_partners_previous_employer-prev_total_taxable" value="{{ $record['payroll_partners_previous_employer_prev_total_taxable'] }}"/> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">{{ lang('payroll_previous_employer_alphalist.prev_tax_w_held') }}</label>
			<div class="col-md-7">							
				<input type="text" disabled="disabled" class="form-control" name="payroll_partners_previous_employer[prev_tax_w_held]" id="payroll_partners_previous_employer-prev_tax_w_held" value="{{ $record['payroll_partners_previous_employer_prev_tax_w_held'] }}"/> 				
			</div>	
		</div>			
	</div>
</div>