<div class="portlet">
	<div class="portlet-title">
		<div class="caption">{{ lang('my201.id_no') }}</div>
		<div class="tools">
			<a class="collapse" href="javascript:;"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- START FORM -->
		<div class="form-horizontal">
            <div class="form-body">
                @if(in_array('taxcode', $partners_keys))
                    <div class="col-md-12 hidden">
                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-5">{{ $partners_labels['taxcode'] }} </label>
                            <div class="col-md-5">
		                    	<?php $db->select('taxcode_id,taxcode');
		                          $db->order_by('taxcode', '0');
		                          $db->where('deleted', '0');
		                          $options = $db->get('taxcode');                                 
		                          $payroll_partners_taxcode_id_options = array('' => 'Select...');
		                            
		                            foreach($options->result() as $option)
		                            {
		                                 $payroll_partners_taxcode_id_options[$option->taxcode_id] = $option->taxcode;
		                             } 
		                            $readonly = ($is_editable['taxcode'] == 1) ? '' : 'disabled';
		                        ?>                            
		                        <div class="input-group">
		                            <span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
		                            {{ form_dropdown('partners_personal[taxcode]',$payroll_partners_taxcode_id_options, $record['taxcode_id'], 'class="form-control select2me" '.$readonly.' data-placeholder="Select..." ' ) }}
		                        </div>              
		                    </div> 
                        </div>
                    </div>
                @endif
                @if(in_array('sss_number', $partners_keys))
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-5 col-sm-5">{{ $partners_labels['sss_number'] }} </label>
							<div class="col-md-5">
		                        <input type="text" {{ ($is_editable['sss_number'] == 1) ? '' : 'readonly="readonly"' }} class="form-control" name="partners_personal[sss_number]" id="partners_personal-sss_number" value="{{ $record['sss_number'] }}" placeholder="Enter {{ $partners_labels['sss_number'] }}"/>
		                    </div>
						</div>
					</div>
	            @endif
				@if(in_array('pagibig_number', $partners_keys))
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-5 col-sm-5">{{ $partners_labels['pagibig_number'] }} </label>
							<div class="col-md-5">
                        <input type="text" {{ ($is_editable['pagibig_number'] == 1) ? '' : 'readonly="readonly"' }} class="form-control" name="partners_personal[pagibig_number]" id="partners_personal-pagibig_number" value="{{ $record['pagibig_number'] }}" placeholder="Enter {{ $partners_labels['pagibig_number'] }}"/>
                    </div>
						</div>
					</div>
                @endif
                @if(in_array('philhealth_number', $partners_keys))
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-5 col-sm-5">{{ $partners_labels['philhealth_number'] }} </label>
							<div class="col-md-5">
	                            <input type="text" {{ ($is_editable['philhealth_number'] == 1) ? '' : 'readonly="readonly"' }} class="form-control" name="partners_personal[philhealth_number]" id="partners_personal-philhealth_number" value="{{ $record['philhealth_number'] }}" placeholder="Enter {{ $partners_labels['philhealth_number'] }}"/>
	                        </div>
						</div>
					</div>
                @endif	
 				@if(in_array('tin_number', $partners_keys))
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-5 col-sm-5">{{ $partners_labels['tin_number'] }} </label>
							<div class="col-md-5">
                        <input type="text" {{ ($is_editable['tin_number'] == 1) ? '' : 'readonly="readonly"' }}  class="form-control" name="partners_personal[tin_number]" id="partners_personal-tin_number" value="{{ $record['tin_number'] }}" placeholder="Enter {{ $partners_labels['tin_number'] }}"/>
                    </div>
						</div>
					</div>
                @endif 
                @if(in_array('bank_account_number_savings', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-5">{{ $partners_labels['bank_account_number_savings'] }}</label>
                    <div class="col-md-5">
                        <input type="text" {{ ($is_editable['tin_number'] == 1) ? '' : 'readonly="readonly"' }} class="form-control" name="partners_personal[bank_account_number_savings]" id="partners_personal-bank_account_number_savings" value="{{ $record['bank_number_savings'] }}" placeholder="Enter {{ $partners_labels['bank_account_number_savings'] }}"/>
                    </div>
                </div>
                @endif
                @if(in_array('bank_account_number_current', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-5">{{ $partners_labels['bank_account_number_current'] }}</label>
                    <div class="col-md-5">
                        <input type="text" {{ ($is_editable['tin_number'] == 1) ? '' : 'readonly="readonly"' }} class="form-control" name="partners_personal[bank_account_number_current]" id="partners_personal-bank_account_number_current" value="{{ $record['bank_number_current'] }}" placeholder="Enter {{ $partners_labels['bank_account_number_current'] }}"/>
                    </div>
                </div>
                @endif
                @if(in_array('payroll_bank_account_number', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-5">{{ $partners_labels['payroll_bank_account_number'] }}</label>
                    <div class="col-md-5">
                        <input type="text" {{ ($is_editable['tin_number'] == 1) ? '' : 'readonly="readonly"' }} class="form-control" name="partners_personal[payroll_bank_account_number]" id="partners_personal-payroll_bank_account_number" value="{{ $record['payroll_bank_account_number'] }}" placeholder="Enter {{ $partners_labels['payroll_bank_account_number'] }}"/>
                    </div>
                </div>
                @endif
                @if(in_array('payroll_bank_name', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-5">{{ $partners_labels['payroll_bank_name'] }}</label>
                    <div class="col-md-5">
                        <input type="text" {{ ($is_editable['tin_number'] == 1) ? '' : 'readonly="readonly"' }} class="form-control" name="partners_personal[payroll_bank_name]" id="partners_personal-payroll_bank_name" value="{{ $record['payroll_bank_name'] }}" placeholder="Enter {{ $partners_labels['payroll_bank_name'] }}"/>
                    </div>
                </div>
                @endif                                
                @if(in_array('bank_account_name', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-5">{{ $partners_labels['bank_account_name'] }}</label>
                    <div class="col-md-5">
                        <input type="text" {{ ($is_editable['tin_number'] == 1) ? '' : 'readonly="readonly"' }} class="form-control" name="partners_personal[bank_account_name]" id="partners_personal-bank_account_name" value="{{ $record['bank_account_name'] }}" placeholder="Enter {{ $partners_labels['bank_account_name'] }}"/>
                    </div>
                </div>
                @endif
                @if(in_array('health_care', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-5">{{ $partners_labels['health_care'] }}</label>
                    <div class="col-md-5">
                        <input type="text" {{ ($is_editable['tin_number'] == 1) ? '' : 'readonly="readonly"' }} class="form-control" name="partners_personal[health_care]" id="partners_personal-health_care" value="{{ $record['health_care'] }}" placeholder="Enter {{ $partners_labels['health_care'] }}"/>
                    </div>
                </div>
                @endif
                @if(in_array('drivers_license_no', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-5">{{ $partners_labels['drivers_license_no'] }}</label>
                    <div class="col-md-5">
                        <input type="text" {{ ($is_editable['tin_number'] == 1) ? '' : 'readonly="readonly"' }} class="form-control" name="partners_personal[drivers_license_no]" id="partners_personal-bank_account_number_savings" value="{{ $record['drivers_license_no'] }}" placeholder="Enter {{ $partners_labels['drivers_license_no'] }}"/>
                    </div>
                </div>
                @endif
                @if(in_array('passport_no', $partners_keys))
                <div class="form-group">
                    <label class="control-label col-md-5">{{ $partners_labels['passport_no'] }}</label>
                    <div class="col-md-5">
                        <input type="text" {{ ($is_editable['tin_number'] == 1) ? '' : 'readonly="readonly"' }} class="form-control" name="partners_personal[passport_no]" id="partners_personal-bank_account_number_savings" value="{{ $record['passport_no'] }}" placeholder="Enter {{ $partners_labels['passport_no'] }}"/>
                    </div>
                </div>
                @endif          
            </div>
        </div>
	</div>
</div>