<?php
$qry = "select a.*, b.uitype
FROM {$db->dbprefix}performance_template_section_column a
LEFT JOIN {$db->dbprefix}performance_template_section_column_uitype b on b.uitype_id = a.uitype_id
WHERE a.deleted = 0 AND a.template_section_id = {$section_id}
ORDER BY a.sequence";
$columns = $db->query( $qry );
?>

<tr>
	<?php
		if (isset($template_section_column) && !empty($template_section_column))
		{
			foreach ($template_section_column[$section_id] as $key => $value) {
				switch( $value->uitype_id ) {
					case 12:
	?>
						<td width="<?php echo $value->width ?>" rowspan="">
							<select class="form-control" name="field[0][<?php echo $value->section_column_id ?>][]" section-id="<?php echo $section_info->template_section_id ?>">
								<option value="">Select</option>													
								<?php if ($areas_development && $areas_development->num_rows() > 0) {
									foreach($areas_development->result() as $row) { ?>
										<option value="<?php echo $row->appraisal_areas_development_id ?>"><?php echo $row->appraisal_areas_development ?></option>
									<?php }
								} ?>
							</select>
						</td>	
	<?php
					break;
					case 13:
	?>
						<td width="<?php echo $value->width ?>" rowspan="">
							<select class="form-control" name="field[0][<?php echo $value->section_column_id ?>][]" section-id="<?php echo $section_info->template_section_id ?>">
								<option value="0">Select</option>													
								<?php if($learning_mode && $learning_mode->num_rows() > 0) {
									foreach($learning_mode->result() as $row) { ?>
										<option value="<?php echo $row->learning_mode_id ?>"><?php echo $row->learning_mode ?></option>
									<?php }
								} ?>
							</select>
						</td>										
	<?php											
					break;
					case 14:
	?>
						<td width="<?php echo $value->width ?>" rowspan="">
							<select class="form-control" ratio-weight="" name="field[0][<?php echo $value->section_column_id ?>][]" section-id="<?php echo $section_info->template_section_id ?>">
								<option value="0">Select</option>													
								<?php if($competencies && $competencies->num_rows() > 0) {
									foreach($competencies->result() as $row) { ?>
										<option value="<?php echo $row->category_id ?>"><?php echo $row->category ?></option>
									<?php }
								} ?>
							</select>
						</td>																					
	<?php
					break;
					case 15:
	?>
						<td width="<?php echo $value->width ?>" rowspan="">
							<select class="form-control" ratio-weight="" name="field[0][<?php echo $value->section_column_id ?>][]" section-id="<?php echo $section_info->template_section_id ?>">
								<option value="0">Select</option>													
								<?php if($target_completion && $target_completion->num_rows() > 0) {
									foreach($target_completion->result() as $row) { ?>
										<option value="<?php echo $row->target_completion_id ?>"><?php echo $row->target_completion ?></option>
									<?php }
								} ?>
							</select>
						</td>
	<?php
					break;
					case 3:
	?>
						<td width="<?php echo $value->width ?>" rowspan="">
							<textarea class="form-control" rows="2" name="field[0][<?php echo $value->section_column_id ?>][]"></textarea>
						</td>										
	<?php											
					break;								
				}
			}
		}
	?>
	<td width="1%">
		<span><a href="javasript:void(0)" class="btn btn-danger delete_idp" style="padding:1px 2px"><i class="fa fa-trash-o"></i></a></span>
	</td>				
</tr>