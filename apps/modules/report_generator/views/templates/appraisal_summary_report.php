<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	if( !empty( $header->template ) )
	{
		echo $this->parser->parse_string($header->template, $vars, TRUE);
	}

	$qry = "SELECT
			  GROUP_CONCAT(DISTINCT
			    CONCAT(
			      'MAX(CASE WHEN pa.year = ''',
			      pa.year,
			      ''' THEN committee_rating END) AS ''',
			      REPLACE(pa.year, ' ', ''),''''
			    )
			  ) AS summary_qry
			FROM `ww_performance_appraisal` pa
			LEFT JOIN `ww_performance_appraisal_applicable` paa ON pa.appraisal_id = paa.appraisal_id";

	$summary_result = $this->db->query($qry);

	$sum_qry = '';
	if ($summary_result && $summary_result->num_rows() > 0)
		$sum_qry = $summary_result->row()->summary_qry;

	$qry1 = "SELECT p.id_number,".$sum_qry."
			 FROM `ww_performance_appraisal` pa
			 LEFT JOIN `ww_performance_appraisal_applicable` paa ON pa.appraisal_id = paa.appraisal_id
			 LEFT JOIN `ww_partners` p  ON paa.user_id = p.user_id
			 GROUP BY paa.user_id";

	$summary_result_final = $this->db->query($qry1);

	$rate_columns = $summary_result_final->list_fields();
	unset($rate_columns[0]);

	if ($summary_result_final && $summary_result_final->num_rows() > 0) {
		$summary_arr = array();
		foreach ($summary_result_final->result_array() as $row_array) {
			$summary_arr[$row_array['id_number']] = $row_array;
		}
	}
?>
<table cellspacing="0" cellpadding="1" border="1">
	<tr> 
		<?php
			foreach($columns as $column): ?>
				<td><?php echo $column->alias?></td> <?php
			endforeach;
			if (!empty($rate_columns)) {
				foreach($rate_columns as $key => $value): ?>
					<td><?php echo $value?> Results</td> <?php
				endforeach;				
			}
		?>
	</tr><?php
	
	$result = $result->result();
	$id_number = "Id Number";

	foreach( $result as $row ) : ?>
		<tr>
			<?php
				foreach($columns as $column): 
					$alias = $column->alias;?>
					<td><?php echo $row->$alias; ?></td> <?php
				endforeach;

				if (!empty($rate_columns)) {
					foreach($rate_columns as $key => $value): 
						if (array_key_exists($row->$id_number, $summary_arr)) {
			?>
							<td><?php echo $summary_arr[$row->$id_number][$value]?></td> 
			<?php
						} else {
			?>
							<td>&nbsp;</td> 			
			<?php
						}
					endforeach;				
				}				
			?>           
		</tr> <?php	
	endforeach; ?>
</table>
<?php
	if( !empty( $footer->template ) )
	{
		echo $this->parser->parse_string($footer->template, $vars, TRUE);
	}
?>