<form id="cancel_form">
<?php 
if(count($selected_dates['dates']) > 0 ){
	$countSelectedDates = 0;
	foreach ($selected_dates['dates'] as $index => $value){
        $array_keys = array_keys($value);
        $array_values = array_values($value);
        $date_label = $selected_dates['date_label'][$index];
?>
		<div style="word-wrap:break-word;" class="<?php if( $countSelectedDates > 4 ) echo 'hidden'; ?> toggle-<?php echo $countSelectedDates; ?>">
    		<div class="col-md-5 padding-none">
    			{{ $index }}
        		<span class=""> - {{ $array_keys[0] }} :</span>
        	</div>
    		<div class="col-md-4 padding-none">
				<select class="duration form-control select2me" data-placeholder="Select..." name="duration[{{$date_label}}]" id="duration[]" class="duration" style="display: inline-block;width: 140px;">
	                <?php foreach($selected_dates['duration'] as $val) {
	                    $selected_duration = ($array_values[0] == $val['duration_id']) ? "selected" : "";
	                    if ($array_values[0] > 1 && $array_values[0] != $val['duration_id'])
	                    	continue;
	                ?>
	                	<option value="<?=$val['duration_id']?>" <?php echo $selected_duration; ?> ><?=$val['duration']?></option>
	                <?php } ?>
	            </select>
    		</div>
    		<div class="col-md-3 padding-none">
                @if ($form_approver_details['approver_status_id'] == 6 && $form_approver_details['within_cutoff'])
                	<span style="padding-left:5px"><input type="checkbox" value="" class="toggle" id="ut_type-temp" name="cancel[{{$date_label}}]" class="" checked /> Cancel</span>
                @endif
    		</div>
    	</div>
  		<?php 
  		if(($countSelectedDates+1) % 5 == 0 && 
  			$countSelectedDates > 1 && 
  			(($countSelectedDates+1) < count($selected_dates['dates'])) 
  		){ ?>
			<div class="col-md-4 padding-none <?php if( $countSelectedDates != 4 ) echo 'hidden'; ?> toggler-<?php echo $countSelectedDates; ?>" style="word-wrap:break-word;float: none;">
    			<span class="btn btn-xs blue btn-border-radius" onclick="selectedDates_showmore_div(<?php echo $countSelectedDates; ?>)"> see more <i class="fa fa-arrow-circle-o-right"></i> 
    			</span>
			</div>		
<?php
		}
		$countSelectedDates++;
	}
}
?>
</form>