<?php
$qry = "select a.*, b.uitype
FROM {$db->dbprefix}performance_template_section_column a
LEFT JOIN {$db->dbprefix}performance_template_section_column_uitype b on b.uitype_id = a.uitype_id
WHERE a.deleted = 0 AND a.template_section_id = {$section_id}
ORDER BY a.sequence";
$columns = $db->query( $qry );

$key_in_weight_ave = '';
if (isset($financial_metric_planning_weight) && count($financial_metric_planning_weight['fmpi_arr']) > 0) {
	$count = count($financial_metric_planning_weight['fmpi_arr']);
	$total_key_weight = array_sum($financial_metric_planning_weight['fmpi_arr']);
	$key_in_weight_ave = $total_key_weight / $count;
}

$show_add = false;
?>

{{ $header }}

<div class="table-scrollable">
	@if(isset($balance_score_card) && $balance_score_card->num_rows() > 0 && count($financial_metric_planning_applicable))
		@foreach($balance_score_card->result_array() as $key => $val)
			<?php
				if (isset($template_section_column) && !empty($template_section_column))
				{
					foreach ($template_section_column[$section_id] as $key => $value) {
						if ($value->class == 'key_weight') {
							$planning_value = '';
							if (isset($planning_applicable_fields[$val['scorecard_id']][1][$value->section_column_id])) {
								$planning_value = $planning_applicable_fields[$val['scorecard_id']][1][$value->section_column_id]['value'];
							}
							$class = $value->class;
							$section_column_id = $value->section_column_id;
							$data_type = $value->data_type;
						}
					}
				}
			?>
			@if($val['scorecard_id'] == 1)
		        <div class="form-body">                        
                    <div class="form-group">
                    	<label style="text-align: left" class="control-label col-md-2">{{ 1 . ". " . $val['scorecard'] }}&nbsp;</label>
                        <label style="text-align: left; float: left; padding-top: 7px; padding-left: 15px;">Key in Weight</label>
                        <div class="col-md-1">
                            <input type="text" readonly question="{{ $val['scorecard_id'] }}" value="{{$key_in_weight_ave}}" class="form-control {{ $class }}" name="field[{{ $val['scorecard_id'] }}][{{ $section_column_id }}][]" data-score-card="{{ $val['scorecard'] }}" data-inputmask="'alias': '{{ $data_type }}', 'autoGroup': true, 'groupSize': 3, 'repeat': 13, 'greedy' : false">
                        </div>
                    </div>
                </div>

                @include('edit/sections/financial_target', array('financial_metric_planning_applicable' => $financial_metric_planning_applicable, 'key_in_weight_ave' => $key_in_weight_ave))
			@endif
		@endforeach
	@endif
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
				<th class="bold hidden">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Remarks &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
				@if($list_approver && $list_approver->num_rows() > 0)
					@foreach($list_approver->result() as $row)
						<th class="bold">Coach Rating</th>
						<th class="bold">% Achieved</th>
						<th class="bold">% Weight Average</th>					
						<th class="bold hidden">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Remarks &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					@endforeach					
				@endif
			</tr>
		</thead>
		<tbody class="get-section section-<?php echo $section_id ?>" section="<?php echo $section_id ?>">
			@if(isset($balance_score_card) && $balance_score_card->num_rows() > 0)
				@foreach($balance_score_card->result_array() as $key => $val)
					@if($val['scorecard_id'] > 1)
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
													<input readonly='readonly' type="text" question="{{ $val['scorecard_id'] }}" value="{{ $planning_value }}" class="form-control {{ $value->class }}" name="field[{{ $val['scorecard_id'] }}][{{ $value->section_column_id }}][]" data-inputmask="'alias': '{{ $value->data_type }}', 'autoGroup': true, 'groupSize': 3, 'repeat': 13, 'greedy' : false">
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
										$self_rate_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][100][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][100][1] : '';
										$self_achieve_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][101][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][101][1] : '';
										$self_weight_ave_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][102][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][102][1] : '';
										$self_remarks = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][106][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][106][1] : '';
										$coach_rate_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][103][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][103][1] : '';
										$coach_achieve_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][104][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][104][1] : '';
										$coach_weight_ave_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][105][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][105][1] : '';
										$coach_remarks = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][107][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][107][1] : '';
									?>
									<td><input type="text" question="{{ $val['scorecard_id'] }}" value="{{ $self_rate_val }}" class="form-control none_core_self_rating" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][100][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSize': 3, 'repeat': 13, 'greedy' : false" data-score-card="{{$val['scorecard']}}"></td>
									<td><input readonly='readonly' type="text" question="{{ $val['scorecard_id'] }}" value="{{ $self_achieve_val }}" class="form-control self_achieved" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][101][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSize': 3, 'repeat': 13, 'greedy' : false"></td>
									<td><input readonly='readonly' type="text" question="{{ $val['scorecard_id'] }}" value="{{ $self_weight_ave_val }}" class="form-control self_weight_average" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][102][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSize': 3, 'repeat': 13, 'greedy' : false"></td>
									<td class="hidden"><textarea class="form-control" rows="4" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][106][]">{{ $self_remarks }}</textarea></td>
									@if($list_approver && $list_approver->num_rows() > 0)
										@foreach($list_approver->result() as $row)
											<td><input type="text" question="{{ $val['scorecard_id'] }}" value="{{ $coach_rate_val }}" class="form-control none_core_coach_rating" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][103][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSize': 3, 'repeat': 13, 'greedy' : false"></th>
											<td><input readonly='readonly' type="text" question="{{ $val['scorecard_id'] }}" value="{{ $coach_achieve_val }}" class="form-control coach_achieved" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][104][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSize': 3, 'repeat': 13, 'greedy' : false"></th>
											<td><input readonly='readonly' type="text" question="{{ $val['scorecard_id'] }}" value="{{ $coach_weight_ave_val }}" class="form-control coach_weight_average " name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][105][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSize': 3, 'repeat': 13, 'greedy' : false"></th>
											<td class="hidden"><textarea class="form-control" rows="4" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][107][]">{{ $coach_remarks }}</textarea></td>
										@endforeach
									@endif								
							<?php
								}
							?>
						</tr>
						@if (isset($planning_applicable_fields[$val['scorecard_id']]))
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
																	<input readonly='readonly' type="text" question="{{ $val['scorecard_id'] }}" value="{{ $planning_value }}" class="form-control {{ $value->class }}" name="field[{{ $val['scorecard_id'] }}][{{ $value->section_column_id }}][]" data-inputmask="'alias': '{{ $value->data_type }}', 'autoGroup': true, 'groupSize': 3, 'repeat': 13, 'greedy' : false">
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
													$self_rate_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][100][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][100][$key1] : '';
													$self_achieve_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][101][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][101][$key1] : '';
													$self_weight_ave_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][102][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][102][$key1] : '';
													$self_remarks = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][106][$key1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][106][$key1] : '';
													$coach_rate_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][103][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][103][$key1] : '';
													$coach_achieve_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][104][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][104][$key1] : '';
													$coach_weight_ave_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][105][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][105][$key1] : '';
													$coach_remarks = isset($appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][107][$key1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$val['scorecard_id']][107][$key1] : '';
												?>										
												<td><input type="text" question="{{ $val['scorecard_id'] }}" value="{{ $self_rate_val }}" class="form-control none_core_self_rating" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][100][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSize': 3, 'repeat': 13, 'greedy' : false" data-score-card="{{$val['scorecard']}}"></td>
												<td><input readonly='readonly' type="text" question="{{ $val['scorecard_id'] }}" value="{{ $self_achieve_val }}" class="form-control self_achieved" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][101][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSize': 3, 'repeat': 13, 'greedy' : false"></td>
												<td><input readonly='readonly' type="text" question="{{ $val['scorecard_id'] }}" value="{{ $self_weight_ave_val }}" class="form-control self_weight_average" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][102][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSize': 3, 'repeat': 13, 'greedy' : false"></td>										
												<td class="hidden"><textarea class="form-control" rows="4" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][106][]">{{ $self_remarks }}</textarea></td>
												@if($list_approver && $list_approver->num_rows() > 0)
													@foreach($list_approver->result() as $row)
														<td><input type="text" question="{{ $val['scorecard_id'] }}" value="{{ $coach_rate_val }}" class="form-control none_core_coach_rating" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][103][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSize': 3, 'repeat': 13, 'greedy' : false"></th>
														<td><input readonly='readonly' type="text" question="{{ $val['scorecard_id'] }}" value="{{ $coach_achieve_val }}" class="form-control coach_achieved" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][104][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSize': 3, 'repeat': 13, 'greedy' : false"></th>
														<td><input readonly='readonly' type="text" question="{{ $val['scorecard_id'] }}" value="{{ $coach_weight_ave_val }}" class="form-control coach_weight_average" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][105][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSize': 3, 'repeat': 13, 'greedy' : false"></th>					
														<td class="hidden"><textarea class="form-control" rows="4" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $val['scorecard_id'] }}][107][]">{{ $coach_remarks }}</textarea></td>
													@endforeach
												@endif											
										<?php										
											}
										?>
									</tr>
								@endif
							@endforeach
						@endif
					@endif
				@endforeach
			@endif	
		</tbody>
	</table>
</div>

{{ $footer }}