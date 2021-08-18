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

<div class="table-responsive kra-section">
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
			</tr>
		</thead>
		<tbody class="get-section section-<?php echo $section_id ?>" section="<?php echo $section_id ?>">
			@if(isset($balance_score_card) && $balance_score_card->num_rows() > 0)
				@foreach($balance_score_card->result_array() as $key => $val)
					<tr class="q{{ $key+1 }} @if($val['scorecard_id'] == 1) fmt@endif">
						<td>
							{{ $key+1 . ". " . $val['scorecard'] }}&nbsp;
						    <a href="javasript:void(0)" class="btn-success" style="padding:1px 2px"><i class="fa fa-plus add_row" data-section_id="{{ $section_id }}" data-scorecard_id="{{ $val['scorecard_id'] }}" data-num_question="q{{ $key+2 }}"></i></a>
						</td>
						<?php
							if (isset($template_section_column) && !empty($template_section_column))
							{
								foreach ($template_section_column[$section_id] as $key => $value) {
									$planning_value = '';
									if (isset($planning_applicable_fields[$val['scorecard_id']][1][$value->section_column_id])) {
										$planning_value = $planning_applicable_fields[$val['scorecard_id']][1][$value->section_column_id]['value'];
									}

									$read_only = '';

									switch ($value->title) {
										case 'KPI / Measures':
											if ($value->class == '')
												$value->class = 'kpi';
											break;
										case 'Target':
											if ($value->class == '')
												$value->class = 'target';
											break;
										case 'Key in Weight':
											$read_only = 'readonly';
											break;
									}

									switch( $value->uitype_id ) {
										case 2:
						?>
											<td width="{{ $value->width }}">
												<input type="text" {{ $read_only }} question="{{ $val['scorecard_id'] }}" value="{{ $planning_value }}" class="form-control {{ $value->class }}" name="field[{{ $val['scorecard_id'] }}][{{ $value->section_column_id }}][]" data-score-card="{{ $val['scorecard'] }}" data-inputmask="'alias': '{{ $value->data_type }}', 'autoGroup': true, 'groupSize': 3, 'repeat': 13, 'greedy' : false">
											</td>
						<?php
										break;
										case 3:
						?>
											<td width="{{ $value->width }}" rowspan="">
												<textarea class="form-control {{ $value->class }}" rows="4" name="field[{{ $val['scorecard_id'] }}][{{ $value->section_column_id }}][]" data-score-card="{{ $val['scorecard'] }}">{{ $planning_value }}</textarea>
											</td>										
						<?php											
										break;
									}
								}
							}
						?>
					</tr>
					@if(isset($planning_applicable_fields[$val['scorecard_id']]))
						@foreach($planning_applicable_fields[$val['scorecard_id']] as $key1 => $val1)				
							@if($key1 > 1)
								<tr>
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

												$read_only = '';

												switch ($value->title) {
													case 'KPI / Measures':
														if ($value->class == '')
															$value->class = 'kpi';
														break;
													case 'Target':
														if ($value->class == '')
															$value->class = 'target';
														break;
													case 'Key in Weight':
														$read_only = 'readonly';
														break;														
												}

												switch( $value->uitype_id ) {
													case 2:
														if ($can_add_row) {
									?>
															<td width="{{ $value->width }}">
																<input type="text" {{ $read_only }} question="{{ $val['scorecard_id'] }}" value="{{ $planning_value }}" class="form-control {{ $value->class }}" name="field[{{ $val['scorecard_id'] }}][{{ $value->section_column_id }}][]" data-score-card="{{ $val['scorecard'] }}" data-inputmask="'alias': '{{ $value->data_type }}', 'autoGroup': true, 'groupSize': 3, 'repeat': 13, 'greedy' : false">
															</td>
									<?php
														} else {
									?>
															<td width="<?php echo $value->width ?>" style="vertical-align:middle;text-align:center">
																<div class="btn-group">
													                <a href="javascript:void(0)" class="btn btn-danger btn-sm delete_row">
													                  	<i class="fa fa-trash-o"></i>
													                </a>
													            </div>															
															</td>
									<?php															
														}
													break;
													case 3:
														if ($can_add_row) {
									?>
															<td width="{{ $value->width }}" rowspan="">
																<textarea class="form-control {{ $value->class }}" rows="4" name="field[{{ $val['scorecard_id'] }}][{{ $value->section_column_id }}][]" data-score-card="{{ $val['scorecard'] }}">{{ $planning_value }}</textarea>
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
										}
									?>
								</tr>
							@endif
						@endforeach
					@endif
				@endforeach
			@endif	
		</tbody>
	</table>
</div>

{{ $footer }}