<?php
$qry = "select a.*, b.uitype, IF(a.title = 'Self Rating',1,a.required) AS required
FROM {$db->dbprefix}performance_template_section_column a
LEFT JOIN {$db->dbprefix}performance_template_section_column_uitype b on b.uitype_id = a.uitype_id
WHERE a.deleted = 0 AND a.template_section_id = {$section_id}
ORDER BY a.sequence";

$columns = $db->query( $qry );

$qry1 = "select *
FROM {$db->dbprefix}performance_setup_library_value
WHERE deleted = 0 AND library_id = {$library_id}";
$competencies_columns = $db->query( $qry1 );

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
				@if($list_approver && $list_approver->num_rows() > 0)
					@foreach($list_approver->result() as $row)
						<th class="bold">Coach Rating</th>
						<th class="bold">Coach Comment</th>
					@endforeach
				@endif
			</tr>
		</thead>
		<tbody class="get-section section-<?php echo $section_id ?>" section="<?php echo $section_id ?>">
			@if(isset($competencies_columns) && $competencies_columns->num_rows() > 0)
				@foreach($competencies_columns->result_array() as $key => $val)
					<tr class="q{{ $key+1 }}">
						<td>
							{{ $key+1 . ". " . $val['library_value'] }}&nbsp;
							<br>
							<span class="text-muted small">{{ $val['library_value_description'] }}</span>
						</td>
						<?php
							if (isset($template_section_column) && !empty($template_section_column))
							{
								foreach ($template_section_column[$section_id] as $key => $value) {
									$planning_value = '';
									if (isset($planning_applicable_fields[$val['library_value_id']][1][$value->section_column_id])) {
										$planning_value = $planning_applicable_fields[$val['library_value_id']][1][$value->section_column_id]['value'];
									}

									$self_rate_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$library_id][$val['library_value_id']][1]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$library_id][$val['library_value_id']][1] : '';
									$self_comment_val = isset($appraisal_applicable_fields[$login_user_id][$section_id][$library_id][$val['library_value_id']][2]) ? $appraisal_applicable_fields[$login_user_id][$section_id][$library_id][$val['library_value_id']][2] : '';

									switch( $value->uitype_id ) {
										case 2:
						?>
											<td width="{{ $value->width }}">
												<input type="text" question="{{ $val['library_value_id'] }}" value="{{ $planning_value }}" class="form-control {{ $value->class }}" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $library_id }}][{{ $val['library_value_id'] }}][]" data-inputmask="'alias': '{{ $value->data_type }}', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false">
											</td>
						<?php
										break;
										case 3:
						?>
											<td width="{{ $value->width }}" rowspan="">
												<textarea class="form-control {{ $value->class }}" rows="4" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $library_id }}][{{ $val['library_value_id'] }}][]">{{ $self_comment_val }}</textarea>
											</td>										
						<?php											
										break;
										case 9:
						?>
											<td width="{{ $value->width }}" rowspan="">
												<select class="form-control core_self_rating" ratio-weight="{{ $section_info->weight }}" data-library-value="{{$val['library_value']}}" name="field_appraisal[{{ $login_user_id }}][{{ $section_id }}][{{ $library_id }}][{{ $val['library_value_id'] }}][]" section-id="{{ $section_info->template_section_id }}" question="{{ $val['library_value_id'] }}">
													<option value="0">Select</option>													
													@for($i=1;$i<6;$i++)
														<?php 
															$selected = "";
															if($self_rate_val == $i)
																$selected = 'selected="selected"';
														?>
														<option value="{{ currency_format($i) }}" {{ $selected }}>{{ currency_format($i) }}</option>
													@endfor
												</select>
											</td>																					
						<?php
										break;
									}
								}
						?>
								@if($list_approver && $list_approver->num_rows() > 0)
									@foreach($list_approver->result() as $row)
										<!-- no need this area since coach rating will do on review admin -->
									@endforeach
								@endif								
						<?php
							}
						?>
					</tr>
				@endforeach
			@endif	
		</tbody>
	</table>
</div>

{{ $footer }}