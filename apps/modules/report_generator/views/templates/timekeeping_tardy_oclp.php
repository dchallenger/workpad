<?php
	if( !empty( $header->template ) )
	{
		echo $this->parser->parse_string($header->template, $vars, TRUE);
	}
?>
<?php
	$full_name = "Full Name";
	$user_id = "User Id";
	$id_number = "Id Number";
	$date = "Date";
	$time_in = "Time In";
	$late = "Late(s) Min";
	$department = "Department";
	$shift = "Shift";

	$result = $result->result();
	//debug($result); die();
	foreach( $result as $row )
	{
		$com[$row->$department][$row->$user_id][] = $row; 
	}

	$result = $this->db->get('ww_time_record_tardiness_settings');
	$instance = 0;
	$minutes = 0;
	if ($result && $result->num_rows() > 0){
		$tardy_config = $result->row();
		$instance = $tardy_config->instances;
		$minutes = $tardy_config->minutes_tardy;		
	}
?>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td colspan="6">Tardiness Report</td>
	</tr>
	<tr>
		<?php 
			$date_range = array();
			if (!empty($filter)) {
				foreach ($filter as $key => $value) {
					if(strtotime($value))
						$date_range[] = $value;
				}
			}		
		?>
		<td><?php echo implode(' - ', $date_range) ?></td>
	</tr>	
	<?php
	foreach( $com as $dept => $emp ): ?>
		<tr>
			<td>ID Number</td>		
			<td>Name</td>
			<td>Date</td>
			<td>Shift</td>
			<td>Time In</td>
			<td>Late (Min)</td>
		</tr> 	
		<tr>
			<td colspan="6">&nbsp;&nbsp;<?php echo $dept?></td>
		</tr> <?php
		foreach( $emp as $num => $rows ):
			$start = true;
			$lates = 0;
			$undertimes = 0;
			$count = 0;
			foreach( $rows as $row ):
				$lates += empty($row->$late) ? 0 : intval($row->$late);
				$count ++;
		?>
				<tr>
					<td><?php if( $start ) echo $row->$id_number?> </td>
					<td><?php if( $start ) echo $row->$full_name?> </td>
					<td> <?php echo $row->$date?> </td>										
					<td> <?php echo $row->$shift?> </td>					
					<td> <?php echo $row->$time_in?> </td>
					<td> <?php if($row->$late != '0.00') echo intval($row->$late)?> </td>					
				</tr> <?php
				$start = false;
			endforeach; ?>
			<tr>
				<td></td>
				<td></td>
				<td>Total Infraction</td>				
				<td><?php echo $count ?></td>
				<td>Total Lates  </td>
				<td><?php if(!empty($lates)) echo intval($lates)?></td>
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