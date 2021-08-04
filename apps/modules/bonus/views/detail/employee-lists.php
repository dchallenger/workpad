<tr employee_id="<?php echo $employee->employee_id?>">
	<td>
		<span class="text-success"><?php echo $employee->full_name?></span>
		<br>
		<a id="date_name" href="#" class="text-muted small"><?php echo $employee->id_number?></a>
	</td> 
	<td class="list_amount_container" align="right">
		<?php echo $employee->amount?>
	</td>
</tr>