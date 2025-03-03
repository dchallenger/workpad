<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Training Course</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
		<div class="portlet-body form">			<div class="form-group">
				<label class="control-label col-md-3">Course</label>
				<div class="col-md-7">							<input disabled="disabled" type="text" class="form-control" name="training_course[course]" id="training_course-course" value="{{ $record['training_course.course'] }}" placeholder="Enter Course" /> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Category</label>
				<div class="col-md-7"><?php									                            		$db->select('category_id,category');
	                            			                            		$db->order_by('category', '0');
	                            		$db->where('deleted', '0');
	                            		$options = $db->get('training_category'); 	                            $training_course_category_id_options = array('' => 'Select...');
                        		foreach($options->result() as $option)
                        		{
                        			                        				$training_course_category_id_options[$option->category_id] = $option->category;
                        			                        		} ?>							<div class="input-group">
								<span class="input-group-addon">
	                            <i class="fa fa-list-ul"></i>
	                            </span>
	                            {{ form_dropdown('training_course[category_id]',$training_course_category_id_options, $record['training_course.category_id'], 'disabled="disabled" class="form-control select2me" data-placeholder="Select..." id="training_course-category_id"') }}
	                        </div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Type</label>
				<div class="col-md-7"><?php									                            		$db->select('type_id,training_type');
	                            			                            		$db->order_by('training_type', '0');
	                            		$db->where('deleted', '0');
	                            		$options = $db->get('training_type'); 	                            $training_course_type_id_options = array('' => 'Select...');
                        		foreach($options->result() as $option)
                        		{
                        			                        				$training_course_type_id_options[$option->type_id] = $option->training_type;
                        			                        		} ?>							<div class="input-group">
								<span class="input-group-addon">
	                            <i class="fa fa-list-ul"></i>
	                            </span>
	                            {{ form_dropdown('training_course[type_id]',$training_course_type_id_options, $record['training_course.type_id'], 'disabled="disabled" class="form-control select2me" data-placeholder="Select..." id="training_course-type_id"') }}
	                        </div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Provider</label>
				<div class="col-md-7"><?php									                            		$db->select('provider_id,provider');
	                            			                            		$db->order_by('provider', '0');
	                            		$db->where('deleted', '0');
	                            		$options = $db->get('training_provider'); 	                            $training_course_provider_id_options = array('' => 'Select...');
                        		foreach($options->result() as $option)
                        		{
                        			                        				$training_course_provider_id_options[$option->provider_id] = $option->provider;
                        			                        		} ?>							<div class="input-group">
								<span class="input-group-addon">
	                            <i class="fa fa-list-ul"></i>
	                            </span>
	                            {{ form_dropdown('training_course[provider_id]',$training_course_provider_id_options, $record['training_course.provider_id'], 'disabled="disabled" class="form-control select2me" data-placeholder="Select..." id="training_course-provider_id"') }}
	                        </div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Facilitator</label>
				<div class="col-md-7">							<input disabled="disabled" type="text" class="form-control" name="training_course[facilitator]" id="training_course-facilitator" value="{{ $record['training_course.facilitator'] }}" placeholder="Enter Facilitator" /> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Is Planned?</label>
				<div class="col-md-7">							<div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
						    	<input disabled="disabled" type="checkbox" value="1" @if( $record['training_course.planned'] ) checked="checked" @endif name="training_course[planned][temp]" id="training_course-planned-temp" class="dontserializeme toggle"/>
						    	<input type="hidden" name="training_course[planned]" id="training_course-planned" value="<?php echo $record['training_course.planned'] ? 1 : 0 ?>"/>
							</div> 				</div>	
			</div>			

			<div class="form-group">
				<label class="control-label col-md-3">Position</label>
				<div class="col-md-7"><?php									                            		
				$db->select('position_id,position');
				$db->order_by('position', '0');
				$db->where('deleted', '0');
				$options = $db->get('users_position'); 	                            
				$training_course_position_id_options = array();
                        		foreach($options->result() as $option)
                        		{
                    				$training_course_position_id_options[$option->position_id] = $option->position;
	                    		} ?>							

                        	<div class="input-group">
								<span class="input-group-addon">
	                            <i class="fa fa-list-ul"></i>
	                            
	                            </span>
	                            {{ form_dropdown('training_course[position_id][]',$training_course_position_id_options, explode(',', $record['training_course.position_id']), 'disabled="disabled" class="select2me form-control " data-placeholder="Select Positions" id="training_course-position_id" multiple') }}
	                        </div> 	
	                       <!--  <textarea class="form-control" name="training_calendar[feedback_category_id]" id="training_calendar-feedback_category_id" placeholder="Enter " disabled="disabled" rows="4"><?php echo implode(", ", $array_feedback) ; ?></textarea> 	 -->	
	                    </div>	
			</div> 
				</div>
</div><div class="portlet">
	<div class="portlet-title">
		<div class="caption">Bond Setup</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
		<div class="portlet-body form">			<div class="form-group">
				<label class="control-label col-md-3">With Bond</label>
				<div class="col-md-7">							<div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
						    	<input disabled="disabled" type="checkbox" value="1" @if( $record['training_course.with_bond'] ) checked="checked" @endif name="training_course[with_bond][temp]" id="training_course-with_bond-temp" class="dontserializeme toggle"/>
						    	<input type="hidden" name="training_course[with_bond]" id="training_course-with_bond" value="<?php echo $record['training_course.with_bond'] ? 1 : 0 ?>"/>
							</div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Cost</label>
				<div class="col-md-7">							<input disabled="disabled" type="text" class="form-control" name="training_course[cost]" id="training_course-cost" value="{{ $record['training_course.cost'] }}" placeholder="Enter Cost" /> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Length of Service</label>
				<div class="col-md-7">							<input disabled="disabled" type="text" class="form-control" name="training_course[length_of_service]" id="training_course-length_of_service" value="{{ $record['training_course.length_of_service'] }}" placeholder="Enter Length of Service" /> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Remarks</label>
				<div class="col-md-7">							<textarea disabled="disabled" class="form-control" name="training_course[remarks]" id="training_course-remarks" placeholder="Enter Remarks" rows="4">{{ $record['training_course.remarks'] }}</textarea> 				</div>	
			</div>	</div>
</div>