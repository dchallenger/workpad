<div class="portlet">
	<div class="portlet-title">
		<div class="caption">{{ lang('leave_fcc_setup.title') }}</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
		<div class="portlet-body form">		
			<div class="form-group">
				<label class="control-label col-md-3">{{ lang('leave_fcc_setup.company') }}</label>
				<div class="col-md-7">
					<?php	
						$db->select('*');
                		$db->order_by('company', '0');
                		$db->where('deleted', '0');
                		$options = $db->get('users_company'); 	
                		$company = array();                            
	            		foreach($options->result() as $option) {
	            			$company[$option->company_id] = $option->company;
	            		} 

                        $company_ids_val = '';
                        if (!empty($record['time_form_balance_fcc_setup.company_ids']))
                            $company_ids_val = explode(',', $record['time_form_balance_fcc_setup.company_ids']);	            		
	            	?>
	            	<div class="input-group">
						<span class="input-group-addon">
	                    <i class="fa fa-list-ul"></i>
	                    </span>
	                    {{ form_multiselect('time_form_balance_fcc_setup[company_ids][]',$company, $company_ids_val, 'class="form-control select2me" data-placeholder="Select..." id="time_form_balance_fcc_setup-company_id"') }}
	                </div>
	            </div>	
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">{{ lang('leave_fcc_setup.employment_type') }}</label>
				<div class="col-md-7">
					<?php	
						$db->select('*');
                		$db->order_by('employment_type', '0');
                		$db->where('deleted', '0');
                		$options = $db->get('partners_employment_type'); 	                            
                		$employment_type = array();
	            		foreach($options->result() as $option) {
	            			$employment_type[$option->employment_type_id] = $option->employment_type;
	            		}

                        $employment_type_ids_val = '';
                        if (!empty($record['time_form_balance_fcc_setup.employment_type_ids']))
                            $employment_type_ids_val = explode(',', $record['time_form_balance_fcc_setup.employment_type_ids']);	 	            		 
	            	?>
	            	<div class="input-group">
						<span class="input-group-addon">
	                    <i class="fa fa-list-ul"></i>
	                    </span>
	                    {{ form_multiselect('time_form_balance_fcc_setup[employment_type_ids][]',$employment_type, $employment_type_ids_val, 'multiple class="form-control select2me" data-placeholder="Select..." id="time_form_balance_fcc_setup-company_id"') }}
	                </div>
	            </div>	
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">{{ lang('leave_fcc_setup.employment_status') }}</label>
				<div class="col-md-7">
					<?php	
						$db->select('*');
                		$db->order_by('employment_status', '0');
                		$db->where('deleted', '0');
                		$options = $db->get('partners_employment_status'); 	                            
                		$employment_status = array();
	            		foreach($options->result() as $option) {
	            			$employment_status[$option->employment_status_id] = $option->employment_status;
	            		}

                        $employment_status_ids_val = '';
                        if (!empty($record['time_form_balance_fcc_setup.employment_status_ids']))
                            $employment_status_ids_val = explode(',', $record['time_form_balance_fcc_setup.employment_status_ids']);	 	            		 	            		 
	            	?>
	            	<div class="input-group">
						<span class="input-group-addon">
	                    <i class="fa fa-list-ul"></i>
	                    </span>
	                    {{ form_multiselect('time_form_balance_fcc_setup[employment_status_ids][]',$employment_status, $employment_status_ids_val, 'multiple class="form-control select2me" data-placeholder="Select..." id="time_form_balance_fcc_setup-company_id"') }}
	                </div>
	            </div>	
			</div>
			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>{{ lang('leave_fcc_setup.description') }}</label>
				<div class="col-md-7">
					<input type="text" class="form-control" name="time_form_balance_fcc_setup[description]" id="time_form_balance_fcc_setup-starting_credit" value="{{ $record['time_form_balance_fcc_setup.description'] }}" placeholder="Enter Description" />
				</div>	
			</div>			
			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>{{ lang('leave_fcc_setup.leave_type') }}</label>
				<div class="col-md-7">
					<?php	
						$db->select('form_id,form');
						$db->order_by('form', '0');
						$db->where('deleted', '0');
						$db->where('is_leave', '1');
						$options = $db->get('time_form');
						$time_form_balance_fcc_setup_form_id_options = array('' => '');
                        foreach($options->result() as $option)
                        {   
                        	$time_form_balance_fcc_setup_form_id_options[$option->form_id] = $option->form;
                        } ?>
                    <div class="input-group">
						<span class="input-group-addon">
                        	<i class="fa fa-list-ul"></i>
                        </span>
	                    {{ form_dropdown('time_form_balance_fcc_setup[form_id]',$time_form_balance_fcc_setup_form_id_options, $record['time_form_balance_fcc_setup.form_id'], 'class="form-control select2me" data-placeholder="Select..." id="time_form_balance_fcc_setup-form_id"') }}
	                </div>
	            </div>	
			</div>		
			<div class="form-group">
				<label class="control-label col-md-3">{{ lang('leave_fcc_setup.max_balance_carry_over') }}</label>
				<div class="col-md-7">
					<input type="text" class="form-control" name="time_form_balance_fcc_setup[max_balance_carry_over]" id="time_form_balance_fcc_setup-max_balance_carry_over" value="{{ $record['time_form_balance_fcc_setup.max_balance_carry_over'] }}" placeholder="Enter Maximum Balance To Carry Over" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/>
				</div>	
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">{{ lang('leave_fcc_setup.in_excess_to_pay') }}</label>
				<div class="col-md-7">
					<input type="text" class="form-control" name="time_form_balance_fcc_setup[in_excess_to_pay]" id="time_form_balance_fcc_setup-in_excess_to_pay" value="{{ $record['time_form_balance_fcc_setup.in_excess_to_pay'] }}" placeholder="Enter Inexcess To Pay" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/>
				</div>	
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">{{ lang('leave_fcc_setup.in_excess_to_forfeit') }}</label>
				<div class="col-md-7">
					<input type="text" class="form-control" name="time_form_balance_fcc_setup[in_excess_to_forfeit]" id="time_form_balance_fcc_setup-in_excess_to_forfeit" value="{{ $record['time_form_balance_fcc_setup.in_excess_to_forfeit'] }}" placeholder="Enter Inexcess To Forfeit" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/>
				</div>	
			</div>			
		</div>
</div>