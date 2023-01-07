<?php
$qry = "select a.*, b.uitype
FROM {$db->dbprefix}performance_template_section_column a
LEFT JOIN {$db->dbprefix}performance_template_section_column_uitype b on b.uitype_id = a.uitype_id
WHERE a.deleted = 0 AND a.template_section_id = {$section_id}
ORDER BY a.sequence";
$columns = $db->query( $qry );

$show_add = false;

$key_in_weight_ave = '';
if (isset($financial_metric_planning_finance) && count($financial_metric_planning_finance['fmpd_details_arr']) > 0) {
	$count = count($financial_metric_planning_finance['fmpd_details_arr']);
	$total_key_weight = array_sum($financial_metric_planning_finance['fmpd_details_arr']);
	$key_in_weight_ave = $total_key_weight / $count;
}

if (isset($financial_metric_planning) && count($financial_metric_planning['fmpi_arr']) > 0) {
	$count = count($financial_metric_planning['fmpi_arr']);
	$total_key_weight = array_sum($financial_metric_planning['fmpi_arr']);
	$key_in_weight_ave = $total_key_weight / $count;
}
?>

{{ $header }}

<div class="table-responsive">
	@if(isset($balance_score_card) && $balance_score_card->num_rows() > 0)
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
                            <input type="text" {{ $readonly }} question="{{ $val['scorecard_id'] }}" value="{{ $key_in_weight_ave }}" class="form-control {{ $class }}" name="field[{{ $val['scorecard_id'] }}][{{ $section_column_id }}][]" data-inputmask="'alias': '{{ $data_type }}', 'autoGroup': true, 'groupSize': 3, 'repeat': 13, 'greedy' : false">
                        </div>
                    </div>
                </div>

<!-- 				@if(isset($financial_metric_planning_finance) && count($financial_metric_planning_finance['fmpi_details_arr']) > 0)
					@include('review/sections/financial_target_finance', array('financial_metric_planning_finance' => $financial_metric_planning_finance))
					@include('review/sections/financial_target', array('financial_metric_planning' => $financial_metric_planning))
				@endif -->

				@if(isset($financial_metric_planning) && count($financial_metric_planning['fmp_details_arr']) > 0)
					@include('review/sections/financial_target', array('financial_metric_planning' => $financial_metric_planning))
				@endif
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
			</tr>
		</thead>
		<tbody class="get-section section-<?php echo $section_id ?>" section="<?php echo $section_id ?>">
			@if(isset($balance_score_card) && $balance_score_card->num_rows() > 0)
				@foreach($balance_score_card->result_array() as $key => $val)
					@if($val['scorecard_id'] > 1)
						<tr class="q{{ $key+1 }}">
							<td>
								{{ $key+1 . ". " . $val['scorecard'] }}&nbsp;
								@if((!isset($planning_admin) || $planning_admin == 0) && $appraisee->planning_status_id == 1)
							    	<a href="javasript:void(0)" class="btn-success add_row" style="padding:1px 2px" data-section_id="{{ $section_id }}" data-scorecard_id="{{ $val['scorecard_id'] }}" data-num_question="q{{ $key+2 }}"><i class="fa fa-plus"></i></a>
							    @endif
							</td>
							<?php
								if (isset($template_section_column) && !empty($template_section_column))
								{
									foreach ($template_section_column[$section_id] as $key => $value) {
										$planning_value = '';
										if (isset($planning_applicable_fields[$val['scorecard_id']][1][$value->section_column_id])) {
											$planning_value = $planning_applicable_fields[$val['scorecard_id']][1][$value->section_column_id]['value'];
										}

										switch ($value->title) {
											case 'KPI / Measures':
												if ($value->class == '')
													$value->class = 'kpi';
												break;
											case 'Target':
												if ($value->class == '')
													$value->class = 'target';
												break;											
										}

										switch( $value->uitype_id ) {
											case 2:
							?>
												<td width="{{ $value->width }}">
													<input {{ $readonly }} type="text" question="{{ $val['scorecard_id'] }}" value="{{ $planning_value }}" class="form-control {{ $value->class }}" name="field[{{ $val['scorecard_id'] }}][{{ $value->section_column_id }}][]" data-inputmask="'alias': '{{ $value->data_type }}', 'autoGroup': true, 'groupSize': 3, 'repeat': 13, 'greedy' : false">
												</td>
							<?php
											break;
											case 3:
							?>
												<td width="{{ $value->width }}" rowspan="">
													<textarea {{ $readonly }} class="form-control {{ $value->class }}" rows="4" name="field[{{ $val['scorecard_id'] }}][{{ $value->section_column_id }}][]">{{ $planning_value }}</textarea>
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

													switch ($value->title) {
														case 'KPI / Measures':
															if ($value->class == '')
																$value->class = 'kpi';
															break;
														case 'Target':
															if ($value->class == '')
																$value->class = 'target';
															break;											
													}

													switch( $value->uitype_id ) {
														case 2:
															if ($can_add_row) {
										?>
																<td width="{{ $value->width }}">
																	<input {{ $readonly }} type="text" question="{{ $val['scorecard_id'] }}" value="{{ $planning_value }}" class="form-control {{ $value->class }}" name="field[{{ $val['scorecard_id'] }}][{{ $value->section_column_id }}][]" data-inputmask="'alias': '{{ $value->data_type }}', 'autoGroup': true, 'groupSize': 3, 'repeat': 13, 'greedy' : false">
																</td>
										<?php
															} else {
										?>
																<td width="<?php echo $value->width ?>" style="vertical-align:middle;text-align:center">
																	@if(!isset($planning_admin) || $planning_admin == 0)
																		<div class="btn-group">
															                <a href="javascript:void(0)" class="btn btn-danger btn-sm delete_row">
															                  	<i class="fa fa-trash-o"></i>
															                </a>
															            </div>
															        @else
															        	&nbsp;
															        @endif
																</td>
										<?php															
															}
														break;
														case 3:
															if ($can_add_row) {
										?>
																<td width="{{ $value->width }}" rowspan="">
																	<textarea {{ $readonly }} class="form-control {{ $value->class }}" rows="4" name="field[{{ $val['scorecard_id'] }}][{{ $value->section_column_id }}][]">{{ $planning_value }}</textarea>
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
					@endif
				@endforeach
			@endif	
		</tbody>
	</table>
</div>

{{ $footer }}