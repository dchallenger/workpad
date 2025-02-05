<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Training Application</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
		<div class="portlet-body form">			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Type</label>
				<div class="col-md-7"><?php									                            		$db->select('type_id,type');
	                            			                            		$db->order_by('type', '0');
	                            		$db->where('deleted', '0');
	                            		$options = $db->get('training_type'); 	                            $training_application_type_id_options = array('' => 'Select...');
                        		foreach($options->result() as $option)
                        		{
                        			                        				$training_application_type_id_options[$option->type_id] = $option->type;
                        			                        		} ?>							<div class="input-group">
								<span class="input-group-addon">
	                            <i class="fa fa-list-ul"></i>
	                            </span>
	                            {{ form_dropdown('training_application[type_id]',$training_application_type_id_options, $record['training_application.type_id'], 'class="form-control select2me" data-placeholder="Select..." id="training_application-type_id"') }}
	                        </div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Competency</label>
				<div class="col-md-7"><?php									                            		$db->select('competency_id,competency');
	                            			                            		$db->order_by('competency', '0');
	                            		$db->where('deleted', '0');
	                            		$options = $db->get('training_competency'); 	                            $training_application_competency_id_options = array('' => 'Select...');
                        		foreach($options->result() as $option)
                        		{
                        			                        				$training_application_competency_id_options[$option->competency_id] = $option->competency;
                        			                        		} ?>							<div class="input-group">
								<span class="input-group-addon">
	                            <i class="fa fa-list-ul"></i>
	                            </span>
	                            {{ form_dropdown('training_application[competency_id]',$training_application_competency_id_options, $record['training_application.competency_id'], 'class="form-control select2me" data-placeholder="Select..." id="training_application-competency_id"') }}
	                        </div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Course</label>
				<div class="col-md-7"><?php									                            		$db->select('course_id,course');
	                            			                            		$db->order_by('course', '0');
	                            		$db->where('deleted', '0');
	                            		$options = $db->get('training_course'); 	                            $training_application_course_id_options = array('' => 'Select...');
                        		foreach($options->result() as $option)
                        		{
                        			                        				$training_application_course_id_options[$option->course_id] = $option->course;
                        			                        		} ?>							<div class="input-group">
								<span class="input-group-addon">
	                            <i class="fa fa-list-ul"></i>
	                            </span>
	                            {{ form_dropdown('training_application[course_id]',$training_application_course_id_options, $record['training_application.course_id'], 'class="form-control select2me" data-placeholder="Select..." id="training_application-course_id"') }}
	                        </div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Provider</label>
				<div class="col-md-7"><?php									                            		$db->select('source_id,source');
	                            			                            		$db->order_by('source', '0');
	                            		$db->where('deleted', '0');
	                            		$options = $db->get('training_source'); 	                            $training_application_source_id_options = array('' => 'Select...');
                        		foreach($options->result() as $option)
                        		{
                        			                        				$training_application_source_id_options[$option->source_id] = $option->source;
                        			                        		} ?>							<div class="input-group">
								<span class="input-group-addon">
	                            <i class="fa fa-list-ul"></i>
	                            </span>
	                            {{ form_dropdown('training_application[source_id]',$training_application_source_id_options, $record['training_application.source_id'], 'class="form-control select2me" data-placeholder="Select..." id="training_application-source_id"') }}
	                        </div> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3"><span class="required">* </span>Venue</label>
				<div class="col-md-7">							<input type="text" class="form-control" name="training_application[venue]" id="training_application-venue" value="{{ $record['training_application.venue'] }}" placeholder="Enter Venue" /> 				</div>	
			</div>			<div class="form-group">
				<label class="control-label col-md-3">Estimate Investment</label>
				<div class="col-md-7">							<input type="text" class="form-control" name="training_application[estimated_cost]" id="training_application-estimated_cost" value="{{ $record['training_application.estimated_cost'] }}" placeholder="Enter Estimate Investment" /> 				</div>	
			</div>	</div>
</div>