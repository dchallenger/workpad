<form id="training-calendar-form">
	<div class="portlet">
		<div class="portlet-title">
			<div class="caption">Training Calendar</div>
			<div class="tools"><a class="collapse" href="javascript:;"></a></div>
		</div>
		<div class="portlet-body form">
			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Training Title</label>
				<div class="col-md-7">							
					<input type="text" class="form-control" name="training_calendar[training_title]" id="training_calendar-training_title" value="{{ $record['training_calendar.training_title'] }}" placeholder="Enter Training Title" />
				</div>	
			</div>			
			<div class="form-group">
					<label class="control-label col-md-3"><span class="required">* </span>Training Course</label>
					<div class="col-md-7"><?php									                            		
					$db->select('course_id,course');
					$db->order_by('course', '0');
		            $db->where('deleted', '0');
		            $options = $db->get('training_course'); 	                            
		            $training_calendar_course_id_options = array('' => '');

	        		foreach($options->result() as $option)
	        		{
	        			$training_calendar_course_id_options[$option->course_id] = $option->course;
	        		} ?>							
	            		<div class="input-group">
							<span class="input-group-addon">
	                        <i class="fa fa-list-ul"></i>
	                        </span>
	                        {{ form_dropdown('training_calendar[course_id]',$training_calendar_course_id_options, $record['training_calendar.course_id'], 'class="form-control select2me" data-placeholder="Select..." id="training_calendar-course_id"') }}
	                    </div> 				
	                </div>	
			</div>	

			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Training Type</label>
				<div class="col-md-7"><?php									                            		
				$db->select('calendar_type_id,calendar_type');
				$db->order_by('calendar_type', '0');
	            $db->where('deleted', '0');
	            $options = $db->get('training_calendar_type'); 	                            
	            $training_calendar_calendar_type_id_options = array('' => '');

	    		foreach($options->result() as $option)
	    		{
	    			$training_calendar_calendar_type_id_options[$option->calendar_type_id] = $option->calendar_type;
	    		} ?>							
	        		<div class="input-group">
						<span class="input-group-addon">
	                    <i class="fa fa-list-ul"></i>
	                    </span>
	                    {{ form_dropdown('training_calendar[calendar_type_id]',$training_calendar_calendar_type_id_options, $record['training_calendar.calendar_type_id'], 'class="form-control select2me" data-placeholder="Select..." id="training_calendar-calendar_type_id"') }}
	                </div> 				
	            </div>	
			</div>

			<?php

				$training_course_info = "SELECT * FROM ww_training_course c 
					LEFT JOIN ww_training_provider p ON p.`provider_id` = c.`provider_id`
					LEFT JOIN ww_training_category cat ON cat.`category_id` = c.`category_id`
	                    			WHERE c.course_id  = '" . $record['training_calendar.course_id'] . "' ";

                $training_course_info = $db->query($training_course_info);

				if($training_course_info->num_rows() > 0){

					$training_provider = $training_course_info->row('provider');
					$training_category = $training_course_info->row('category');
					
				}

			?>
			<div class="form-group">
				<label class="control-label col-md-3">Training Provider</label>
				<div class="col-md-7">							
					<input type="text" class="form-control" name="" id="training_calendar-training_provider" value="<?php echo $record['training_calendar.training_provider'] ?>" readonly/> 				
					<input type="hidden" class="form-control" name="training_calendar[training_provider_id]" id="training_calendar-training_provider_id" value="<?php echo !empty($record['training_calendar.training_provider_id']) ? $record['training_calendar.training_provider_id'] : ''; ?>" placeholder="Enter Training Provider" readonly/> 				
				</div>	 
			</div>

			<div class="form-group">
				<label class="control-label col-md-3">Training Category</label>
				<div class="col-md-7">							
					<input type="text" class="form-control" name="" id="training_calendar-training_category" value="<?php echo $record['training_calendar.training_category'] ?>" readonly/> 				
					<input type="hidden" class="form-control" name="training_calendar[training_category_id]" id="training_calendar-training_category_id" value="<?php echo !empty($record['training_calendar.training_category_id']) ? $record['training_calendar.training_category_id'] : ''; ?>" placeholder="Enter Training Category" readonly/> 				
				</div>	
			</div>

			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Minimum Trainee Capacity</label>
				<div class="col-md-7">							
					<input type="text" class="form-control" name="training_calendar[training_capacity]" id="training_calendar-training_capacity" value="{{ $record['training_calendar.training_capacity'] }}" placeholder="Enter Minimum Trainee Capacity" data-inputmask="'mask': '9', 'repeat': 2, 'greedy' : false"/> 				
				</div>	
			</div>

			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Maximum Trainee Capacity</label>
				<div class="col-md-7">							
					<input type="text" class="form-control" name="training_calendar[min_training_capacity]" id="training_calendar-min_training_capacity" value="{{ $record['training_calendar.min_training_capacity'] }}" placeholder="Enter Maximum Trainee Capacity" data-inputmask="'mask': '9', 'repeat': 2, 'greedy' : false"/> 				
				</div>	
			</div>

			<div class="form-group">
				<label class="control-label col-md-3">Venue</label>
				<div class="col-md-7">							
					<textarea class="form-control" name="training_calendar[venue]" id="training_calendar-venue" placeholder="Enter Venue" rows="4">{{ $record['training_calendar.venue'] }}</textarea> 				
				</div>	
			</div>

			<div class="form-group">
				<label class="control-label col-md-3">Training Course Description</label>
				<div class="col-md-7">							
					<textarea class="form-control" name="training_calendar[topic]" id="training_calendar-topic" placeholder="Enter Topic" rows="4">{{ $record['training_calendar.topic'] }}</textarea> 				
				</div>	
			</div>

			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>To Be Announce</label>
				<div class="col-md-7">							
					<div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
				    	<input type="checkbox" value="1" @if( $record['training_calendar.tba'] ) checked="checked" @endif name="training_calendar[tba][temp]" id="training_calendar-tba-temp" class="dontserializeme toggle"/>
				    	<input type="hidden" name="training_calendar[tba]" id="training_calendar-tba" value="<?php echo $record['training_calendar.tba'] ? 1 : 0 ?>"/>
					</div> 				
				</div>	
			</div>

			<div class="form-group">
				<label class="control-label col-md-3">Equipment</label>
				<div class="col-md-7">							
					<input type="text" class="form-control" name="training_calendar[equipment]" id="training_calendar-equipment" value="{{ $record['training_calendar.equipment'] }}" placeholder="Enter Equipment" /> 				
				</div>	
			</div>

			<div class="form-group">
	            <label class="control-label col-md-3">Registration Date</label>
	            <div class="col-md-7">
	                <div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
	                    <input type="text" class="form-control" name="training_calendar[registration_date]" id="training_calendar-registration_date" value="{{ $record['training_calendar.registration_date'] }}" placeholder="Enter Date" >
	                    <span class="input-group-btn">
							<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
						</span>
	                </div>
	            </div>
	        </div>

	        <div class="form-group">
				<label class="control-label col-md-3">Cost Per Pax</label>
				<div class="col-md-7">							
					<input type="text" class="form-control" name="training_calendar[cost_per_pax]" id="training_calendar-cost_per_pax" value="{{ $record['training_calendar.cost_per_pax'] }}" placeholder="Enter Cost Per Pax" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/> 				
				</div>	
			</div>

			<div class="form-group">
	            <label class="control-label col-md-3">Last Registration Date</label>
	            <div class="col-md-7">
	                <div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
	                    <input type="text" class="form-control" name="training_calendar[last_registration_date]" id="training_calendar-last_registration_date" value="{{ $record['training_calendar.last_registration_date'] }}" placeholder="Enter Date" >
	                    <span class="input-group-btn">
							<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
						</span>
	                </div>
	            </div>
	        </div>

	        <div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Evaluation Form</label>
				<div class="col-md-7"><?php									                            		
				$db->select('evaluation_template_id,title');
				$db->order_by('title', '0');
				$db->where('deleted', '0');
				$options = $db->get('training_evaluation_template'); 	                            
				$training_evaluation_template_id_options = array();
	            		foreach($options->result() as $option)
	            		{
	        				$training_evaluation_template_id_options[$option->evaluation_template_id] = $option->title;
	            		} ?>							

	            	<div class="input-group">
						<span class="input-group-addon">
	                    <i class="fa fa-list-ul"></i>
	                    </span>
	                    {{ form_dropdown('training_calendar[evaluation_template_id][]',$training_evaluation_template_id_options, explode(',', $record['training_calendar.evaluation_template_id']), 'class="select2me form-control " data-placeholder="Select Feedback Category" id="training_calendar-feedback_category_id" multiple') }}
	                </div> 			
	            </div>	
			</div>

			<div class="form-group">
	            <label class="control-label col-md-3">Publish Date</label>
	            <div class="col-md-7">
	                <div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
	                    <input type="text" class="form-control" name="training_calendar[publish_date]" id="training_calendar-publish_date" value="{{ $record['training_calendar.publish_date'] }}" placeholder="Enter Date" >
	                    <span class="input-group-btn">
							<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
						</span>
	                </div>
	            </div>
	        </div>

	        <div class="form-group hidden">
				<label class="control-label col-md-3">Level 2 and 3 Evaluation</label>
				<div class="col-md-7"><?php									                            		
				$db->select('training_revalida_master_id,revalida_type');
				$db->order_by('revalida_type', '0');
	            $db->where('deleted', '0');
	            $options = $db->get('training_revalida_master'); 	                            
	            $training_calendar_training_revalida_master_id_options = array('' => 'Select...');

	    		foreach($options->result() as $option)
	    		{
	    			$training_calendar_training_revalida_master_id_options[$option->training_revalida_master_id] = $option->revalida_type;
	    		} ?>							
	        		<div class="input-group">
						<span class="input-group-addon">
	                    <i class="fa fa-list-ul"></i>
	                    </span>
	                    {{ form_dropdown('training_calendar[training_revalida_master_id]',$training_calendar_training_revalida_master_id_options, $record['training_calendar.training_revalida_master_id'], 'class="form-control select2me" data-placeholder="Select..." id="training_calendar-training_revalida_master_id"') }}
	                </div> 				
	            </div>	
			</div>

			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Certification</label>
				<div class="col-md-7">							
					<div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
				    	<input type="checkbox" value="1" @if( $record['training_calendar.with_certification'] ) checked="checked" @endif name="training_calendar[with_certification][temp]" id="training_calendar-with_certification-temp" class="dontserializeme toggle"/>
				    	<input type="hidden" name="training_calendar[with_certification]" id="training_calendar-with_certification" value="<?php echo $record['training_calendar.with_certification'] ? 1 : 0 ?>"/>
					</div> 				
				</div>	
			</div>

			<div class="form-group">
	            <label class="control-label col-md-3">Evaluation Date</label>
	            <div class="col-md-7">
	                <div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
	                    <input type="text" class="form-control" name="training_calendar[revalida_date]" id="training_calendar-revalida_date" value="{{ $record['training_calendar.revalida_date'] }}" placeholder="Enter Date" >
	                    <span class="input-group-btn">
							<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
						</span>
	                </div>
	            </div>
	        </div>

	        <div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Planned?</label>
				<div class="col-md-7">							
					<div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
				    	<input type="checkbox" value="1" @if( $record['training_calendar.planned'] ) checked="checked" @endif name="training_calendar[planned][temp]" id="training_calendar-planned-temp" class="dontserializeme toggle"/>
				    	<input type="hidden" name="training_calendar[planned]" id="training_calendar-planned" value="<?php echo $record['training_calendar.planned'] ? 1 : 0 ?>"/>
					</div> 				
				</div>	
			</div>
		</div>
	</div>

	<div class="portlet">
		<div class="portlet-title">
			<div class="caption">Training Session</div>
			<div class="tools"><a class="collapse" href="javascript:;"></a></div>
		</div>

		<div class="portlet-body form">	
			<div class="form-group">
				<button type="button" class="btn green btn-sm pull-right" id="add_session"><i class="fa fa-plus"></i> Add Training Session</button>
			</div>
		

		<div id="sessionsDiv" style="display:none;">
			<!-- <input type="hidden" name="session_count" id="session_count" value="0"> -->
			<div class="form-multiple-add-session">
				<fieldset>
					<!-- Check if there is already sessions-->
					<?php 
						if(!empty($session_tab)){ 
							$session_count = 0;
							foreach($session_tab as $session){
					?>
								<div class="add_more_session_field">
									<div class="portlet">
								        <div class="portlet-title">
								            <div class="tools">
								                <a class="text-muted delete_session" href="javascript:void(0)" style="margin-botom:-15px;"><i class="fa fa-trash-o"></i> Delete</a>
								            </div>
								        </div>
								        <div class="portlet-body form">
							                <!-- BEGIN FORM-->
							                <!-- <form class="form-horizontal session_form" id="session-form"> -->
							                	<input type="hidden" name="training_calendar_id" value="<?php echo ( isset($training_calendar_id) && !empty($training_calendar_id)) ? $training_calendar_id : ''; ?>" />
							                	<input type="hidden" name="session[calendar_session_id][<?php echo $session_count; ?>]" value="<?php echo ( isset($session) && !empty($session)) ? $session['calendar_session_id'] : ''; ?>" />
							                    
							                    <div class="form-body">
								                    <div class="form-group">
								                        <label class="control-label col-md-3">Session No.</label>
								                        <div class="col-md-6">
								                            <input type="text" class="form-control" name="session[session_no][<?php echo $session_count; ?>]" id="session_no" 
								                            value="{{ $session['session_no'] }}" placeholder="Enter Session No"/>
								                        </div>
								                    </div>
								                    <div class="form-group">
								                        <label class="control-label col-md-3">Instructor</label>
								                        <div class="col-md-6">
								                            <input type="text" class="form-control" name="session[instructor][<?php echo $session_count; ?>]" id="instructor" 
								                            value="{{ $session['instructor'] }}" placeholder="Enter Instructor"/>
								                        </div>
								                    </div>
								                    <div class="form-group">
											            <label class="control-label col-md-3">Training Date</label>
											            <div class="col-md-7">
											                <div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
											                    <input type="text" class="form-control session_date" name="session[session_date][<?php echo $session_count; ?>]" id="session_date" value="{{ date('F d, Y',strtotime($session['session_date'])) }}" placeholder="Enter Date">
											                    <span class="input-group-btn">
																	<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
																</span>
											                </div>
											            </div>
											        </div>

								                    <div class="form-group">
								                        <label class="control-label col-md-3">Session Time</label>
								                        <div class="col-md-6">
								                        </div>
								                    </div>

								                    <div class="form-group">
														<label class="control-label col-md-3">From</label>
														<div class="col-md-7">
															<div class="input-group bootstrap-timepicker">                                       
																<input type="text" class="form-control timepicker-default session-time_start" name="session[sessiontime_from][<?php echo $session_count; ?>]" id="session-time_start" value="{{ date('h:i A',strtotime($session['sessiontime_from'])) }}" />
																<span class="input-group-btn">
																	<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
																</span>
															</div>
														</div>	
													</div>
													<div class="form-group">
														<label class="control-label col-md-3">To</label>
														<div class="col-md-7">
															<div class="input-group bootstrap-timepicker">                                       
																<input type="text" class="form-control timepicker-default session-time_end" name="session[sessiontime_to][<?php echo $session_count; ?>]" id="session-time_end" value="{{ date('h:i A',strtotime($session['sessiontime_to'])) }}" />
																<span class="input-group-btn">
																	<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
																</span>
															</div>
														</div>	
													</div>

								                    <div class="form-group">
								                        <label class="control-label col-md-3">Break Time</label>
								                        <div class="col-md-6">
								                        </div>
								                    </div>

								                    <div class="form-group">
														<label class="control-label col-md-3">From</label>
														<div class="col-md-7">
															<div class="input-group bootstrap-timepicker">                                       
																<input type="text" class="form-control timepicker-default break-time_start" name="session[breaktime_from][<?php echo $session_count; ?>]" id="break-time_start" value="{{ date('h:i A',strtotime($session['breaktime_from'])) }}" />
																<span class="input-group-btn">
																	<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
																</span>
															</div>
														</div>	
													</div>
													<div class="form-group">
														<label class="control-label col-md-3">To</label>
														<div class="col-md-7">
															<div class="input-group bootstrap-timepicker">                                       
																<input type="text" class="form-control timepicker-default break-time_end" name="session[breaktime_to][<?php echo $session_count; ?>]" id="break-time_end" value="{{ date('h:i A',strtotime($session['breaktime_to'])) }}" />
																<span class="input-group-btn">
																	<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
																</span>
															</div>
														</div>	
													</div>
									    		</div>
							                <!-- </form> -->
								        </div>
							        </div>
							    </div>
					<?php 
								$session_count++;
							} 
						}
					?>
				</fieldset>
		</div>
		<!-- <input type="hidden" id="training_calendar_id" name="training_calendar_id" value="<?php echo ( isset($training_calendar_id) && !empty($training_calendar_id)) ? $training_calendar_id : ''; ?>" /> -->
		<input type="hidden" class="session_count" value="<?php echo ( isset($session_count) && ( $session_count > 0 ) ? $session_count : 0 ); ?>" />
		</div>
	</div>

	<div class="portlet">
		<div class="portlet-title">
			<div class="caption">Training Cost</div>
			<div class="tools"><a class="collapse" href="javascript:;"></a></div>
		</div>
		<div class="portlet-body form">	
			<div class="form-group">
				<button type="button" class="btn green btn-sm pull-right" id="add_training_cost"><i class="fa fa-plus"></i> Add Training Cost</button>
			</div>
		</div>
		<div class="portlet-body form">	
			<div id='training_cost' class="form-multiple-add-training-cost">
				<?php 
					if(!empty($training_cost_tab)){
						$cost_count = 0;
						foreach($training_cost_tab as $training_cost){
				?>
					<div class="add_more_training_cost">
						<div class="portlet">
						        <div class="portlet-title">
						            <div class="tools">
						                <a class="text-muted delete_training_cost" href="javascript:void(0)" style="margin-botom:-15px;"><i class="fa fa-trash-o"></i> Delete</a>
						            </div>
						        </div>
						            <div class="portlet-body form">
						                <!-- BEGIN FORM-->
						           
						                    <div class="form-body">
	                    						<input type="hidden" name="training_cost[calendar_budget_id][<?php echo $cost_count; ?>]" value="<?php echo ( isset($training_cost) && !empty($training_cost)) ? $training_cost['calendar_budget_id'] : ''; ?>" />
						                        <div class="form-group">
						                            <label class="control-label col-md-3">Training Cost Name <span class="required">*</span></label>
<!-- 						                            <div class="col-md-7">
						                            	<?php
						                                    $training_cost_options = array('' => 'Select');
						                                    $training_costs = $db->get_where( 'training_source', array('deleted' => 0) );
						                                    foreach( $training_costs->result() as $row )
						                                    {
						                                        $training_cost_options[$row->source_id] =  $row->source;
						                                    }
						                                ?>
						                                <?php echo form_dropdown('training_cost[source_id]['.$cost_count.']',$training_cost_options, $training_cost['source_id'], 'class="form-control"'); ?>
						                            </div> -->
						                            <div class="col-md-7">
						                                <input type="text" class="form-control"  name="training_cost[cost_name][<?php echo $cost_count; ?>]" value="{{$training_cost['cost_name']}}">
						                            </div>							                            
						                        </div>

						                        <div class="form-group">
						                            <label class="control-label col-md-3">Remarks</label>
						                            <div class="col-md-7">
						                                <textarea class="form-control" name="training_cost[remarks][<?php echo $cost_count; ?>]">{{ $training_cost['remarks'] }}</textarea>
						                            </div>
						                        </div>
						                        
						                        <div class="form-group">
						                            <label class="control-label col-md-3">Cost</label>
						                            <div class="col-md-7">
						                                <input type="text" class="form-control cost"  name="training_cost[cost][<?php echo $cost_count; ?>]"  value="{{ $training_cost['cost'] }}" data-inputmask="'alias': 'integer', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false">
						                            </div>
						                        </div>

						                        <div class="form-group">
						                            <label class="control-label col-md-3">No. of Pax <span class="required">*</span></label>
						                            <div class="col-md-7">
						                                <input type="text" class="form-control pax"  name="training_cost[pax][<?php echo $cost_count; ?>]" value="{{ $training_cost['pax'] }}" data-inputmask="'alias': 'integer', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false">
						                            </div>
						                        </div>

						                        <div class="form-group">
						                            <label class="control-label col-md-3">Total </label>
						                            <div class="col-md-7">
						                                <input type="text" class="form-control total"  name="training_cost[total][<?php echo $cost_count; ?>]" value="{{ $training_cost['total'] }}" data-inputmask="'alias': 'integer', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false">
						                            </div>
						                        </div>

						                    </div>
						                <!-- END FORM--> 
						            </div>
						        </div>
						</div>

					<?php 
						$cost_count++;
						}
					}
					?>
				<input type="hidden" class="cost_count" value="<?php echo ( isset($cost_count) && ( $cost_count > 0 ) ? $cost_count : 0 ); ?>" />
			</div>

			<div >
			        <div class="form-group">
			            <label class="control-label col-md-3">Total Item Cost:</label>
			            <div class="col-md-7">               
			                <input type="text" class="form-control total_cost" style="width:20%;" value="{{ $record['training_calendar.total_cost'] }}" readonly="" name="training_calendar[total_cost]">
			            </div>                                    
			        </div>
			        <div class="form-group">
			            <label class="control-label col-md-3">Total Items:</label>
			            <div class="col-md-7">               
			                <input type="text" class="form-control total_pax" style="width:20%;" value="{{ $record['training_calendar.total_pax'] }}" readonly="" name="training_calendar[total_pax]">
			            </div>                                    
			        </div>
			</div>


		</div>
	</div>

	<div class="portlet">
		<div class="portlet-title">
			<div class="caption">Training Participants</div>
			<div class="tools"><a class="collapse" href="javascript:;"></a></div>
		</div>
		<div class="portlet-body form">	
			<div class="form-group">
				<label class="control-label col-md-3">Company</label>
				<div class="col-md-6">
					<?php
						$db->select('company_id,company');
						$db->where('deleted', '0');
	            		$options = $db->get('users_company');

						$company_id_options = array();
	            		foreach($options->result() as $option)
	            		{
	            			$company_id_options[$option->company_id] = $option->company;
	            		} 
	            	?>
	                <div class="input-group">
						<span class="input-group-addon">
	                    <i class="fa fa-list-ul"></i>
	                    </span>
	                    <?php echo form_dropdown('training_calendar[company_id][]',$company_id_options, explode(',', $record['training_calendar.company_id']), 'class="form-control select2me" data-placeholder="Select..." multiple="multiple" id="training_calendar-company_id"') ?>
	                </div>
	        	</div>
	        </div>
			<div class="form-group">
				<label class="control-label col-md-3">Division</label>
				<div class="col-md-6">
					<?php
						$db->select('division_id,division,division_code');
						$db->where('deleted', '0');
	            		$options = $db->get('users_division');

						$division_id_options = array();
	            		foreach($options->result() as $option)
	            		{
	            			$division_id_options[$option->division_id] = $option->division. ' ('.get_division_code($option->division_code,'-').')';
	            		} 
	            	?>
	                <div class="input-group">
						<span class="input-group-addon">
	                    <i class="fa fa-list-ul"></i>
	                    </span>
	                    <?php echo form_dropdown('training_calendar[division_id][]',$division_id_options, explode(',', $record['training_calendar.division_id']), 'class="form-control select2me" data-placeholder="Select..." multiple="multiple" id="training_calendar-division_id"') ?>
	                </div>
	        	</div>
	        </div>	 	        	
			<div class="form-group">
				<label class="control-label col-md-3">Department</label>
				<div class="col-md-6">
					<?php
						$db->select('department_id,department');
						$db->where('deleted', '0');
	            		$options = $db->get('users_department');

						$department_id_options = array();
	            		foreach($options->result() as $option)
	            		{
	            			$department_id_options[$option->department_id] = $option->department;
	            		} 
	            	?>
	                <div class="input-group">
						<span class="input-group-addon">
	                    <i class="fa fa-list-ul"></i>
	                    </span>
	                    <?php echo form_dropdown('training_calendar[department_id][]',$department_id_options, explode(',', $record['training_calendar.department_id']), 'class="form-control select2me" data-placeholder="Select..." multiple="multiple" id="training_calendar-department_id"') ?>
	                </div>
	        	</div>
	        </div>       	        		
			<div class="form-group">
				<label class="control-label col-md-3">Location</label>
				<div class="col-md-6">
					<?php
						$db->select('location_id,location');
						$db->where('deleted', '0');
	            		$options = $db->get('users_location');

						$location_id_options = array();
	            		foreach($options->result() as $option)
	            		{
	            			$location_id_options[$option->location_id] = $option->location;
	            		} 
	            	?>
	                <div class="input-group">
						<span class="input-group-addon">
	                    <i class="fa fa-list-ul"></i>
	                    </span>
	                    <?php echo form_dropdown('training_calendar[location_id][]',$location_id_options, explode(',', $record['training_calendar.location_id']), 'class="form-control select2me" data-placeholder="Select..." multiple="multiple" id="training_calendar-location_id"') ?>
	                </div>
	        	</div>
	        </div>	                    
	        <div class="form-group" id="assignment_show">
				<label class="control-label col-md-3">Employee</label>
				<div class="col-md-6">
	                <div class="input-group">
						<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
						<select name="training_calendar[employees][]" class="form-control select2me" data-placeholder="Select..." multiple="multiple" id="training_calendar-employees">

						</select>
	                </div>
	        	</div>
	        </div>
	        <div class="form-group" id="assignment_show">
				<label class="control-label col-md-3">&nbsp;</label>
				<div class="col-md-6">
	        		<button type="button" class="btn green btn-sm" onclick="add_participants()"><i class="fa fa-plus"></i> Add Other Participants</button>
	        		<button type="button" class="btn red btn-sm" onclick="clear_participants()"><i class="fa fa-trash-o"></i> Clear All Participants</button>        	
	        	</div>
	        </div>  

			<div class="clearfix">
				<table class="table table-condensed table-striped table-hover">
					<thead>
						<tr>
							<th width="22%" style="text-align:center">Employee Name</th>
							<th class="hidden-xs" width="20%" style="text-align:center">Nominate</th>
							<th class="hidden-xs" width="20%" style="text-align:center">Status</th>
							<th width="18%" style="text-align:center">Attendance</th>
							<th width="20%" style="text-align:center">Actions</th>
						</tr>
					</thead>
					<tbody id="form-list">
						<?php
							if ($record['record_id'] != ''){
								$db->where('training_calendar_participant.deleted',0);
								$db->where('training_calendar_id',$record['record_id']);
								$db->join('partners','training_calendar_participant.user_id = partners.user_id','left');
								$list_participants = $db->get('training_calendar_participant');
								if ($list_participants && $list_participants->num_rows() > 0){
									
									$participant_status_list = $db->get('training_calendar_participant_status')->result();

									foreach ($list_participants->result() as $row) {
										
										$rand = rand(1,10000);
						?>
										<tr>
								    		<td style="text-align:center"><?php echo $row->alias ?></td>
								    		
								    		<td style="text-align:center">
												<div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
											    	<input type="checkbox" value="1" @if( $row->nominate ) checked="checked" @endif name="participants[<?php echo $rand ?>][temp]" id="participants-nominate" class="toggle participants-nominate"/>
											    	<input type="hidden" name="participants[<?php echo $rand ?>][nominate]" class="participants-nominate-val" value="<?php echo $row->nominate ? 1 : 0 ?>"/>
												</div> 								    			
								    		</td>
								    		<td style="text-align:center">
								    			<select name="participants[<?php echo $rand ?>][status]" class="form-control participant_status select2me">
									    			<?php foreach( $participant_status_list as $participant_status ){ ?>
									    				<option value="<?php echo $participant_status->participant_status_id ?>" <?php if( $participant_status->participant_status_id == $row->participant_status_id ){ echo "selected"; } ?>><?php echo $participant_status->participant_status ?></option>
									    			<?php } ?>
								    			</select>
								    		</td>
								    		<td style="text-align:center">
												<div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
											    	<input type="checkbox" value="{{$row->no_show}}" @if( $row->no_show ) checked="checked" @endif name="participants[<?php echo $rand ?>][temp]" id="participants-no_show" class="toggle participants-no_show"/>
											    	<input type="hidden" name="participants[<?php echo $rand ?>][no_show]" class="participants-no_show-val" value="<?php echo $row->no_show ? 1 : 0 ?>"/>
												</div> 
								    		</td>
								    		<td style="text-align:center">
								    			<a class="btn btn-xs text-muted delete-participant" href="javascript:void(0)"><i class="fa fa-trash-o"></i> Delete</a>
								    			<input type="hidden" class="participants" name="participants[<?php echo $rand ?>][id]" value="<?php echo $row->user_id ?>" />
								    			<input type="hidden" class="participants" name="participants[<?php echo $rand ?>][calendar_participant_id]" value="<?php echo $row->calendar_participant_id ?>" />
								    		</td>
								    	</tr>
						<?php
									}
								}
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="clearfix">
				<div class="col-md-2">
				    <label for="date" class="label-desc gray">Total Confirmed:</label>
				    <div class="text-input-wrap">  
						<input class="form-control total_confirmed" name="total_confirmed" id="" readonly value="" placeholder="Total Confirmed" type="text">
				    </div>                                    
				</div>
            </div>  
		</div>
	</div>
</form>