<input type="hidden" name="partners_movement_action_moving[id]" id="partners_movement_action_moving-id">
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

<script language="javascript">
$(document).ready(function(){
        
    if (jQuery().select2) {
	    $("#partners_movement_action_moving-reason_id").select2({
			placeholder: "Select a reason",
			allowClear: true
		});
		$('body').removeClass("modal-open"); 
	}

    if (jQuery().datepicker) {
    	$("#partners_movement_action_moving-end_date").datepicker().datepicker('disable');
/*        $('#partners_movement_action_moving-end_date').parent('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });*/
        $('body').removeClass("modal-open"); 
    }
	
	$(".make-switch").bootstrapSwitch();
  
	$('#partners_movement_action_moving-blacklisted-temp').change(function(){
		if( $(this).is(':checked') )
			$('#partners_movement_action_moving-blacklisted').val('1');
		else
			$('#partners_movement_action_moving-blacklisted').val('0');
	});

	$('#partners_movement_action_moving-eligible_for_rehire-temp').change(function(){
		if( $(this).is(':checked') )
			$('#partners_movement_action_moving-eligible_for_rehire').val('1');
		else
			$('#partners_movement_action_moving-eligible_for_rehire').val('0');
	});	

});
</script>