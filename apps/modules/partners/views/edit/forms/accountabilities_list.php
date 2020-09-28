<?php 
foreach($accountabilities_tab as $index => $accountable){ 
	?>
	<tr class="record">
		<!-- this first column shows the year of this holiday item -->
		<td><input type="checkbox" class="checkboxes record-checker" value="<?=$index?>" /></td>
		<td>
			<?php echo (isset($accountable['accountabilities-name']) ? $accountable['accountabilities-name'] : ""); ?>	
			<br />
			<span id="date_set" class="small">
				<?php echo (isset($accountable['accountabilities-code']) ? $accountable['accountabilities-code'] : ""); ?>	
			</span>
		</td>
		<td class="hidden-xs">
			<?php echo (isset($accountable['accountabilities-quantity']) ? $accountable['accountabilities-quantity']." pcs" : ""); ?>
		</td>
		<td>
			<div class="btn-group">
				<input type="hidden" id="accountabilities_sequence" name="accountabilities_sequence" value="<?=$index?>" />
				<a  href="javascript:edit_personal_details('accnt_form_edit_modal', 'accountabilities', <?=$index?>);" class="btn btn-xs text-muted"  ><i class="fa fa-pencil"></i> Edit</a>
			</div>
			<div class="btn-group">
				<a href="javascript:delete_record(<?=$index?>, 'accountabilities')" class="btn btn-xs text-muted"><i class="fa fa-trash-o"></i> Delete</a>
			</div>
		</td>
	</tr>
	<?php } ?>