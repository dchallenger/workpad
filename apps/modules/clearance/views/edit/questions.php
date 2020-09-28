
<?php 
$disabled = 'disabled';

$count = (isset($count) ? $count : 0);
	foreach( $records as $value)
	{
?>
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo ++$count.". ".$value['item'] ?>
					<span class="pull-right hidden"><a class="small text-muted" onclick="delete_item($(this))" href="#">Delete</a></span>
				</h3>
				<input type="hidden" name="item[]" value="<?php echo $value['item'] ?>">
				<input type="hidden" name="exit_interview_layout_item_id[]" value="<?php echo $value['exit_interview_layout_item_id'] ?>">
			</div>
			
			<table class="table">
				<?php if ($value['wiht_yes_no'] == 0) { ?>
					<tr >
						<td class="active"><span class="bold">Answer</td>
						<td>											
							<div class="form-group">
								<label class="col-md-1 control-label">&nbsp;</label>
								<div class="radio-list">
									<label class="radio-inline">
									<input type="radio" name="answer[<?php echo $value['exit_interview_layout_item_id'] ?>]" id="optionsRadios4" value="1" <?php echo $disabled ?>> Not at All </label>
									<label class="radio-inline">
									<input type="radio" name="answer[<?php echo $value['exit_interview_layout_item_id'] ?>]" id="optionsRadios5" value="2" <?php echo $disabled ?>> Small Degree </label>
									<label class="radio-inline">
									<input type="radio" name="answer[<?php echo $value['exit_interview_layout_item_id'] ?>]" id="optionsRadios6" value="3" <?php echo $disabled ?>> Moderate Degree </label>
									<label class="radio-inline">
									<input type="radio" name="answer[<?php echo $value['exit_interview_layout_item_id'] ?>]" id="optionsRadios6" value="4" <?php echo $disabled ?>> High Degree </label>															
								</div>
							</div>												
						</td>
						<!-- <td><textarea rows="2" class="form-control" name="interview[]">{{ $value['remarks'] }}</textarea></td> -->
					</tr>
				<?php } ?>
				<?php if ($value['wiht_yes_no']) { ?>
					<tr >
						<td class="active"><span class="bold">Answer</td>
						<td>
	                        <div class="form-group">
	                            <div class="col-md-12">
	                            	<input type="hidden" name="yes_no[<?php echo $value['exit_interview_layout_item_id'] ?>]" class="wiht_yes_no" value="1" readonly/>
									<textarea rows="2" class="form-control" name="answer_text[<?php echo $value['exit_interview_layout_item_id'] ?>]" <?php echo $disabled ?>></textarea>
	                            </div>  
	                        </div>	
						</td>
					</tr>	
				<?php 
					} 	
				?>																														
			</table>
		</div>
<?php
	}
?>

<script language="javascript">
    $(document).ready(function(){
        $('.make-switch').not(".has-switch")['bootstrapSwitch']();

        $('.wiht_yes_no-temp').change(function(){
            if( $(this).is(':checked') ){
                $(this).closest('td').find('.wiht_yes_no').val('1');
            }else{
                $(this).closest('td').find('.wiht_yes_no').val('5');            	
            }
        });
    });
</script>							