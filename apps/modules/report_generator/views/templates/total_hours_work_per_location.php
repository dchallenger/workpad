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
	$total = array();
	$location = "Location";
	$hours_work = "Hours Work";
	$absent = "Absent";
	$late = "Late";
	$ut = "Ut";
	$ot = "Ot";
	$total_hours_work = 0;
	$total_absent = 0;
	$total_late = 0;
	$total_ut = 0;
	$total_ot = 0;

	$result = $result->result();
	foreach ($result as $row) {
		$total_hours_work += $row->$hours_work;
		$total_absent = $row->$absent;
		$total_late = $row->$late;
		$total_ut = $row->$ut;
		$total_ot = $row->$ot;

		$total[$row->$location][$hours_work] = $total_hours_work;
		$total[$row->$location][$absent] = $total_absent;
		$total[$row->$location][$late] = $total_late;
		$total[$row->$location][$ut] = $total_ut;
		$total[$row->$location][$ot] = $total_ot;
	}
	
	foreach( $total as $location => $value ) : ?>
		<tr>
			<td><?php echo $location?></td>
			<td><?php echo $value['Hours Work'] ?></td>
			<td><?php echo $value['Absent'] ?></td>
			<td><?php echo $value['Late'] ?></td>
			<td><?php echo $value['Ut'] ?></td>
			<td><?php echo $value['Ot'] ?></td>
		</tr> <?php
	endforeach; ?>
</table>
<?php
	if( !empty( $footer->template ) )
	{
		echo $this->parser->parse_string($footer->template, $vars, TRUE);
	}
?>