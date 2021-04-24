<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Training Request</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">
				<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Training Type</label>
			<div class="col-md-7">
				<?php
					$db->select('calendar_type_id,calendar_type');
                    $db->order_by('calendar_type', '0');
                    $db->where('deleted', '0');
                    $options = $db->get('training_calendar_type');
                    $training_application_training_type_options = array('' => '');
                    foreach($options->result() as $option) {
                  		$training_application_training_type_options[$option->calendar_type_id] = $option->calendar_type;
                } ?>
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
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Date of Program (To)</label>
			<div class="col-md-7">
				<div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
					<input type="text" class="form-control" name="training_application[date_to]" id="training_application-date_to" value="{{ $record['training_application.date_to'] }}" placeholder="Enter Date of Program (To)" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
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
                    foreach($options->result() as $option){
                    	$training_application_training_course_id_options[$option->course_id] = $option->course;
                } ?>
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
               	} ?>
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
				<input type="text" class="form-control" name="training_application[total_training_hour]" id="training_application-total_training_hour" value="{{ $record['training_application.total_training_hour'] }}" placeholder="Enter Total Training Hours" data-inputmask="'mask': '9', 'repeat': 3, 'greedy' : false"/>
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Estimate Investment (Subject for revision by HR):</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="training_application[total_investment_pgsa]" id="training_application-total_investment_pgsa" value="{{ $record['training_application.total_investment_pgsa'] }}" placeholder="Enter Estimate Investment (Subject for revision by HR):" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/>
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Areas for Development</label>
			<div class="col-md-7">
				<?php
					$db->select('appraisal_areas_development_id,appraisal_areas_development');
                    $db->order_by('appraisal_areas_development', '0');
                    $db->where('deleted', '0');
                    $options = $db->get('performance_appraisal_areas_development');
                    $training_application_areas_development_options = array();
                    foreach($options->result() as $option) {
                    	$training_application_areas_development_options[$option->appraisal_areas_development_id] = $option->appraisal_areas_development;
                } ?>
                <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
                    {{ form_dropdown('training_application[areas_development][]',$training_application_areas_development_options, explode(',', $record['training_application.areas_development']), 'class="select2me form-control " data-placeholder="Select..." id="training_application-areas_development" multiple') }}
                </div>
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
                    $training_application_competency_options = array();
                    foreach($options->result() as $option){
                    	$training_application_competency_options[$option->category_id] = $option->category;
                } ?>
                <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
                    {{ form_dropdown('training_application[competency][]',$training_application_competency_options, explode(',', $record['training_application.competency']), 'class="form-control select2me" data-placeholder="Select..." id="training_application-competency" multiple') }}
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
			<label class="control-label col-md-3">Attachment</label>
			<div class="col-md-7">
				<div data-provides="fileupload" class="fileupload fileupload-new" id="training_application-attachment-container">
					@if( !empty($record['training_application.attachment']) )
						<?php 
							$file = FCPATH . urldecode( $record['training_application.attachment'] );
							if( file_exists( $file ) )
							{
								$f_info = get_file_info( $file );
							}
						?>								@endif
					<input type="hidden" name="training_application[attachment]" id="training_application-attachment" value="{{ $record['training_application.attachment'] }}"/>
					<div class="input-group">
						<span class="input-group-btn">
							<span class="uneditable-input">
								<i class="fa fa-file fileupload-exists"></i> 
								<span class="fileupload-preview">@if( isset($f_info['name'] ) ) {{ basename($f_info['name']) }} @endif</span>
							</span>
						</span>
						<span class="btn default btn-file">
							<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select file</span>
							<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
							<input type="file" id="training_application-attachment-fileupload" type="file" name="files[]">
						</span>
						<a data-dismiss="fileupload" class="btn red fileupload-exists fileupload-delete"><i class="fa fa-trash-o"></i>  {{ lang('common.remove') }}</a>
					</div>
				</div> 				
			</div>	
		</div>	
	</div>
</div>