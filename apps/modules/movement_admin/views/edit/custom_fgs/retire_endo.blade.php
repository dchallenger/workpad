<input type="hidden" name="partners_movement_action_moving[id]" id="partners_movement_action_moving-id" value="<?php echo $record['partners_movement_action_moving.id']; ?>" />	
<div class="form-group">
	<label class="control-label col-md-3">Blacklisted
	</label>
	<div class="col-md-7">							
		<div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
			<input type="checkbox" value="1" <?php if ( $record['partners_movement_action_moving.blacklisted'] ){ echo "checked='checked'"; } ?> 
			name="partners_movement_action_moving[blacklisted][temp]" id="partners_movement_action_moving-blacklisted-temp" class="dontserializeme toggle"/>
			<input type="hidden" name="partners_movement_action_moving[blacklisted]" id="partners_movement_action_moving-blacklisted" 
			value="<?php echo ( $record['partners_movement_action_moving.blacklisted'] ) ? 1 : 0 ?>"/>
		</div> 				
	</div>	
</div>				
<div class="form-group">
	<label class="control-label col-md-3">Eligible for Rehire
	</label>
	<div class="col-md-7">							
		<div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
			<input type="checkbox" value="1" <?php if ( $record['partners_movement_action_moving.eligible_for_rehire'] ){ echo "checked='checked'"; } ?> 
			name="partners_movement_action_moving[eligible_for_rehire][temp]" id="partners_movement_action_moving-eligible_for_rehire-temp" class="dontserializeme toggle"/>
			<input type="hidden" name="partners_movement_action_moving[eligible_for_rehire]" id="partners_movement_action_moving-eligible_for_rehire" 
			value="<?php echo ( $record['partners_movement_action_moving.eligible_for_rehire'] ) ? 1 : 0 ?>"/>
		</div> 				
	</div>	
</div>