<?php
$qry = "select a.section_column_id,a.title,b.uitype
FROM {$db->dbprefix}performance_template_section_column a
LEFT JOIN {$db->dbprefix}performance_template_section_column_uitype b on b.uitype_id = a.uitype_id
WHERE a.deleted = 0 AND a.template_section_id = {$section_id}
ORDER BY a.sequence";
$result = $db->query( $qry );
if ($result && $result->num_rows() > 0) 
	$columns = $result->result_array();

if ($financial_metric_details && $financial_metric_details->num_rows() > 0) {
	$ctr = 1;
	foreach ($financial_metric_details->result() as $row) {
?>
		<tr class="fmt">
			<td>
				<?php if ($ctr == 1) { ?> 
					1. <?php echo $balance_score_card['scorecard'] ?>
				<?php } else { ?>
					&nbsp;
				<?php } ?>
			</td>
			<td width="">
				<?php if ($ctr == 1) { ?>
					<input type="text" question="<?php echo $balance_score_card['scorecard_id'] ?>" value="<?php echo $row->key_in_weight ?>" class="form-control key_weight" name="field[<?php echo $balance_score_card['scorecard_id'] ?>][<?php echo $columns[1]['section_column_id'] ?>][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false">
				<?php } else { ?>
					&nbsp;
				<?php } ?>
			</td>
			<td width="" rowspan="">
				<textarea readonly class="form-control" rows="4" name="field[<?php echo $balance_score_card['scorecard_id'] ?>][<?php echo $columns[2]['section_column_id'] ?>][]"><?php echo $row->financial_metrics_kpi ?></textarea>
			</td>
			<td width="">
				<input type="text" question="<?php echo $balance_score_card['scorecard_id'] ?>" value="<?php echo $row->weight ?>" class="form-control weight" name="field[<?php echo $balance_score_card['scorecard_id'] ?>][<?php echo $columns[3]['section_column_id'] ?>][]" data-inputmask="'alias': 'deciaml', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false">
			</td>
			<td width="">
				<input readonly type="text" question="<?php echo $balance_score_card['scorecard_id'] ?>" value="<?php echo $row->value ?>" class="form-control target" name="field[<?php echo $balance_score_card['scorecard_id'] ?>][<?php echo $columns[4]['section_column_id'] ?>][]" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false">
			</td>
			<td width="" rowspan="">
				<textarea class="form-control" rows="4" name="field[<?php echo $balance_score_card['scorecard_id'] ?>][<?php echo $columns[5]['section_column_id'] ?>][]">&nbsp;</textarea>
			</td>
		</tr>
<?php
		$ctr++;
	}
}
?>