<div class="portlet">
	<div class="portlet-title">
		<div class="caption">External Program Application Form</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">			
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Employee</label>
			<div class="col-md-7">
				<?php
					$db->select('user_id,full_name');
                    $db->order_by('full_name', '0');
                    $db->where('deleted', '0');
                    $options = $db->get('users');
                    $training_application_user_id_options = array('' => '');
                    foreach($options->result() as $option) {
                    	$training_application_user_id_options[$option->user_id] = $option->full_name;
                    } 
                ?>							
        		<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
                    {{ form_dropdown('training_application[user_id]',$training_application_user_id_options, $record['training_application.user_id'], 'class="form-control select2me" data-placeholder="Select..." id="training_application-user_id"') }}
                </div> 				
            </div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Training Type</label>
			<div class="col-md-7">
				<?php
					$db->select('type_id,training_type');
                    $db->order_by('training_type', '0');
                    $db->where('deleted', '0');
                    $options = $db->get('training_type'); 	                            
                    $training_application_training_type_options = array('' => '');
                    foreach($options->result() as $option) {
                    	$training_application_training_type_options[$option->type_id] = $option->training_type;
                	} 
                ?>
                <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
                    {{ form_dropdown('training_application[training_type]',$training_application_training_type_options, $record['training_application.training_type'], 'class="form-control select2me" data-placeholder="Select..." id="training_application-training_type"') }}
                </div> 				
            </div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Date of Program (From)</label>
			<div class="col-md-7">							
				<div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
					<input type="text" class="form-control" name="training_application[date_from]" id="training_application-date_from" value="{{ $record['training_application.date_from'] }}" placeholder="Enter Date of Program (From)" readonly>
						<span class="input-group-btn"><button class="btn default" type="button"><i class="fa fa-calendar"></i></button></span>
				</div>
			</div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Date of Program (To)</label>
			<div class="col-md-7">							
				<div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
					<input type="text" class="form-control" name="training_application[date_to]" id="training_application-date_to" value="{{ $record['training_application.date_to'] }}" placeholder="Enter Date of Program (To)" readonly>
					<span class="input-group-btn"><button class="btn default" type="button"><i class="fa fa-calendar"></i></button></span>
				</div> 				
			</div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Training Course</label>
			<div class="col-md-7">
			<?php
				$db->select('course_id,course');
                $db->order_by('course', '0');
                $db->where('deleted', '0');
                $options = $db->get('training_course'); 	                            
                $training_application_training_course_id_options = array('' => '');
                foreach($options->result() as $option) {
                    $training_application_training_course_id_options[$option->course_id] = $option->course;
            	} 
            ?>	
            <div class="input-group">
				<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
                {{ form_dropdown('training_application[training_course_id]',$training_application_training_course_id_options, $record['training_application.training_course_id'], 'class="form-control select2me" data-placeholder="Select..." id="training_application-training_course_id"') }}
            </div>
        </div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3">Training Provider</label>
			<div class="col-md-7">
				<?php
					$db->select('provider_id,provider');
                    $db->order_by('provider', '0');
                    $db->where('deleted', '0');
                    $options = $db->get('training_provider');
                    $training_application_training_provider_options = array('' => '');
                    foreach($options->result() as $option) {
                    	$training_application_training_provider_options[$option->provider_id] = $option->provider;
                    } 
                ?>
                <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
                    {{ form_dropdown('training_application[training_provider]',$training_application_training_provider_options, $record['training_application.training_provider'], 'class="form-control select2me" data-placeholder="Select..." id="training_application-training_provider"') }}
                </div> 				
            </div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Venue</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="training_application[venue]" id="training_application-venue" value="{{ $record['training_application.venue'] }}" placeholder="Enter Venue" />
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Total Training Hours</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="training_application[total_training_hour]" id="training_application-total_training_hour" value="{{ $record['training_application.total_training_hour'] }}" placeholder="Enter Total Training Hours" />
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Estimate Investment (Subject for revision by HR):</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="training_application[total_investment_pgsa]" id="training_application-total_investment_pgsa" value="{{ $record['training_application.total_investment_pgsa'] }}" placeholder="Enter Estimate Investment (Subject for revision by HR):" />
			</div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3">Areas for Development</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="training_application[areas_development]" id="training_application-areas_development" value="{{ $record['training_application.areas_development'] }}" placeholder="Enter Areas for Development" />
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Competency</label>
			<div class="col-md-7">
				<?php
					$db->select('category_id,category');
                    $db->order_by('category', '0');
                    $db->where('deleted', '0');
                    $options = $db->get('training_category');
                    $training_application_competency_options = array('' => '');
                    	foreach($options->result() as $option) {
                    		$training_application_competency_options[$option->category_id] = $option->category;
                    	} 
                ?>
                <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
                    {{ form_dropdown('training_application[competency]',$training_application_competency_options, $record['training_application.competency'], 'class="form-control select2me" data-placeholder="Select..." id="training_application-competency"') }}
            	</div>
        	</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">NOTE: (If Training will exceed in 1 Month):</label>
			<div class="col-md-7">
				<textarea class="form-control" name="training_application[note]" id="training_application-note" placeholder="Enter NOTE: (If Training will exceed in 1 Month):" rows="4">{{ $record['training_application.note'] }}</textarea>
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Remaining Budget (Individual)</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="training_application[remaining_itb]" id="training_application-remaining_itb" value="{{ $record['training_application.remaining_itb'] }}" placeholder="Enter Remaining Budget (Individual)" />
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Amount in Excess of ITB</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="training_application[excess_itb]" id="training_application-excess_itb" value="{{ $record['training_application.excess_itb'] }}" placeholder="Enter Amount in Excess of ITB" />
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Re-allocation from</label>
			<div class="col-md-7">
				<?php
					$db->select('type_id,training_type');
                    $db->order_by('training_type', '0');
                    $db->where('deleted', '0');
                    $options = $db->get('training_type');
                    $training_application_allocated_options = array('' => '');
                    foreach($options->result() as $option) {
                    	$training_application_allocated_options[$option->type_id] = $option->training_type;
                	}
                ?>
                <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
                    {{ form_dropdown('training_application[allocated]',$training_application_allocated_options, $record['training_application.allocated'], 'class="form-control select2me" data-placeholder="Select..." id="training_application-allocated"') }}
                </div>
            </div>	
		</div>
	</div>
</div>
<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Training Objectives</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">
		<div class="objective_main_container">
			<div class="col-md-10">
				What do you need to learn/acquire from this program to help you to perform well?<br>
				<span class="text-muted small">(Please rate current level of competencies - knowledge, skills abilities in this areas/objectives)</span>				
			</div>
			<div class="col-md-2 actions text-right" style="padding-right:0">
				<button type="button" class="btn btn-default add_objective"><i class="fa fa-plus"></i> Add Objectives</button>					
			</div>
			<div class="objective_container">
				@if(isset($objective_info_object) && $objective_info_object && $objective_info_object->num_rows() > 0)
					@foreach($objective_info_object->result() as $row)
						<div class="portlet">
							<input type="hidden" class="form-control" name="training_application_objective[training_application_objective_id][]" value="{{$row->training_application_objective_id}}" />
							<div class="portlet-title">
								<div class="caption">&nbsp;</div>
								<div class="tools"><a class="text-muted delete_objective" href="javascript:void(0)" style="margin-botom:-15px;"><i class="fa fa-trash-o"></i> Delete</a></div>
							</div>
							<div class="portlet-body form">				
								<div class="form-group">
									<label class="control-label col-md-3"><span class="required">* </span>Objective</label>
									<div class="col-md-7">
										<input type="text" class="form-control" name="training_application_objective[objective][]" id="training_application-venue" value="{{$row->objective}}" placeholder="Enter Objective" />
									</div>	
								</div>
								<div class="form-group">
									<label class="control-label col-md-3"><span class="required">* </span>Rating (Please do self-rate)</label>
									<div class="col-md-7">
										<?php
											$db->select('training_rating_scale_id,CONCAT(training_rating_scale," - ",description) AS training_rating_scale',false);
							                $db->order_by('training_rating_scale', '0');
							                $db->where('deleted', '0');
							                $options = $db->get('training_rating_scale');
							                $training_application_training_rating_scale_options = array('' => '');
							                foreach($options->result() as $option) {
							                	$training_application_training_rating_scale_options[$option->training_rating_scale_id] = $option->training_rating_scale;
							                } 
							            ?>
							            <div class="input-group">
											<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
							                {{ form_dropdown('training_application_objective[training_rating_scale_id][]',$training_application_training_rating_scale_options, $row->training_rating_scale_id, 'class="form-control select2me" data-placeholder="Select..." id="training_application-training_objective"') }}
							            </div> 				
							        </div>	
								</div>						
							</div>
						</div>					
					@endforeach
				@endif
			</div>
			<br><br>
			<hr>
		</div>
		<div class="action_plan_main_container">
			<div class="col-md-10">
				How do you intend to apply your learning from this program back to your job?
			</div>
			<div class="col-md-2 actions text-right" style="padding-right:0">
				<button type="button" class="btn btn-default add_action_plan"><i class="fa fa-plus"></i> Add Action Plan</button>					
			</div>
			<div class="action_plan_container">
				@if(isset($action_plan_info_object) && $action_plan_info_object && $action_plan_info_object->num_rows() > 0)
					@foreach($action_plan_info_object->result() as $row)
						<div class="portlet">
							<input type="hidden" class="form-control" name="training_application_action_pan[training_application_action_plan_id][]" value="{{$row->training_application_action_plan_id}}" />
							<div class="portlet-title">
								<div class="caption">&nbsp;</div>
								<div class="tools"><a class="text-muted delete_action_plan" href="javascript:void(0)" style="margin-botom:-15px;"><i class="fa fa-trash-o"></i> Delete</a></div>
							</div>
							<div class="portlet-body form">				
								<div class="form-group">
									<label class="control-label col-md-3"><span class="required">* </span>Action Plan</label>
									<div class="col-md-7">
										<input type="text" class="form-control" name="training_application_action_pan[action_plan][]" id="training_application-venue" value="{{$row->action_plan}}" placeholder="Enter Action Plan" />
									</div>	
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Remarks</label>
									<div class="col-md-7">
										<textarea class="form-control" name="training_application_action_pan[remarks][]" id="training_application-note" placeholder="Enter Remarks" rows="4">{{$row->remarks}}</textarea>
									</div>	
								</div>					
							</div>
						</div>					
					@endforeach
				@endif					
			</div>
			<br><br>
			<hr>			
		</div>
		<div class="knowledge_transfer_main_container">
			<div class="col-md-10">
				How do you intend to transfer your knowledge/best practices gained from this program to your team?
			</div>
			<div class="col-md-2 actions text-right" style="padding-right:0">
				<button type="button" class="btn btn-default add_knowledge_transfer"><i class="fa fa-plus"></i> Add Knowledge Transfer</button>					
			</div>				
			<div class="knowledge_transfer_container">
				@if(isset($knowledge_transfer_info_object) && $knowledge_transfer_info_object && $knowledge_transfer_info_object->num_rows() > 0)
					@foreach($knowledge_transfer_info_object->result() as $row)
						<div class="portlet">
							<input type="hidden" class="form-control" name="training_application_knowledge_transfer[training_application_knowledge_transfer_id][]" value="{{$row->training_application_knowledge_transfer_id}}" />
							<div class="portlet-title">
								<div class="caption">&nbsp;</div>
								<div class="tools"><a class="text-muted delete_knowledge_transfer" href="javascript:void(0)" style="margin-botom:-15px;"><i class="fa fa-trash-o"></i> Delete</a></div>
							</div>
							<div class="portlet-body form">	
								<div class="form-group">
									<label class="control-label col-md-3"><span class="required">* </span>Knowledge Transfer</label>
									<div class="col-md-7">
										<?php
											$db->select('training_knowledge_transfer_id,training_knowledge_transfer');
						                    $db->order_by('training_knowledge_transfer', '0');
						                    $db->where('deleted', '0');
						                    $options = $db->get('training_knowledge_transfer');
						                    $training_application_training_knowledge_transfer_options = array('' => 'Select...');
						                    foreach($options->result() as $option) {
						                    	$training_application_training_knowledge_transfer_options[$option->training_knowledge_transfer_id] = $option->training_knowledge_transfer;
						                    } 
						                ?>
						                <div class="input-group">
											<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
						                    <?php echo form_dropdown('training_application_knowledge_transfer[training_knowledge_transfer_id][]',$training_application_training_knowledge_transfer_options, $row->training_application_knowledge_transfer_id, 'class="form-control select2me" data-placeholder="Select..." id="training_application-knowledge_transfer"') ?>
						                </div> 				
						            </div>	
								</div>								
								<div class="form-group">
									<label class="control-label col-md-3">Remarks</label>
									<div class="col-md-7">
										<textarea class="form-control" name="training_application_knowledge_transfer[remarks][]" id="training_application-note" placeholder="Enter Remarks" rows="4">{{$row->remarks}}</textarea>
									</div>	
								</div>					
							</div>
						</div>					
					@endforeach
				@endif				
			</div>
			<br><br>
			<hr>			
		</div>		
	</div>
</div>
<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Available Training Budget (HRA Use Only)</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">
		<div class="form-group">
			<label class="control-label col-md-3">With Service Bond</label>
			<div class="col-md-7">							
				<div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
			    	<input type="checkbox" value="1" @if( $record['training_application.service_bond'] ) checked="checked" @endif name="training_application[service_bond][temp]" id="training_application-service_bond-temp" class="dontserializeme toggle"/>
			    	<input type="hidden" name="training_application[service_bond]" id="training_application-service_bond" value="<?php echo $record['training_application.service_bond'] ? 1 : 0 ?>"/>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Supplemental Budget</label>
			<div class="col-md-7">							
				<input type="text" class="form-control" name="training_application[stb]" id="training_application-stb" value="{{ $record['training_application.stb'] }}" placeholder="Enter Supplemental Budget" />
			</div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3">Investment</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="training_application[investment]" id="training_application-investment" value="{{ $record['training_application.investment'] }}" placeholder="Enter Investment" />
			</div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3">Remaining Budget (Supplemental)</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="training_application[remaining_stb]" id="training_application-remaining_stb" value="{{ $record['training_application.remaining_stb'] }}" placeholder="Enter Remaining Budget (Supplemental)" />
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Individual Training Budget</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="training_application[itb]" id="training_application-itb" value="{{ $record['training_application.itb'] }}" placeholder="Enter Individual Training Budget" />
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Amount in Excess of Supplemental</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="training_application[excess_stb]" id="training_application-excess_stb" value="{{ $record['training_application.excess_stb'] }}" placeholder="Enter Amount in Excess of Supplemental" />
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Not Budgeted / Re-allocation</label>
			<div class="col-md-7">
				<div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
				   	<input type="checkbox" value="1" @if( $record['training_application.budgeted'] ) checked="checked" @endif name="training_application[budgeted][temp]" id="training_application-budgeted-temp" class="dontserializeme toggle"/>
				   	<input type="hidden" name="training_application[budgeted]" id="training_application-budgeted" value="<?php echo $record['training_application.budgeted'] ? 1 : 0 ?>"/>
				</div>
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Common Training Budget</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="training_application[ctb]" id="training_application-ctb" value="{{ $record['training_application.ctb'] }}" placeholder="Enter Common Training Budget" />
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Remaining Budget (Common)</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="training_application[remaining_ctb]" id="training_application-remaining_ctb" value="{{ $record['training_application.remaining_ctb'] }}" placeholder="Enter Remaining Budget (Common)" />
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">% of IDP</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="training_application[idp_completion]" id="training_application-idp_completion" value="{{ $record['training_application.idp_completion'] }}" placeholder="Enter % of IDP" />
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Amount in Excess of CTB</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="training_application[excess_ctb]" id="training_application-excess_ctb" value="{{ $record['training_application.excess_ctb'] }}" placeholder="Enter Amount in Excess of CTB" />
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Remarks (Approver)</label>
			<div class="col-md-7">
				<textarea class="form-control" name="training_application[approver_remarks]" id="training_application-approver_remarks" placeholder="Enter Remarks (Approver)" rows="4">{{ $record['training_application.approver_remarks'] }}</textarea>
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Remarks (HR)</label>
			<div class="col-md-7">
				<textarea class="form-control" name="training_application[remarks]" id="training_application-remarks" placeholder="Enter Remarks (HR)" rows="4">{{ $record['training_application.remarks'] }}</textarea>
			</div>	
		</div>	
	</div>
</div>