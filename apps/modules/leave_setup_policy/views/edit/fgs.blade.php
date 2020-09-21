<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Credit Setup</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
		<div class="portlet-body form">		
			<div class="form-group">
				<label class="control-label col-md-3">Company</label>
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
                        if (!empty($record['time_form_balance_setup_policy.company_ids']))
                            $company_ids_val = explode(',', $record['time_form_balance_setup_policy.company_ids']);	            		
	            	?>
	            	<div class="input-group">
						<span class="input-group-addon">
	                    <i class="fa fa-list-ul"></i>
	                    </span>
	                    {{ form_multiselect('time_form_balance_setup_policy[company_ids][]',$company, $company_ids_val, 'class="form-control select2me" data-placeholder="Select..." id="time_form_balance_setup_policy-company_id"') }}
	                </div>
	            </div>	
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">Employment Type</label>
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
                        if (!empty($record['time_form_balance_setup_policy.employment_type_ids']))
                            $employment_type_ids_val = explode(',', $record['time_form_balance_setup_policy.employment_type_ids']);	 	            		 
	            	?>
	            	<div class="input-group">
						<span class="input-group-addon">
	                    <i class="fa fa-list-ul"></i>
	                    </span>
	                    {{ form_multiselect('time_form_balance_setup_policy[employment_type_ids][]',$employment_type, $employment_type_ids_val, 'multiple class="form-control select2me" data-placeholder="Select..." id="time_form_balance_setup_policy-company_id"') }}
	                </div>
	            </div>	
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">Employment Status</label>
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
                        if (!empty($record['time_form_balance_setup_policy.employment_status_ids']))
                            $employment_status_ids_val = explode(',', $record['time_form_balance_setup_policy.employment_status_ids']);	 	            		 	            		 
	            	?>
	            	<div class="input-group">
						<span class="input-group-addon">
	                    <i class="fa fa-list-ul"></i>
	                    </span>
	                    {{ form_multiselect('time_form_balance_setup_policy[employment_status_ids][]',$employment_status, $employment_status_ids_val, 'multiple class="form-control select2me" data-placeholder="Select..." id="time_form_balance_setup_policy-company_id"') }}
	                </div>
	            </div>	
			</div>
			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Description</label>
				<div class="col-md-7">
					<input type="text" class="form-control" name="time_form_balance_setup_policy[description]" id="time_form_balance_setup_policy-starting_credit" value="{{ $record['time_form_balance_setup_policy.description'] }}" placeholder="Enter Description" />
				</div>	
			</div>			
			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Leave Type</label>
				<div class="col-md-7">
					<?php	
						$db->select('form_id,form');
						$db->order_by('form', '0');
						$db->where('deleted', '0');
						$db->where('is_leave', '1');
						$options = $db->get('time_form');
						$time_form_balance_setup_policy_form_id_options = array('' => '');
                        foreach($options->result() as $option)
                        {   
                        	$time_form_balance_setup_policy_form_id_options[$option->form_id] = $option->form;
                        } ?>
                    <div class="input-group">
						<span class="input-group-addon">
                        	<i class="fa fa-list-ul"></i>
                        </span>
	                    {{ form_dropdown('time_form_balance_setup_policy[form_id]',$time_form_balance_setup_policy_form_id_options, $record['time_form_balance_setup_policy.form_id'], 'class="form-control select2me" data-placeholder="Select..." id="time_form_balance_setup_policy-form_id"') }}
	                </div>
	            </div>	
			</div>
			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Accumulation Type</label>
				<div class="col-md-7">
					<?php	
						$accumulation_option = array('' => '',1 => 'Monthly',2 => 'Yearly');
                        foreach($accumulation_option as $key => $val)
                        {   
                        	$accumulation_type[$key] = $val;
                        } 
                    ?>
                    <div class="input-group">
						<span class="input-group-addon">
                        	<i class="fa fa-list-ul"></i>
                        </span>
	                    {{ form_dropdown('time_form_balance_setup_policy[accumulation_type]',$accumulation_type, $record['time_form_balance_setup_policy.accumulation_type'], 'class="form-control select2me" data-placeholder="Select..." id="time_form_balance_setup_policy-form_id"') }}
	                </div>
	            </div>	
			</div>			
			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Credit (1 to 15 of the month)</label>
				<div class="col-md-7">
					<input type="text" class="form-control" name="time_form_balance_setup_policy[credit_1_15]" id="time_form_balance_setup_policy-starting_credit" value="{{ $record['time_form_balance_setup_policy.credit_1_15'] }}" placeholder="Enter Credit (1 to 15 of the month)" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/>
				</div>	
			</div>
			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Credit (16 to 31 of the month)</label>
				<div class="col-md-7">
					<input type="text" class="form-control" name="time_form_balance_setup_policy[credit_16_31]" id="time_form_balance_setup_policy-starting_credit" value="{{ $record['time_form_balance_setup_policy.credit_16_31'] }}" placeholder="Enter Credit (16 to 31 of the month)" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/>
				</div>	
			</div>
			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Credit</label>
				<div class="col-md-7">
					<input type="text" class="form-control" name="time_form_balance_setup_policy[credit]" id="time_form_balance_setup_policy-starting_credit" value="{{ $record['time_form_balance_setup_policy.credit'] }}" placeholder="Enter Credit" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/>
				</div>	
			</div>			
			<div class="form-group">
				<label class="control-label col-md-3">Maximum</label>
				<div class="col-md-7">
					<input type="text" class="form-control" name="time_form_balance_setup_policy[max_credit]" id="time_form_balance_setup_policy-max_credit" value="{{ $record['time_form_balance_setup_policy.max_credit'] }}" placeholder="Enter Maximum" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/>
				</div>	
			</div>
            <div class="form-group">
                <label class="control-label col-md-3" style="margin-top: 0px;">Pro-rated</label>
                <div class="col-md-5">
                    <div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
                    	<input type="checkbox" value="1" @if( $record['time_form_balance_setup_policy.prorated'] ) checked="checked" @endif name="partners_personal[home_leave][temp]" id="partners_personal-home_leave-temp" class="dontserializeme toggle"/>
                        <input type="hidden" name="time_form_balance_setup_policy[prorated]" id="partners_personal-home_leave" value="@if( $record['time_form_balance_setup_policy.prorated'] ) 1 else 0 @endif"/>
                    </div> 
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Leave Reset Date</label>
                <div class="col-md-5">
                    <div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
                        <input type="text" class="form-control" name="time_form_balance_setup_policy[leave_reset_date]" id="time_form_balance_setup_policy-leave_reset_date" value="{{ $record['time_form_balance_setup_policy.leave_reset_date'] }}" placeholder="Enter Leave Reset Date" >
                        <span class="input-group-btn">
                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </div>
            </div>
		</div>
</div>