<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	if( !empty( $header->template ) )
	{
		echo $this->parser->parse_string($header->template, $vars, TRUE);
	}
?>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<?php 
			$date_range = array();
			if (!empty($filter)) {
				foreach ($filter as $key => $value) {
					if (!is_array($value)) {
						if(strtotime($value))
							$date_range[] = $value;
					}
				}
			}		
		?>
		<td><?php echo implode(' - ', $date_range) ?></td>
	</tr>
	<tr> <?php
		foreach($columns as $column): ?>
			<td><?php echo $column->alias?></td> <?php
		endforeach; ?>
	</tr><?php
	
	$result = $result->result();

	$id_number_array = array();

	$id_number = "Id Number";
	$hrs_rendered = "Hours Rendered";
	$hrs_work = "Hours Work";
	$absent = "Absent";
	$late = "Late";
	$ut = "Ut";
	$ot = "Ot";
	$reg_nd = "Reg Nd";

	$total_hrs_rendered = 0;
	$total_hrs_work = 0;
	$total_absent = 0;
	$total_late = 0;
	$total_ut = 0;
	$total_ot = 0;
	$total_reg_nd = 0;

	foreach( $result as $row ) : ?>
		<tr><?php
			if (!in_array($row->$id_number, $id_number_array))
				array_push($id_number_array, $row->$id_number);

			foreach($columns as $column): 
				$alias = $column->alias; ?>
				<td><?php echo $row->$alias?></td> <?php
			endforeach; ?>
		</tr> <?php
		$total_hrs_rendered += $row->$hrs_rendered;
		$total_hrs_work += $row->$hrs_work;
		$total_absent += $row->$absent;
		$total_late += $row->$late;
		$total_ut += $row->$ut;
		$total_ot += $row->$ot;
		$total_reg_nd += $row->$reg_nd;
	endforeach; ?>
	<tr>
		<td>Total Number of Employee(s)</td>
		<td><?php echo count($id_number_array)?></td>
		<td></td>
		<td></td>
		<td>Total</td>
		<td><?php echo $total_hrs_rendered ?></td>
		<td><?php echo $total_hrs_work ?></td>
		<td><?php echo $total_reg_nd ?></td>
		<td><?php echo $total_absent ?></td>
		<td><?php echo $total_late ?></td>
		<td><?php echo $total_ut ?></td>
		<td><?php echo $total_ot ?></td>
	</tr>
</table>
<?php
	if( !empty( $footer->template ) )
	{
		echo $this->parser->parse_string($footer->template, $vars, TRUE);
	}
?>