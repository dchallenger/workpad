<tr  class="<?php if ($scorecard_id == 1) echo 'fmt' ?>">
	<?php
		if (isset($template_section_column) && !empty($template_section_column))
		{
	?>			
			<td>
				&nbsp;
			</td>			
	<?php
			foreach ($template_section_column[$section_id] as $key => $value)
			{

				switch ($value->title) {
					case 'KPI / Measures':
						if ($value->class == '')
							$value->class = 'kpi';
						break;
					case 'Target':
						if ($value->class == '')
							$value->class = 'target';
						break;
				}

				switch( $value->uitype_id )
				{
					case 2:
						if ($value->can_add_row)
						{
	?>
							<td width="<?php echo $value->width ?>">
								<input question="<?php echo $scorecard_id ?>" type="text" class="form-control <?php echo $value->class ?>" data-score-card="<?php echo $score_card ?>" name="field[<?php echo $scorecard_id ?>][<?php echo $value->section_column_id ?>][]" data-inputmask="'alias': '<?php echo $value->data_type ?>', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false">
							</td>
	<?php
						}
						else
						{
	?>
							<td width="<?php echo $value->width ?>" style="vertical-align:middle;text-align:center">
	<?php
								if ($value->sequence == 2)
								{
	?>
									<div class="btn-group">
						                <a href="javascript:void(0)" class="btn btn-danger btn-sm delete_row">
						                  	<i class="fa fa-trash-o"></i>
						                </a>
						            </div>								
	<?php
								}
								else
	?>
									&nbsp;
							</td>							
	<?php
						}
					break;
					case 3:
						if ($value->can_add_row)
						{
	?>
							<td width="<?php echo $value->width ?>" rowspan="">
								<textarea class="form-control <?php echo $value->class ?>" rows="4" data-score-card="<?php echo $score_card ?>" name="field[<?php echo $scorecard_id ?>][<?php echo $value->section_column_id ?>][]"></textarea>
							</td>										
	<?php				
						}
						else
						{
	?>
							<td width="<?php echo $value->width ?>">
								&nbsp;
							</td>					
	<?php																
						}							
					break;
				}
			}
		}
	?>
</tr>