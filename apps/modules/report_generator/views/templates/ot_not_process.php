<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	if( !empty( $header->template ) )
	{
		echo $this->parser->parse_string($header->template, $vars, TRUE);
	}
?>
<table cellspacing="0" cellpadding="1" border="1">
	<tr> <?php
		foreach($columns as $column): ?>
			<td><?php echo $column->alias?></td> <?php
		endforeach; ?>
	</tr><?php
	
	$result = $result->result();

	$id_number_array = array();

	$id_number = "Id Number";
	$ot_hours = "OT Hours";

	foreach( $result as $row ) : ?>
		<tr><?php
			if (!in_array($row->$id_number, $id_number_array))
				array_push($id_number_array, $row->$id_number);

			foreach($columns as $column): 
				$alias = $column->alias; ?>
				<td>
					<?php 
						switch ($alias) {
							case 'Date':
								echo date('m/d/Y',strtotime($row->$alias));
							break;
							default:
								echo $row->$alias;
						}
					?>
				</td><?php
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