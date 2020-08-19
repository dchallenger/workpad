<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Employee Loans</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
		<div class="portlet-body form">			
			<div class="form-group">
				<label class="control-label col-md-3">Employee Name</label>
				<div class="col-md-7">							
					<input type="hidden" disabled="disabled" class="form-control" name="payroll_partners_loan[user_id]" id="payroll_partners_loan-user_id" value="{{ $record['payroll_partners_loan.user_id'] }}"/>
					<?php
						$full_name = "";
						if( !empty( $record['payroll_partners_loan.user_id'] ) )
						{
							$db->limit(1);
							$full_name = $db->get_where('users', array('user_id' => $record['payroll_partners_loan.user_id']))->row()->full_name;
							?><input type="text" value="{{ $full_name }}" name="partner_name" class="form-control dontserializeme" autocomplete="off" readonly > 
						<?php
						}
						else {
							$qry_category = $mod->get_role_category();	
							$db->select('users.user_id,users.full_name');
							$db->from('users');
							$db->join('partners', 'users.user_id = partners.user_id');
							$db->join('users_profile', 'users_profile.user_id = partners.user_id');							
							$db->join('payroll_partners', 'payroll_partners.user_id = users.user_id', 'inner join');
							$db->order_by('users.full_name', '0');
					        if ($qry_category != ''){
					            $db->where($qry_category, '', false);
					        }							
					  		$db->where('users.deleted', '0');
					  		if($userdata){
					  			$db->where("sensitivity IN ", "(".$userdata.")", false );
					  		}
 					        $options = $db->get();
 					        
 					        $payroll_partners_loan_user_id_options = array('' => 'Select...');
                    		foreach($options->result() as $option)
                    		{
								$payroll_partners_loan_user_id_options[$option->user_id] = $option->full_name;
                    		} ?>
                    		<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
	                            {{ form_dropdown('payroll_partners_loan[user_id]',$payroll_partners_loan_user_id_options, $record['payroll_partners_loan.user_id'], 'disabled="disabled" class="form-control select2me" data-placeholder="Select..."') }}
	                      	</div>	
	           			<?php } ?> 		
	            </div>			
	        </div>			
	        <div class="form-group">
				<label class="control-label col-md-3">Loan Type</label>
				<div class="col-md-7">
					<?php	
						$db->select('loan_id,loan');
	               		$db->order_by('loan', '0');
	                    $db->where('deleted', '0');
	                    $options = $db->get('payroll_loan'); 	                            
	                    $payroll_partners_loan_loan_id_options = array('' => 'Select...');
                    	foreach($options->result() as $option){
							$payroll_partners_loan_loan_id_options[$option->loan_id] = $option->loan;
						} 
				?>							
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
	                    {{ form_dropdown('payroll_partners_loan[loan_id]',$payroll_partners_loan_loan_id_options, $record['payroll_partners_loan.loan_id'], 'disabled="disabled" class="form-control select2me" data-placeholder="Select..."') }}
	                </div> 				
	            </div>	
			</div>			
			<div class="form-group">
				<label class="control-label col-md-3">Loan Status</label>
				<div class="col-md-7"><?php									                            		$db->select('loan_status_id,loan_status');
	                            			                            		$db->order_by('loan_status', '0');
	                            		$db->where('deleted', '0');
	                            		$options = $db->get('payroll_loan_status'); 	                            $payroll_partners_loan_loan_status_id_options = array('' => 'Select...');
                        		foreach($options->result() as $option)
                        		{
                        			                        				$payroll_partners_loan_loan_status_id_options[$option->loan_status_id] = $option->loan_status;
                        			                        		} ?>							<div class="input-group">
								<span class="input-group-addon">
	                            <i class="fa fa-list-ul"></i>
	                            </span>
	                            {{ form_dropdown('payroll_partners_loan[loan_status_id]',$payroll_partners_loan_loan_status_id_options, $record['payroll_partners_loan.loan_status_id'], 'disabled="disabled" class="form-control select2me" data-placeholder="Select..."') }}
	                        </div> 				
	                    </div>	
			</div>			
			<div class="form-group">
				<label class="control-label col-md-3">Entry Date</label>
				<div class="col-md-7">							<div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
								<input type="text" disabled="disabled" class="form-control" name="payroll_partners_loan[entry_date]" id="payroll_partners_loan-entry_date" value="{{ $record['payroll_partners_loan.entry_date'] }}" placeholder="" readonly>
								<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
							</div> 				</div>	
			</div>			
			<div class="form-group">
				<label class="control-label col-md-3">No. of payments</label>
				<div class="col-md-7">							<input type="text" disabled="disabled" class="form-control" name="payroll_partners_loan[no_payments]" id="payroll_partners_loan-no_payments" value="{{ $record['payroll_partners_loan.no_payments'] }}" placeholder="" data-inputmask="'alias': 'integer', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/> 				</div>	
			</div>			
			<div class="form-group">
				<label class="control-label col-md-3">Week</label>
				<div class="col-md-7"><?php                                                        		$db->select('week_id,week');
                            		                            		$db->where('deleted', '0');
                            		$options = $db->get('payroll_week');
									$payroll_partners_loan_week_options = array();
                            		foreach($options->result() as $option)
                            		{
                            			                            				$payroll_partners_loan_week_options[$option->week_id] = $option->week;
                            			                            		} ?>							<div class="input-group">
								<span class="input-group-addon">
	                            <i class="fa fa-list-ul"></i>
	                            </span>
	                            {{ form_dropdown('payroll_partners_loan[week][]',$payroll_partners_loan_week_options, explode(',', $record['payroll_partners_loan.week']), 'disabled="disabled" class="form-control select2" data-placeholder="Select..." multiple id="payroll_partners_loan-week"') }}
	                        </div> 				</div>	
			</div>			
			<div class="form-group">
				<label class="control-label col-md-3">Loan Principal</label>
				<div class="col-md-7">							
					<input type="text" disabled="disabled" class="form-control" name="payroll_partners_loan[loan_principal]" id="payroll_partners_loan-loan_principal" value="{{ $record['payroll_partners_loan.loan_principal'] }}" placeholder="" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/> 				
				</div>	
			</div>	
			<div class="form-group">
				<label class="control-label col-md-3">Interest (%)</label>
				<div class="col-md-7">							
					<input type="text" disabled="disabled" class="form-control" name="payroll_partners_loan[interest]" id="payroll_partners_loan-interest" value="{{ $record['payroll_partners_loan.interest'] }}" placeholder="" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/> 				
				</div>	
			</div>						
			<div class="form-group">
				<label class="control-label col-md-3">Amount</label>
				<div class="col-md-7">							
					<input type="text" disabled="disabled" class="form-control" name="payroll_partners_loan[amount]" id="payroll_partners_loan-amount" value="{{ $record['payroll_partners_loan.amount'] }}" placeholder="" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/> 				
				</div>	
			</div>					
			<div class="form-group">
				<label class="control-label col-md-3">Beginning Balance</label>
				<div class="col-md-7">							
					<input type="text" disabled="disabled" class="form-control" name="payroll_partners_loan[beginning_balance]" id="payroll_partners_loan-beginning_balance" value="{{ $record['payroll_partners_loan.beginning_balance'] }}" placeholder="" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/> 				
				</div>	
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">Remarks</label>
				<div class="col-md-7">							
					<textarea disabled="disabled" class="form-control" name="payroll_partners_loan[remarks]" id="payroll_partners_loan-remarks" value="{{ $record['payroll_partners_loan.remarks'] }}" placeholder="" rows="4">{{ $record['payroll_partners_loan.remarks'] }}</textarea> 				
				</div>	
			</div>				</div>
</div><div class="portlet">
	<div class="portlet-title">
		<div class="caption">Amortization Setup</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
		<div class="portlet-body form">			<div class="form-group">
				<label class="control-label col-md-3">Start Date</label>
				<div class="col-md-7">							<div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
								<input type="text" disabled="disabled" class="form-control" name="payroll_partners_loan[start_date]" id="payroll_partners_loan-start_date" value="{{ $record['payroll_partners_loan.start_date'] }}" readonly>
								<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
							</div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Payment Mode</label>
				<div class="col-md-7"><?php									                            		$db->select('payment_mode_id,payment_mode');
	                            			                            		$db->order_by('payment_mode', '0');
	                            		$db->where('deleted', '0');
	                            		$options = $db->get('payroll_payment_mode'); 	                            $payroll_partners_loan_payment_mode_id_options = array('' => 'Select...');
                        		foreach($options->result() as $option)
                        		{
                        			                        				$payroll_partners_loan_payment_mode_id_options[$option->payment_mode_id] = $option->payment_mode;
                        			                        		} ?>							<div class="input-group">
								<span class="input-group-addon">
	                            <i class="fa fa-list-ul"></i>
	                            </span>
	                            {{ form_dropdown('payroll_partners_loan[payment_mode_id]',$payroll_partners_loan_payment_mode_id_options, $record['payroll_partners_loan.payment_mode_id'], 'disabled="disabled" class="form-control select2me" data-placeholder="Select..."') }}
	                        </div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Payments Remaining</label>
				<div class="col-md-7">							<input type="text" disabled="disabled" class="form-control" name="payroll_partners_loan[no_payments_remaining]" id="payroll_partners_loan-no_payments_remaining" value="{{ $record['payroll_partners_loan.no_payments_remaining'] }}" data-inputmask="'alias': 'integer', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Running Balance</label>
				<div class="col-md-7">							<input type="text" disabled="disabled" class="form-control" name="payroll_partners_loan[running_balance]" id="payroll_partners_loan-running_balance" value="{{ $record['payroll_partners_loan.running_balance'] }}" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">System Amortization</label>
				<div class="col-md-7">							<input type="text" disabled="disabled" class="form-control" name="payroll_partners_loan[system_amortization]" id="payroll_partners_loan-system_amortization" value="{{ $record['payroll_partners_loan.system_amortization'] }}" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">System Interest</label>
				<div class="col-md-7">							<input type="text" disabled="disabled" class="form-control" name="payroll_partners_loan[system_interest]" id="payroll_partners_loan-system_interest" value="{{ $record['payroll_partners_loan.system_interest'] }}" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">User Amortization</label>
				<div class="col-md-7">							<input type="text" disabled="disabled" class="form-control" name="payroll_partners_loan[user_amortization]" id="payroll_partners_loan-user_amortization" value="{{ $record['payroll_partners_loan.user_amortization'] }}" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">User Interest</label>
				<div class="col-md-7">							<input type="text" disabled="disabled" class="form-control" name="payroll_partners_loan[user_interest]" id="payroll_partners_loan-user_interest" value="{{ $record['payroll_partners_loan.user_interest'] }}" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/> 				</div>	
			</div>	</div>
</div><div class="portlet">
	<div class="portlet-title">
		<div class="caption">Payments</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
		<div class="portlet-body form">			<div class="form-group">
				<label class="control-label col-md-3">Last Payment Date</label>
				<div class="col-md-7">							<div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
								<input type="text" disabled="disabled" class="form-control" name="payroll_partners_loan[last_payment_date]" id="payroll_partners_loan-last_payment_date" value="{{ $record['payroll_partners_loan.last_payment_date'] }}" readonly>
								<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
							</div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Total Amount Paid</label>
				<div class="col-md-7">							<input type="text" disabled="disabled" class="form-control" name="payroll_partners_loan[total_amount_paid]" id="payroll_partners_loan-total_amount_paid" value="{{ $record['payroll_partners_loan.total_amount_paid'] }}" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Total No. of Payments</label>
				<div class="col-md-7">							<input type="text" disabled="disabled" class="form-control" name="payroll_partners_loan[no_payments_paid]" id="payroll_partners_loan-no_payments_paid" value="{{ $record['payroll_partners_loan.no_payments_paid'] }}" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Total Arrears</label>
				<div class="col-md-7">							<input type="text" disabled="disabled" class="form-control" name="payroll_partners_loan[total_arrears]" id="payroll_partners_loan-total_arrears" value="{{ $record['payroll_partners_loan.total_arrears'] }}" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/> 				</div>	
			</div>	</div>
</div>