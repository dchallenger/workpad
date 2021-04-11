<div class="form-group">
	<label class="col-md-4 text-muted text-right">
		Blacklisted:
	</label>
	<div class="col-md-7">
		<?php echo ($record['partners_movement_action_moving.blacklisted'] ? 'Yes' : 'No') ?>
	</div>
</div>	
	
<div class="form-group">
	<label class="col-md-4 text-muted text-right">
		Eligible for Rehire:
	</label>
	<div class="col-md-7">
		<?php echo ($record['partners_movement_action_moving.eligible_for_rehire'] ? 'Yes' : 'No') ?>
	</div>
</div>