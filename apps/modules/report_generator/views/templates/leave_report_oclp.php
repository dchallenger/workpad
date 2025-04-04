<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	if( !empty( $header->template ) )
	{
		echo $this->parser->parse_string($header->template, $vars, TRUE);
	}
?>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td>Leave Report</td>
	</tr>	
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
	foreach( $result as $row ) : ?>
		<tr><?php
			foreach($columns as $column): 
				$alias = $column->alias; ?>
				<td><?php echo $row->$alias?></td> <?php
			endforeach; ?>
		</tr> <?php
	endforeach; ?>
</table>
<?php
	if( !empty( $footer->template ) )
	{
		echo $this->parser->parse_string($footer->template, $vars, TRUE);
	}
?>