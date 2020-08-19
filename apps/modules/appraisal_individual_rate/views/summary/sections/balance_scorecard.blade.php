<?php
$qry = "select a.*, b.uitype
FROM {$db->dbprefix}performance_template_section_column a
LEFT JOIN {$db->dbprefix}performance_template_section_column_uitype b on b.uitype_id = a.uitype_id
WHERE a.deleted = 0 AND a.template_section_id = {$section_id}
ORDER BY a.sequence";
$columns = $db->query( $qry );

$show_add = false;
?>

{{ $header }}

<div class="table-scrollable">
	<table class="table">
		<thead>
			<tr>
				@foreach($columns->result_array() as $key => $val)
					<th width="{{ $val['width'] }}%" class="bold">
						@if($val['required'] == 1)
							<label class="control-label">
								<span class="required">* </span>
							</label>
						@endif
						<span>{{ $val['title'] }}</span>
					</th>
				@endforeach
				<th class="bold">Self Rating</th>
				<th class="bold">% Achieved</th>
				<th class="bold">% Weight Average</th>
				@if(!$self_rating && $list_approver && $list_approver->num_rows() > 0)
					@foreach($list_approver->result() as $row)
						<th class="bold">Coach Rating</th>
						<th class="bold">% Achieved</th>
						<th class="bold">% Weight Average</th>					
					@endforeach
				@endif
			</tr>
		</thead>
		<tbody class="get-section section-<?php echo $section_id ?>" section="<?php echo $section_id ?>">
			@if(isset($balance_score_card) && $balance_score_card->num_rows() > 0)
				@foreach($balance_score_card->result_array() as $key => $val)
					<tr class="q{{ $key+1 }}" ratio-weight="{{ $section_info->weight }}" section-id="{{ $section_info->template_section_id }}">
						<td>
							{{ $key+1 . ". " . $val['scorecard'] }}&nbsp;
						</td>
						<?php
							if (isset($template_section_column) && !empty($template_section_column))
							{
								foreach ($template_section_column[$section_id] as $key => $value) {
									$planning_value = '';
									if (isset($planning_applicable_fields[$val['scorecard_id']][1][$value->section_column_id])) {
										$planning_value = $planning_applicable_fields[$val['scorecard_id']][1][$value->section_column_id]['value'];
									}

									switch( $value->uitype_id ) {
										case 2:
						?>
											<td width="{{ $value->width }}">
												<input readonly='readonly' type="text" question="{{ $val['scorecard_id'] }}" value="{{ $planning_value }}" class="form-control {{ $value->class }}" name="field[{{ $val['scorecard_id'] }}][{{ $value->section_column_id }}][]" data-inputmask="'alias': '{{ $value->data_type }}', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false">
											</td>
						<?php
										break;
										case 3:
						?>
											<td width="{{ $value->width }}" rowspan="">
												<textarea readonly='readonly' class="form-control {{ $value->class }}" rows="4" name="field[{{ $val['scorecard_id'] }}][{{ $value->section_column_id }}][]">{{ $planning_value }}</textarea>
											</td>										
						<?php											
										break;
									}
								}
						?>
<!-- 								Fixed the section column id for appraisal 
								100 = self rating, 101 = self achieved, 102 = self weight average
								103 = coach rating, 104 = coach achieved, 105 = coach weight average -->
								<?php
									$self_rate_val = isset($appraisal_applicable_fields[$appraisee_user_id][$section_id][$val['scorecard_id']][100][1]) ? $appraisal_applicable_fields[$appraisee_user_id][$section_id][$val['scorecard_id']][100][1] : '';
									$self_achieve_val = isset($appraisal_applicable_fields[$appraisee_user_id][$section_id][$val['scorecard_id']][101][1]) ? $appraisal_applicable_fields[$appraisee_user_id][$section_id][$val['scorecard_id']][101][1] : '';
									$self_weight_ave_val = isset($appraisal_applicable_fields[$appraisee_user_id][$section_id][$val['scorecard_id']][102][1]) ? $appraisal_applicable_fields[$appraisee_user_id][$section_id][$val['scorecard_id']][102][1] : '';
									$coach_rate_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][103][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][103][1] : '';
									$coach_achieve_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][104][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][104][1] : '';
									$coach_weight_ave_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][105][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][105][1] : '';									

									$disabled = '';
									if ($performance_status_id >= 4)
										$disabled = 'disabled';									
								?>
								<td><input disabled type="text" question="{{ $val['scorecard_id'] }}" value="{{ $self_rate_val }}" class="form-control none_core_self_rating" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][100][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"></td>
								<td><input disabled type="text" question="{{ $val['scorecard_id'] }}" value="{{ $self_achieve_val }}" class="form-control self_achieved" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][101][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"></td>
								<td><input disabled type="text" question="{{ $val['scorecard_id'] }}" value="{{ $self_weight_ave_val }}" class="form-control self_weight_average" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][102][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"></td>
								@if(!$self_rating && $list_approver && $list_approver->num_rows() > 0)
									@foreach($list_approver->result() as $row)
										<td><input {{ $disabled }} type="text" question="{{ $val['scorecard_id'] }}" value="{{ $coach_rate_val }}" class="form-control none_core_coach_rating" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][103][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"></th>
										<td><input readonly='readonly' type="text" question="{{ $val['scorecard_id'] }}" value="{{ $coach_achieve_val }}" class="form-control coach_achieved" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][104][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"></th>
										<td><input readonly='readonly' type="text" question="{{ $val['scorecard_id'] }}" value="{{ $coach_weight_ave_val }}" class="form-control coach_weight_average " name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][105][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"></th>					
									@endforeach
								@endif								
						<?php
							}
						?>
					</tr>
					@foreach($planning_applicable_fields[$val['scorecard_id']] as $key1 => $val1)				
						@if($key1 > 1)
							<tr class="q{{ $key+1 }}" ratio-weight="{{ $section_info->weight }}" section-id="{{ $section_info->template_section_id }}">
								<td>&nbsp;</td>
								<?php
									if (isset($template_section_column) && !empty($template_section_column))
									{
										foreach ($template_section_column[$section_id] as $key => $value) {
											$planning_value = '';
											$can_add_row = 0;
											$column_sequence = 0;

											if (isset($planning_applicable_fields[$val['scorecard_id']][$key1][$value->section_column_id])) {
												$planning_value = $planning_applicable_fields[$val['scorecard_id']][$key1][$value->section_column_id]['value'];
												$can_add_row = $planning_applicable_fields[$val['scorecard_id']][$key1][$value->section_column_id]['can_add_row'];
												$column_sequence = $planning_applicable_fields[$val['scorecard_id']][$key1][$value->section_column_id]['column_sequence'];
											}

											switch( $value->uitype_id ) {
												case 2:
													if ($can_add_row) {
								?>
														<td width="{{ $value->width }}">
															<input readonly='readonly' type="text" question="{{ $val['scorecard_id'] }}" value="{{ $planning_value }}" class="form-control {{ $value->class }}" name="field[{{ $val['scorecard_id'] }}][{{ $value->section_column_id }}][]" data-inputmask="'alias': '{{ $value->data_type }}', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false">
														</td>
								<?php
													} else {
								?>
														<td width="<?php echo $value->width ?>" style="vertical-align:middle;text-align:center">
															&nbsp;
														</td>
								<?php															
													}
												break;
												case 3:
													if ($can_add_row) {
								?>
														<td width="{{ $value->width }}" rowspan="">
															<textarea readonly='readonly' class="form-control {{ $value->class }}" rows="4" name="field[{{ $val['scorecard_id'] }}][{{ $value->section_column_id }}][]">{{ $planning_value }}</textarea>
														</td>										
								<?php					
													} else {
								?>
														<td width="<?php echo $value->width ?>">
															&nbsp;
														</td>				
								<?php																								
													}						
												break;
											}
										}
								?>
		<!-- 								Fixed the section column id for appraisal 
										100 = self rating, 101 = self achieved, 102 = self weight average
										103 = coach rating, 104 = coach achieved, 105 = coach weight average -->								
										<?php
											$self_rate_val = isset($appraisal_applicable_fields[$appraisee_user_id][$section_id][$val['scorecard_id']][100][1]) ? $appraisal_applicable_fields[$appraisee_user_id][$section_id][$val['scorecard_id']][100][$key1] : '';
											$self_achieve_val = isset($appraisal_applicable_fields[$appraisee_user_id][$section_id][$val['scorecard_id']][101][1]) ? $appraisal_applicable_fields[$appraisee_user_id][$section_id][$val['scorecard_id']][101][$key1] : '';
											$self_weight_ave_val = isset($appraisal_applicable_fields[$appraisee_user_id][$section_id][$val['scorecard_id']][102][1]) ? $appraisal_applicable_fields[$appraisee_user_id][$section_id][$val['scorecard_id']][102][$key1] : '';
											$coach_rate_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][103][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][103][$key1] : '';
											$coach_achieve_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][104][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][104][$key1] : '';
											$coach_weight_ave_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][105][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][105][$key1] : '';									

											$disabled = '';
											if ($performance_status_id >= 4)
												$disabled = 'disabled';											
										?>	
										<td><input disabled type="text" question="{{ $val['scorecard_id'] }}" value="{{ $self_rate_val }}" class="form-control none_core_self_rating" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][100][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"></td>
										<td><input disabled type="text" question="{{ $val['scorecard_id'] }}" value="{{ $self_achieve_val }}" class="form-control self_achieved" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][101][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"></td>
										<td><input disabled type="text" question="{{ $val['scorecard_id'] }}" value="{{ $self_weight_ave_val }}" class="form-control self_weight_average" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][102][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"></td>										
										@if(!$self_rating && $list_approver && $list_approver->num_rows() > 0)
											@foreach($list_approver->result() as $row)
												<td><input {{ $disabled }} type="text" question="{{ $val['scorecard_id'] }}" value="{{ $coach_rate_val }}" class="form-control none_core_coach_rating" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][103][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"></th>
												<td><input readonly='readonly' type="text" question="{{ $val['scorecard_id'] }}" value="{{ $coach_achieve_val }}" class="form-control coach_achieved" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][104][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"></th>
												<td><input readonly='readonly' type="text" question="{{ $val['scorecard_id'] }}" value="{{ $coach_weight_ave_val }}" class="form-control coach_weight_average" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][105][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"></th>					
											@endforeach
										@endif											
								<?php										
									}
								?>
							</tr>
						@endif
					@endforeach
				@endforeach
			@endif	
		</tbody>
	</table>
</div>

{{ $footer }}