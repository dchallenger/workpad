<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<div align="center">
	<?php
		if( !empty( $header->template ) )
		{
			echo '<span style="font-weight: bold;">'. $this->parser->parse_string($header->template, $vars, TRUE).'</span>';
		}

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
	<br>
	<span style="font-weight: bold;"><?php echo implode(' - ', $date_range) ?></span>
</div>

<br>

<table cellspacing="0" cellpadding="1" border="1">
	<tr> 
<?php
		foreach($columns as $column): ?>
			<td style="font-weight: bold; text-align:center;<?php echo ($column->alias == 'Employee Name' ? 'width:100px' : '') ?>"><?php echo $column->alias?></td> <?php
		endforeach; ?>
	</tr>

	<?php

	$result = $result->result();

	$id_number_array = array();

	$id_number = "Id Number";
	$hrs_rendered = "Hours Rendered";
	$hrs_work = "Hours Work";
	$absent = "Absent";
	$late = "Late";
	$ut = "Ut";
	$ot = "Ot";

	$total_hrs_rendered = 0;
	$total_hrs_work = 0;
	$total_absent = 0;
	$total_late = 0;
	$total_ut = 0;
	$total_ot = 0;
	$ctr = 0;
	foreach( $result as $row ) : 
		$ctr++;
/*		if (($ctr % 39) == 0)
			echo '<br style="page-break-before: always;">';*/
?>
		<tr><?php
			if (!in_array($row->$id_number, $id_number_array))
				array_push($id_number_array, $row->$id_number);

			foreach($columns as $column): 
				$alias = $column->alias;
				if (in_array($alias,array('Hours Rendered','Hours Work','Absent','Late','Ut','Ot')))
					echo '<td style="text-align:right">'.$row->$alias.'</td>';
				else 
					echo '<td>'.$row->$alias.'</td>';
			endforeach; ?>
		</tr> <?php
		$total_hrs_rendered += $row->$hrs_rendered;
		$total_hrs_work += $row->$hrs_work;
		$total_absent += $row->$absent;
		$total_late += $row->$late;
		$total_ut += $row->$ut;
		$total_ot += $row->$ot;		
	endforeach; ?>
</table>
<table cellspacing="0" cellpadding="1" border="0">
	<tr style="font-weight: bold;">
		<td>Total Number of Employee(s)</td>
		<td style="text-align:right;width:100px"><?php echo count($id_number_array)?></td>
		<td></td>
		<td></td>
		<td>Total</td>
		<td style="text-align:right"><?php echo $total_hrs_rendered ?></td>
		<td style="text-align:right"><?php echo $total_hrs_work ?></td>
		<td style="text-align:right"><?php echo $total_absent ?></td>
		<td style="text-align:right"><?php echo $total_late ?></td>
		<td style="text-align:right"><?php echo $total_ut ?></td>
		<td style="text-align:right"><?php echo $total_ot ?></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>	
</table>
<?php
	if( !empty( $footer->template ) )
	{
		echo $this->parser->parse_string($footer->template, $vars, TRUE);
	}
?>