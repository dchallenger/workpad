<?php if($type_id == 12): ?>
	<div class="form-group">
		<label class="control-label col-md-3">
			<span class="required">* </span>End Date of Temporary Assignment
		</label>
		<div class="col-md-7">							
			<div class="input-group input-medium date date-picker" data-date-format="MM dd, yyyy">
				<input type="text" class="form-control" name="partners_movement_action_transfer[end_date]" 
				id="partners_movement_action_transfer-end_date" value="<?php echo $end_date; ?>" placeholder="Enter End Date of Temporary Assignment" readonly>
				<span class="input-group-btn">
					<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
				</span>
			</div>
		</div>	
	</div>
<?php endif; ?>
<div class="form-group">
	<label class="control-label col-md-3">
		<input type="hidden" name="field_count" id="field_count-<?php echo $count; ?>" value="0"/>
	</label>
	<div class="col-md-4">Current</div>
	<div class="col-md-5">To</div>
</div>
<?php foreach ($transfer_fields as $transfer_field) {
?>
	<div class="form-group">
		<label class="control-label col-md-3">
			<span class="required hidden">* </span>
			<?php echo $transfer_field['field_label']; ?>
			<input type="hidden" name="partners_movement_action_transfer[field_id][]"
			id="partners_movement_action_transfer-field_id" value="<?php echo $transfer_field['field_id']; ?>">
			<input type="hidden" name="partners_movement_action_transfer[field_name][]"
			id="partners_movement_action_transfer-field_name" value="<?php echo $transfer_field['field_name']; ?>">
		</label>
		<div class="col-md-4">	
				<input type="hidden" class="form-control" name="partners_movement_action_transfer[from_id][]" 
				id="<?php echo $transfer_field['field_name']?>-from_id" value="<?php echo $transfer_field['from_id']; ?>"/> 
				<input type="text" readonly class="form-control" name="partners_movement_action_transfer[from_name][]" 
				id="<?php echo $transfer_field['field_name']?>-from_name" value="<?php echo $transfer_field['from_name']; ?>" /> 
		</div>
		<div class="col-md-5">	
		<?php if( $transfer_field['table_name'] == "") {
		?>
				<input type="text" class="form-control trans_field" name="partners_movement_action_transfer[to_name][]" 
				id="partners_movement_action_transfer-to_name-<?php echo $transfer_field['field_id']?>" 
				value="<?php echo $transfer_field['to_name']; ?>" placeholder="Enter New <?php echo $transfer_field['field_label']; ?>" /> 
				<input type="hidden" class="form-control" name="partners_movement_action_transfer[to_id][]" 
				id="partners_movement_action_transfer-to_id-<?php echo $transfer_field['field_id']?>" value="<?php echo $transfer_field['to_id']; ?>" /> 	
		<?php	} else {

			if($transfer_field['table_name'] == 'ww_users'){
				$qry = "SELECT * FROM {$transfer_field['table_name']} WHERE deleted = 0 ORDER BY display_name"; 
			}else{
				$qry = "SELECT * FROM {$transfer_field['table_name']} WHERE deleted = 0 ORDER BY {$transfer_field['field_name']}"; 
			}
			$options = $db->query($qry);
			
			?>							
			<div class="input-group">
				<span class="input-group-addon">
					<i class="fa fa-list-ul"></i>
				</span>
				<input type="hidden" class="form-control" name="partners_movement_action_transfer[to_name][]" 
				id="partners_movement_action_transfer-to_name-<?php echo $transfer_field['field_id']?>" value="<?php echo $transfer_field['to_name']; ?>" /> 
				<select name="partners_movement_action_transfer[to_id][]" data-field="<?php echo $transfer_field['field_id']; ?>"
				id="partners_movement_action_transfer-to_id-<?php echo $transfer_field['field_id']?>"
				class="form-control select2me trans_field" data-placeholder="Select...">
				<option value="">Select...</option>
				<?php
				foreach($options->result() as $option)
				{
					$option_field_id = strtolower($transfer_field['field_name'].'_id');
					$field_name = $transfer_field['field_name'];

					if($transfer_field['table_name'] == 'ww_users'){
						$selected = ($option->user_id == $transfer_field['to_id']) ? "selected" : "";
					}elseif($transfer_field['table_name'] == 'ww_users_job_grade_level'){
						$selected = ($option->job_grade_id == $transfer_field['to_id']) ? "selected" : "";								
					}else{
						$selected = ($option->$option_field_id == $transfer_field['to_id']) ? "selected" : "";
					}

					if($transfer_field['table_name'] == 'ww_users'){
						$text_value = $option->display_name;
					}elseif($transfer_field['table_name'] == 'ww_users_department'){
						$text_value = $option->department_code .' - '. $option->$field_name;
					}else{
						$text_value = $option->$field_name;
					}								
				?>
					<option <?php echo $selected; ?>  value="<?php echo ($transfer_field['table_name'] == 'ww_users' ? $option->user_id : ($transfer_field['table_name'] == 'ww_users_job_grade_level' ? $option->job_grade_id : $option->$option_field_id)); ?>">
						<?php echo $text_value?></option>
					<?php
				}
				?>
				</select>
			</div> 	
		<?php }	?>				
		</div>	
	</div>
<?php 
}
?>