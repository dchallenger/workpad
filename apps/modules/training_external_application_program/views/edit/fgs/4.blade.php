<div class="portlet">
	<div class="portlet-title">
		<div class="caption">External Program Application Form</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
		<div class="portlet-body form">			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Employee</label>
				<div class="col-md-7"><?php									                            		$db->select('user_id,full_name');
	                            			                            		$db->order_by('full_name', '0');
	                            		$db->where('deleted', '0');
	                            		$options = $db->get('users'); 	                            $training_application_user_id_options = array('' => 'Select...');
                        		foreach($options->result() as $option)
                        		{
                        			                        				$training_application_user_id_options[$option->user_id] = $option->full_name;
                        			                        		} ?>							<div class="input-group">
								<span class="input-group-addon">
	                            <i class="fa fa-list-ul"></i>
	                            </span>
	                            {{ form_dropdown('training_application[user_id]',$training_application_user_id_options, $record['training_application.user_id'], 'class="form-control select2me" data-placeholder="Select..." id="training_application-user_id"') }}
	                        </div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Training Type</label>
				<div class="col-md-7"><?php									                            		$db->select('type_id,training_type');
	                            			                            		$db->order_by('training_type', '0');
	                            		$db->where('deleted', '0');
	                            		$options = $db->get('training_type'); 	                            $training_application_training_type_options = array('' => 'Select...');
                        		foreach($options->result() as $option)
                        		{
                        			                        				$training_application_training_type_options[$option->type_id] = $option->training_type;
                        			                        		} ?>							<div class="input-group">
								<span class="input-group-addon">
	                            <i class="fa fa-list-ul"></i>
	                            </span>
	                            {{ form_dropdown('training_application[training_type]',$training_application_training_type_options, $record['training_application.training_type'], 'class="form-control select2me" data-placeholder="Select..." id="training_application-training_type"') }}
	                        </div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Date of Program (From)</label>
				<div class="col-md-7">							<div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
								<input type="text" class="form-control" name="training_application[date_from]" id="training_application-date_from" value="{{ $record['training_application.date_from'] }}" placeholder="Enter Date of Program (From)" readonly>
								<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
							</div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Date of Program (To)</label>
				<div class="col-md-7">							<div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
								<input type="text" class="form-control" name="training_application[date_to]" id="training_application-date_to" value="{{ $record['training_application.date_to'] }}" placeholder="Enter Date of Program (To)" readonly>
								<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
							</div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Training Course</label>
				<div class="col-md-7"><?php									                            		$db->select('course_id,course');
	                            			                            		$db->order_by('course', '0');
	                            		$db->where('deleted', '0');
	                            		$options = $db->get('training_course'); 	                            $training_application_training_course_id_options = array('' => 'Select...');
                        		foreach($options->result() as $option)
                        		{
                        			                        				$training_application_training_course_id_options[$option->course_id] = $option->course;
                        			                        		} ?>							<div class="input-group">
								<span class="input-group-addon">
	                            <i class="fa fa-list-ul"></i>
	                            </span>
	                            {{ form_dropdown('training_application[training_course_id]',$training_application_training_course_id_options, $record['training_application.training_course_id'], 'class="form-control select2me" data-placeholder="Select..." id="training_application-training_course_id"') }}
	                        </div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Training Provider</label>
				<div class="col-md-7"><?php									                            		$db->select('provider_id,provider');
	                            			                            		$db->order_by('provider', '0');
	                            		$db->where('deleted', '0');
	                            		$options = $db->get('training_provider'); 	                            $training_application_training_provider_options = array('' => 'Select...');
                        		foreach($options->result() as $option)
                        		{
                        			                        				$training_application_training_provider_options[$option->provider_id] = $option->provider;
                        			                        		} ?>							<div class="input-group">
								<span class="input-group-addon">
	                            <i class="fa fa-list-ul"></i>
	                            </span>
	                            {{ form_dropdown('training_application[training_provider]',$training_application_training_provider_options, $record['training_application.training_provider'], 'class="form-control select2me" data-placeholder="Select..." id="training_application-training_provider"') }}
	                        </div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Venue</label>
				<div class="col-md-7">							<input type="text" class="form-control" name="training_application[venue]" id="training_application-venue" value="{{ $record['training_application.venue'] }}" placeholder="Enter Venue" /> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Total Training Hours</label>
				<div class="col-md-7">							<input type="text" class="form-control" name="training_application[total_training_hour]" id="training_application-total_training_hour" value="{{ $record['training_application.total_training_hour'] }}" placeholder="Enter Total Training Hours" /> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Estimate Investment (Subject for revision by HR):</label>
				<div class="col-md-7">							<input type="text" class="form-control" name="training_application[total_investment_pgsa]" id="training_application-total_investment_pgsa" value="{{ $record['training_application.total_investment_pgsa'] }}" placeholder="Enter Estimate Investment (Subject for revision by HR):" /> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Areas for Development</label>
				<div class="col-md-7">							<input type="text" class="form-control" name="training_application[areas_development]" id="training_application-areas_development" value="{{ $record['training_application.areas_development'] }}" placeholder="Enter Areas for Development" /> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Competency</label>
				<div class="col-md-7"><?php									                            		$db->select('category_id,category');
	                            			                            		$db->order_by('category', '0');
	                            		$db->where('deleted', '0');
	                            		$options = $db->get('training_category'); 	                            $training_application_competency_options = array('' => 'Select...');
                        		foreach($options->result() as $option)
                        		{
                        			                        				$training_application_competency_options[$option->category_id] = $option->category;
                        			                        		} ?>							<div class="input-group">
								<span class="input-group-addon">
	                            <i class="fa fa-list-ul"></i>
	                            </span>
	                            {{ form_dropdown('training_application[competency]',$training_application_competency_options, $record['training_application.competency'], 'class="form-control select2me" data-placeholder="Select..." id="training_application-competency"') }}
	                        </div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">NOTE: (If Training will exceed in 1 Month):</label>
				<div class="col-md-7">							<textarea class="form-control" name="training_application[note]" id="training_application-note" placeholder="Enter NOTE: (If Training will exceed in 1 Month):" rows="4">{{ $record['training_application.note'] }}</textarea> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Remaining Budget (Individual)</label>
				<div class="col-md-7">							<input type="text" class="form-control" name="training_application[remaining_itb]" id="training_application-remaining_itb" value="{{ $record['training_application.remaining_itb'] }}" placeholder="Enter Remaining Budget (Individual)" /> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Amount in Excess of ITB</label>
				<div class="col-md-7">							<input type="text" class="form-control" name="training_application[excess_itb]" id="training_application-excess_itb" value="{{ $record['training_application.excess_itb'] }}" placeholder="Enter Amount in Excess of ITB" /> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Re-allocation from</label>
				<div class="col-md-7"><?php									                            		$db->select('type_id,training_type');
	                            			                            		$db->order_by('training_type', '0');
	                            		$db->where('deleted', '0');
	                            		$options = $db->get('training_type'); 	                            $training_application_allocated_options = array('' => 'Select...');
                        		foreach($options->result() as $option)
                        		{
                        			                        				$training_application_allocated_options[$option->type_id] = $option->training_type;
                        			                        		} ?>							<div class="input-group">
								<span class="input-group-addon">
	                            <i class="fa fa-list-ul"></i>
	                            </span>
	                            {{ form_dropdown('training_application[allocated]',$training_application_allocated_options, $record['training_application.allocated'], 'class="form-control select2me" data-placeholder="Select..." id="training_application-allocated"') }}
	                        </div> 				</div>	
			</div>	</div>
</div>