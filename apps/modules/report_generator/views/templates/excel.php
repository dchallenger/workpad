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
	foreach( $result as $row ) : ?>
		<tr><?php
			foreach($columns as $column): 
				$alias = $column->alias; ?>
				<td><?php echo (in_array($row->$alias,array('1970-01-01','0000-00-00')) ? '' : $row->$alias) ?></td> <?php
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