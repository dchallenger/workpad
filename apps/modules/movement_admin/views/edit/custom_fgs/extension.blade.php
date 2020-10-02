<?php if($type_id == 17) //for Developmental Assignment 
 { ?>
<div class="form-group">
	<label class="control-label col-md-3">
		Grade
	</label>
	<div class="col-md-7">	
	    <input type="text" class="form-control" name="partners_movement_action[grade]" id="partners_movement_action-grade" value="<?php echo $record['partners_movement_action.grade'] ?>" placeholder="Enter Grade" /> 			
	</div>	
</div>	
<?php } ?>	

<div class="form-group">
	<label class="control-label col-md-3">
		Months
	</label>
	<div class="col-md-7">
	    <input type="hidden" name="partners_movement_action_extension[id]" id="partners_movement_action_extension-id" 
	    value="<?php echo $record['partners_movement_action_extension.id']; ?>" />				
		<input type="text" class="form-control" name="partners_movement_action_extension[no_of_months]" id="partners_movement_action_extension-no_of_months" value="<?php echo $record['partners_movement_action_extension.no_of_months'] ?>" placeholder="Enter Months" data-inputmask="'mask': '9', 'repeat': 4, 'greedy' : false"/>
	</div>	
</div>

<div class="form-group">
	<label class="control-label col-md-3">
		<span class="required">* </span>End Date
	</label>
	<div class="col-md-7">							
		<div class="input-group input-medium date date-picker end_date" data-date-format="MM dd, yyyy">
			<input type="text" class="form-control" name="partners_movement_action_extension[end_date]" 
			value="<?php echo $record['partners_movement_action_extension.end_date']; ?>"
			id="partners_movement_action_extension-end_date"  value="<?php echo $record['partners_movement_action_extension.end_date'] ?>" placeholder="Enter End Date">
			<span class="input-group-btn">
				<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
			</span>
		</div> 				
	</div>	
</div>