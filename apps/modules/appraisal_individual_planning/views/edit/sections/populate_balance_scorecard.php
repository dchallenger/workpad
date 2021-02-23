<?php
$qry = "select a.*, b.uitype
FROM {$db->dbprefix}performance_template_section_column a
LEFT JOIN {$db->dbprefix}performance_template_section_column_uitype b on b.uitype_id = a.uitype_id
WHERE a.deleted = 0 AND a.template_section_id = {$section_id}
ORDER BY a.sequence";
$columns = $db->query( $qry );

$show_add = false;
?>

<table class="table">
	<thead>
		<tr>
			<?php foreach ($columns->result_array() as $key => $val) { ?>
				<th width="<?php echo $val['width'] ?>%" class="bold">
					<?php if ($val['required'] == 1) {?>
						<label class="control-label">
							<span class="required">* </span>
						</label>
					<?php } ?>
					<span><?php echo $val['title'] ?></span>
				</th>
			<?php } ?>
		</tr>
	</thead>
	<tbody class="get-section section-<?php echo $section_id ?>" section="<?php echo $section_id ?>">
		<?php 
		if (isset($balance_score_card) && $balance_score_card->num_rows() > 0) {
			foreach ($balance_score_card->result_array() as $key => $val) { 
		?>
				<tr class="q<?php echo $key+1 ?>">
					<td>
						<?php echo $key+1 . ". " . $val['scorecard'] ?>&nbsp;
					    <a href="javasript:void(0)" class="btn-success" style="padding:1px 2px"><i class="fa fa-plus add_row" data-section_id="<?php echo $section_id ?>" data-scorecard_id="<?php echo $val['scorecard_id'] ?>" data-num_question="q<?php echo $key+2 ?>"></i></a>
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
										<td width="<?php echo $value->width ?>">
											<input type="text" question="<?php echo $val['scorecard_id'] ?>" value="<?php echo $planning_value ?>" class="form-control <?php echo $value->class ?>" name="field[<?php echo $val['scorecard_id'] ?>][<?php echo $value->section_column_id ?>][]" data-inputmask="'alias': '<?php echo $value->data_type ?>', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false">
										</td>
					<?php
									break;
									case 3:
					?>
										<td width="<?php echo $value->width ?>" rowspan="">
											<textarea class="form-control <?php echo $value->class ?>" rows="4" name="field[<?php echo $val['scorecard_id'] ?>][<?php echo $value->section_column_id ?>][]"><?php echo $planning_value ?></textarea>
										</td>										
					<?php											
									break;
								}
							}
						}
					?>
				</tr>
				<?php
				if (isset($planning_applicable_fields[$val['scorecard_id']])) {
					foreach ($planning_applicable_fields[$val['scorecard_id']] as $key1 => $val1) {
						if($key1 > 1) {
				?>
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

											switch( $value->uitype_id ) {
												case 2:
													if ($can_add_row) {
								?>
														<td width="<?php echo $value->width ?>">
															<input type="text" question="<?php echo $val['scorecard_id'] ?>" value="<?php echo $planning_value ?>" class="form-control <?php echo $value->class ?>" name="field[<?php echo $val['scorecard_id'] ?>][<?php echo $value->section_column_id ?>][]" data-inputmask="'alias': '<?php echo $value->data_type ?>', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false">
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
														<td width="<?php echo $value->width ?>" rowspan="">
															<textarea class="form-control <?php echo $value->class ?>" rows="4" name="field[<?php echo $val['scorecard_id'] ?>][<?php echo $value->section_column_id ?>][]"><?php echo $planning_value ?></textarea>
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
		<?php
						}
					}
				}
			}
		}
		?>
	</tbody>
</table>