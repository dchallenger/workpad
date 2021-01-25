<?php
	if( !empty( $header->template ) )
	{
		echo $this->parser->parse_string($header->template, $vars, TRUE);
	}
?>
<?php
	//prep data
	$id_number = "Employee Id Number";
	$full_name = "Employee Name";
	$prev_sl = "Previous Year SL";
	$sl_earned = "SL Earned";
	$sl_used = "SL Used";
	$sl_balance = "SL Balance";
	$prev_vl = "Previous Year VL";
	$vl_earned = "VL Earned";
	$vl_used = "VL Used";
	$el_used = "EL Used";
	$vl_balance = "VL Balance";
	$company = "Company";

	$result = $result->result();
	// debug($result); die();
	foreach( $result as $row )
	{
		$data[$row->$company][] = $row; 
	}

	$year = '';
	if (isset($filter[$filter_var['payroll_year']])) {
		$year = ' for '.$filter[$filter_var['payroll_year']];
	}
?>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td colspan="11">Leave Balance Report <?php echo $year ?></td>
	</tr>	
	<tr>
		<td style="font-weight:bold; text-align:center">ID Number</td>
		<td style="font-weight:bold; text-align:center">Employee Name</td>
		<td style="font-weight:bold; text-align:center">Previous Year SL</td>
		<td style="font-weight:bold; text-align:center">SL Earned</td>
		<td style="font-weight:bold; text-align:center">SL Used</td>
		<td style="font-weight:bold; text-align:center">SL Balance</td>
		<td style="font-weight:bold; text-align:center">Previous Year VL</td>
		<td style="font-weight:bold; text-align:center">VL Earned</td>
		<td style="font-weight:bold; text-align:center">VL Used</td>
		<td style="font-weight:bold; text-align:center">EL Used</td>
		<td style="font-weight:bold; text-align:center">VL Balance</td>		
	</tr> <?php
	
	foreach( $data as $company => $info ): 
		// debug(key($emp));die();
	?>
		<tr>
			<td colspan="11" style="font-weight:bold"><?php echo $company; ?></td>
		</tr> <?php
		foreach( $info as $id => $row ):
			 ?>
			<tr>
				<td style="text-align:center"><?php echo $row->$id_number?></td>
				<td style="text-align:center"><?php echo $row->$full_name?></td>
				<td style="text-align:center"><?php echo $row->$prev_sl?></td>
				<td style="text-align:center"><?php echo $row->$sl_earned?></td>
				<td style="text-align:center"><?php echo $row->$sl_used?></td>
				<td style="text-align:center"><?php echo $row->$sl_balance?></td>
				<td style="text-align:center"><?php echo $row->$prev_vl?></td>
				<td style="text-align:center"><?php echo $row->$vl_earned?></td>
				<td style="text-align:center"><?php echo $row->$vl_used?></td>
				<td style="text-align:center"><?php echo $row->$el_used?></td>
				<td style="text-align:center"><?php echo $row->$vl_balance?></td>
			</tr> <?php
		endforeach;
	endforeach; ?>
</table>
<?php
	if( !empty( $footer->template ) )
	{
		echo $this->parser->parse_string($footer->template, $vars, TRUE);
	}
?>