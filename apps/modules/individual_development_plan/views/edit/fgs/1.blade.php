<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Employee Details</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
		<div class="portlet-body form">			<div class="form-group">
				<label class="control-label col-md-3">Employee</label>
				<div class="col-md-7"><?php									                            		$db->select('user_id,full_name');
	                            			                            		$db->order_by('full_name', '0');
	                            		$db->where('deleted', '0');
	                            		$options = $db->get('users'); 	                            $performance_appraisal_idp_user_id_options = array('' => 'Select...');
                        		foreach($options->result() as $option)
                        		{
                        			                        				$performance_appraisal_idp_user_id_options[$option->user_id] = $option->full_name;
                        			                        		} ?>							<div class="input-group">
								<span class="input-group-addon">
	                            <i class="fa fa-list-ul"></i>
	                            </span>
	                            {{ form_dropdown('performance_appraisal_idp[user_id]',$performance_appraisal_idp_user_id_options, $record['performance_appraisal_idp.user_id'], 'class="form-control select2me" data-placeholder="Select..." id="performance_appraisal_idp-user_id"') }}
	                        </div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Total Development Budget for the Year</label>
				<div class="col-md-7">							<input type="text" class="form-control" name="performance_appraisal_idp[total_budget]" id="performance_appraisal_idp-total_budget" value="{{ $record['performance_appraisal_idp.total_budget'] }}" placeholder="Enter Total Development Budget for the Year" /> 				</div>	
			</div>	</div>
</div>