<?php
$qry = "select a.*, b.uitype
FROM {$db->dbprefix}performance_template_section_column a
LEFT JOIN {$db->dbprefix}performance_template_section_column_uitype b on b.uitype_id = a.uitype_id
WHERE a.deleted = 0 AND a.template_section_id = {$section_id}
ORDER BY a.sequence";
$columns = $db->query( $qry );

/*$qry1 = "select *
FROM {$db->dbprefix}performance_setup_library_value
WHERE deleted = 0 AND library_id = {$library_id}";
$competencies_columns = $db->query( $qry1 );*/

$show_add = false;
$disable = 'disabled';

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

						@if($key == 0)
							<span style="padding-left:5px" class="hidden"><a href="javasript:void(0)" class="btn-success" style="padding:1px 2px"><i class="fa fa-plus add_idp" data-section_id="{{ $section_id }}" data-scorecard_id="0" ></i></a></span>
						@endif						
					</th>
				@endforeach
				<th width="1%">
					&nbsp;
				</th>
			</tr>
		</thead>
		<tbody class="section-<?php echo $section_id ?> idp" section="<?php echo $section_id ?>">
			@if(isset($planning_applicable_fields[0]))
				@foreach($planning_applicable_fields[0] as $key1 => $val1)		
					<tr class="">
						<?php
							if (isset($template_section_column) && !empty($template_section_column))
							{
								foreach ($template_section_column[$section_id] as $key => $value) {
									
									$planning_value = isset($planning_applicable_fields[0][$key1][$value->section_column_id]['value']) ? $planning_applicable_fields[0][$key1][$value->section_column_id]['value'] : "";

									switch( $value->uitype_id ) {
										case 12:
						?>
											<td width="{{ $value->width }}" rowspan="">
												<select class="form-control" name="field[0][{{ $value->section_column_id }}][]" section-id="{{ $section_id }}" {{ $disable }}>
													<option value="">Select</option>													
													@if($areas_development && $areas_development->num_rows() > 0)
														@foreach($areas_development->result() as $row)
															<?php
																$selected = "";
																if($planning_value == $row->appraisal_areas_development_id)
																	$selected = 'selected="selected"';
															?>
															<option value="{{ $row->appraisal_areas_development_id }}" {{ $selected }}>{{ $row->appraisal_areas_development }}</option>
														@endforeach
													@endif
												</select>
											</td>	
						<?php
										break;
										case 13:
						?>
											<td width="{{ $value->width }}" rowspan="">
												<select class="form-control" name="field[0][{{ $value->section_column_id }}][]" section-id="{{ $section_id }}" {{ $disable }}>
													<option value="0">Select</option>													
													@if($learning_mode && $learning_mode->num_rows() > 0)
														@foreach($learning_mode->result() as $row)
															<?php
																$selected = "";
																if($planning_value == $row->learning_mode_id)
																	$selected = 'selected="selected"';
															?>														
															<option value="{{ $row->learning_mode_id }}" {{ $selected }}>{{ $row->learning_mode }}</option>
														@endforeach
													@endif
												</select>
											</td>										
						<?php											
										break;
										case 14:
						?>
											<td width="{{ $value->width }}" rowspan="">
												<select class="form-control" ratio-weight="" name="field[0][{{ $value->section_column_id }}][]" section-id="{{ $section_id }}" {{ $disable }}>
													<option value="0">Select</option>													
													@if($competencies && $competencies->num_rows() > 0)
														@foreach($competencies->result() as $row)
															<?php
																$selected = "";
																if($planning_value == $row->category_id)
																	$selected = 'selected="selected"';
															?>															
															<option value="{{ $row->category_id }}" {{ $selected }}>{{ $row->category }}</option>
														@endforeach
													@endif
												</select>
											</td>																					
						<?php
										break;
										case 15:
						?>
											<td width="{{ $value->width }}" rowspan="">
												<select class="form-control" ratio-weight="" name="field[0][{{ $value->section_column_id }}][]" section-id="{{ $section_id }}" {{ $disable }}>
													<option value="0">Select</option>													
													@if($target_completion && $target_completion->num_rows() > 0)
														@foreach($target_completion->result() as $row)
															<?php
																$selected = "";
																if($planning_value == $row->target_completion_id)
																	$selected = 'selected="selected"';
															?>															
															<option value="{{ $row->target_completion_id }}" {{ $selected }}>{{ $row->target_completion }}</option>
														@endforeach
													@endif
												</select>
											</td>
						<?php
										break;
										case 3:
						?>
											<td width="{{ $value->width }}" rowspan="">
												<textarea class="form-control" rows="2" name="field[0][{{ $value->section_column_id }}][]" {{ $disable }}>{{ $planning_value }}</textarea>
											</td>										
						<?php											
										break;								
									}
								}
							}
						?>
						<td width="1%">
							<span>&nbsp;</span>
						</td>				
					</tr>
				@endforeach	
			@endif
		</tbody>
	</table>
</div>

{{ $footer }}