<?php
$disabled = 'disabled';
?>
<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Training Request</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Training Calendar</label>
			<div class="col-md-7">
				<?php
					$db->select('training_calendar_id,training_title');
                    $db->order_by('training_title', '0');
                    $db->where('deleted', '0');
                    $options = $db->get('training_calendar');
                    $training_application_training_calendar_options = array('' => '');
                    foreach($options->result() as $option) {
                  		$training_application_training_calendar_options[$option->training_calendar_id] = $option->training_title;
                } ?>
                <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
                    {{ form_dropdown('training_application[training_calendar_id]',$training_application_training_calendar_options, $record['training_application_training_calendar_id'], 'class="form-control select2me" data-placeholder="Select..." id="training_application-training_calendar" disabled') }}
                </div>
            </div>	
		</div>		
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
                    {{ form_dropdown('training_application[training_type]',$training_application_training_type_options, $record['training_application_training_type'], 'class="form-control select2me" data-placeholder="Select..." id="training_application-training_type" disabled') }}
                </div>
            </div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Date of Program (From)</label>
			<div class="col-md-7">
				<div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
					<input type="text" class="form-control" name="training_application[date_from]" id="training_application-date_from" value="{{ $record['training_application_date_from'] }}" placeholder="Enter Date of Program (From)" {{ $disabled }}>
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
					<input type="text" class="form-control" name="training_application[date_to]" id="training_application-date_to" value="{{ $record['training_application_date_to'] }}" placeholder="Enter Date of Program (To)" {{ $disabled }}>
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
					$training_application_training_course_id_options = array('' => 'Select...');
                    foreach($options->result() as $option){
                    	$training_application_training_course_id_options[$option->course_id] = $option->course;
                } ?>
                <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
                    {{ form_dropdown('training_application[training_course_id]',$training_application_training_course_id_options, $record['training_application_training_course_id'], 'class="form-control select2me" data-placeholder="Select..." id="training_application-training_course_id" disabled') }}
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
                $training_application_training_provider_options = array('' => 'Select...');
                foreach($options->result() as $option) {
					$training_application_training_provider_options[$option->provider_id] = $option->provider;
               	} ?>
               	<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
                    {{ form_dropdown('training_application[training_provider]',$training_application_training_provider_options, $record['training_application_training_provider'], 'class="form-control select2me" data-placeholder="Select..." id="training_application-training_provider" disabled') }}
                </div>
            </div>	
		</div>
		<div class="form-group min_capacity" style="display:none">
			<label class="control-label col-md-3">Minimum Trainee Capacity</label>
			<div class="col-md-7">							
				<input type="text" class="form-control" name="training_calendar[training_capacity]" id="training_calendar-min_training_capacity" value="" placeholder="Enter Minimum Trainee Capacity" readonly/> 				
			</div>	
		</div>
		<div class="form-group max_capacity" style="display:none">
			<label class="control-label col-md-3">Maximum Trainee Capacity</label>
			<div class="col-md-7">							
				<input type="text" class="form-control" name="training_calendar[min_training_capacity]" id="training_calendar-max_training_capacity" value="" placeholder="Enter Maximum Trainee Capacity" readonly/> 				
			</div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3">Venue</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="training_application[venue]" id="training_application-venue" value="{{ $record['training_application_venue'] }}" placeholder="Enter Venue" {{ $disabled }}/>
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Total Training Hours</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="training_application[total_training_hour]" id="training_application-total_training_hour" value="{{ $record['training_application_total_training_hour'] }}" placeholder="Enter Total Training Hours" {{ $disabled }}/>
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Estimate Investment (Subject for revision by HR):</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="training_application[total_investment_pgsa]" id="training_application-total_investment_pgsa" value="{{ $record['training_application_total_investment_pgsa'] }}" placeholder="Enter Estimate Investment (Subject for revision by HR):" {{ $disabled }}/>
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Include in IDP?:</label>
			<div class="col-md-7">							
				<div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
			    	<input type="checkbox" value="1" @if( $record['training_application_include_idp'] ) checked="checked" @endif name="training_application[include_idp][temp]" id="training_application-include_idp-temp" class="dontserializeme toggle" {{ $disabled }}/>
			    	<input type="hidden" name="training_application[include_idp]" id="training_application-include_idp" value="<?php echo $record['training_application_include_idp'] ? 1 : 0 ?>"/>
				</div> 				
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
                    $training_application_areas_development_options = array('' => 'Select...');
                    foreach($options->result() as $option) {
                    	$training_application_areas_development_options[$option->appraisal_areas_development_id] = $option->appraisal_areas_development;
                } ?>
                <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
                    {{ form_dropdown('training_application[areas_development][]',$training_application_areas_development_options, explode(',', $record['training_application_areas_development']), 'class="form-control select2me" data-placeholder="Select..." id="training_application-areas_development" multiple disabled') }}
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
                    $training_application_competency_options = array('' => 'Select...');
                    foreach($options->result() as $option){
                    	$training_application_competency_options[$option->category_id] = $option->category;
                } ?>
                <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
                    {{ form_dropdown('training_application[competency]',$training_application_competency_options, explode(',', $record['training_application_competency']), 'class="form-control select2me" data-placeholder="Select..." id="training_application-competency" multiple disabled') }}
                </div>
            </div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">NOTE: (If Training will exceed in 1 Month):</label>
			<div class="col-md-7">
				<textarea class="form-control" name="training_application[note]" id="training_application-note" placeholder="Enter NOTE: (If Training will exceed in 1 Month):" rows="4" {{ $disabled }}>{{ $record['training_application_note'] }}</textarea>
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Attachment</label>
			<div class="col-md-7">
				<?php
					if ( !empty($record['training_application_attachment'])) {
						$file = FCPATH . urldecode( $record['training_application_attachment'] );
						if( file_exists( $file ) )
						{
							$f_type = '';

							if (function_exists('get_file_info')) {
								$f_info = get_file_info( $file );
								$f_type = filetype( $file );
							}

							if (function_exists('finfo_open')) {
								$finfo = finfo_open(FILEINFO_MIME_TYPE);
								$f_type = finfo_file($finfo, $file);
							}

							switch( $f_type )
							{
								case 'image/jpeg':
									$icon = 'fa-picture-o';
									break;
								case 'video/mp4':
									$icon = 'fa-film';
									break;
								case 'audio/mpeg':
									$icon = 'fa-volume-up';
									break;
								default:
									$icon = 'fa-file-text-o';
							}
							
							$filepath = base_url()."training/training_request/download_file/".$record['record_id'];
							echo '<li class="padding-3 fileupload-delete-'.$file.'" style="list-style:none;">
					            <a href="'.$filepath.'">
					            <span class="padding-right-5"><i class="fa '. $icon .' text-muted padding-right-5"></i></span>
					            <span>'. basename($f_info['name']) .'</span>
					            <span class="padding-left-10"></span>
					        </a></li>';	
						}
					}
				?>			
			</div>	
		</div>	
	</div>
</div>
<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Approver Remarks</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">
		@if ($approvers && $approvers->num_rows() > 0)
			@foreach($approvers->result() as $row)
				<div class="form-group">
					<label class="control-label col-md-3">Approver</label>
					<div class="col-md-7">
						<input type="text" class="form-control" value="{{$row->display_name}}" disabled>
					</div>	
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">{{ $row->training_application_status }} date</label>
					<div class="col-md-7 col-sm-7">
						<span>{{ general_date_time($row->approved_date) }}</span>
					</div>
				</div>				
				<div class="form-group">
					<label class="control-label col-md-3">Remarks</label>
					<div class="col-md-7">
						<textarea class="form-control" name="training_application[approver_remarks]" id="training_application-note" placeholder="Remarks" rows="4" disabled>{{ $row->remarks }}</textarea>
					</div>	
				</div>
			@endforeach
		@endif
	</div>
</div>

@if ($record['training_application_status_id'] >= 7)
	<div class="portlet">
		<div class="portlet-title">
			<div class="caption">HR Remarks</div>
			<div class="tools"><a class="collapse" href="javascript:;"></a></div>
		</div>
		<div class="portlet-body form">
			<div class="form-group">
				<label class="control-label col-md-3">HR</label>
				<div class="col-md-7">
					<input type="text" class="form-control" value="{{$row->display_name}}" disabled>
				</div>	
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">{{ $row->training_application_status }} date</label>
				<div class="col-md-7 col-sm-7">
					<span>{{ general_date_time($row->approved_date) }}</span>
				</div>
			</div>				
			<div class="form-group">
				<label class="control-label col-md-3">Remarks</label>
				<div class="col-md-7">
					<textarea class="form-control" name="training_application[approver_remarks]" id="training_application-note" placeholder="Remarks" rows="4" disabled>{{ $row->remarks }}</textarea>
				</div>	
			</div>
		</div>
	</div>
@endif