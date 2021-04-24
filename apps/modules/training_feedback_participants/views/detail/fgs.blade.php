<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Participant Information</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">
		<div class="form-group">
			<label class="control-label col-md-3">Participant Name</label>
			<div class="col-md-7">
				<input type="text" class="form-control" value="{{ $record['training_feedback_name'] }}" readonly="readonly" /> 
			</div>	
		</div>			
	</div>
</div>
<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Training Session Details</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">	
		<table class="table">
			<thead>
				<tr>
					<th>Start Date</th>
					<th>Start Time</th>
					<th>End Time</th>
					<th>Instructor</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{{ date('F d, Y', strtotime($record['training_feedback_start_date'])) }}</td>
					<td>{{ date('H:i a', strtotime($record['training_feedback_start_time'])) }}</td>
					<td>{{ date('H:i a', strtotime($record['training_feedback_end_time'])) }}</td>
					<td>{{ $record['training_feedback_instructor'] }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Feedback Questionnaire</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">	
		<div>
			<b>
				<span>1 - Needs improvement</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span>2 - Fair</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span>3 - Satisfactory</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span>4 - Good</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span>5- Excellent</span>
			</b>
		</div><br/>
		<table class="table table-striped table-bordered table-advance table-hover">
		    <tbody>
			<?php 
				if( $feedback_questionnaire_item_count > 0 ){
					$current_section_type = 0;
					$current_feedback_category = 0;
					foreach( $feedback_questionnaire_items as $questionnaire_info ){
						if( $current_feedback_category != $questionnaire_info['evaluation_template_id'] ){
			?>
				<tr>
			        <th style="vertical-align:middle; text-align:left; font-weight:bold;" colspan="7" class="odd">
			        	<?= $questionnaire_info['title'] ?>
			        </th>
			    </tr>
				<?php
					$current_section_type = 0;
				 	}

					if( $questionnaire_info['section_type_id'] == 1 ) { // 5-point scale
						if( $current_section_type == $questionnaire_info['section_type_id'] ){
							$qi1 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 1.00 ? "checked" : '';
							$qi2 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 2.00 ? "checked" : '';
							$qi3 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 3.00 ? "checked" : '';
							$qi4 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 4.00 ? "checked" : '';
							$qi5 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 5.00 ? "checked" : '';
						?>
							<tr>
					            <td style="text-align:left; vertical-align:top;" colspan="2"><?= $questionnaire_info['template_section'] ?></td>
					            <td style="text-align:center;"><label class="radio-inline"><input type="radio" value="5" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi5; ?> disabled/></label></td>
					            <td style="text-align:center;"><label class="radio-inline"><input type="radio" value="4" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi4; ?> disabled/></label></td>
					            <td style="text-align:center;"><label class="radio-inline"><input type="radio" value="3" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi3; ?> disabled/></label></td>
					            <td style="text-align:center;"><label class="radio-inline"><input type="radio" value="2" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi2; ?> disabled/></label></td>
					            <td style="text-align:center;"><label class="radio-inline"><input type="radio" value="1" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi1; ?> disabled/></label></td>					            
					        </tr>
						<?php
						}
						else{
						?>
							<tr>
						        <th style="vertical-align:middle; width:40%;" class="odd" colspan="2">
						        </th>
						        <th style="vertical-align:middle; width:12%; text-align:center;" class="odd">
						        	Excellent
						        </th>
						        <th style="vertical-align:middle; width:12%; text-align:center;" class="odd">
						        	Good
						        </th>
						        <th style="vertical-align:middle; width:12%; text-align:center;" class="odd">
						        	Satisfactory
						        </th>
						        <th style="vertical-align:middle; width:12%; text-align:center;" class="odd">
						        	Fair
						        </th>
						        <th style="vertical-align:middle; width:12%; text-align:center;" class="odd">
						        	Needs improvement
						        </th>
						    </tr>
						    <?php 
					    		$qi1 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 1.00 ? "checked" : '';
								$qi2 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 2.00 ? "checked" : '';
								$qi3 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 3.00 ? "checked" : '';
								$qi4 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 4.00 ? "checked" : '';
								$qi5 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 5.00 ? "checked" : '';
						    ?>
					    	<tr>
	 							<td style="text-align:left; vertical-align:top;" colspan="2"><?= $questionnaire_info['template_section'] ?></td>
					            <td style="text-align:center;"><label class="radio-inline"><input type="radio" value="5" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi5; ?> disabled/></label></td>
					            <td style="text-align:center;"><label class="radio-inline"><input type="radio" value="4" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi4; ?> disabled/></label></td>
					            <td style="text-align:center;"><label class="radio-inline"><input type="radio" value="3" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi3; ?> disabled/></label></td>
					            <td style="text-align:center;"><label class="radio-inline"><input type="radio" value="2" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi2; ?> disabled/></label></td>					            					            					             
   					            <td style="text-align:center;"><label class="radio-inline"><input type="radio" value="1" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi1; ?> disabled/></label></td>
				            </tr>
						<?php
						}
					} 
					elseif( $questionnaire_info['section_type_id'] == 2 ){ // Yes or No
						if( $current_section_type == $questionnaire_info['section_type_id'] ){

						$yes = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 5.00 ? "checked" : '';
						$no = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 0 ? "checked" : '';
						?>
							<tr>
					            <td style="text-align:left; vertical-align:top;" colspan="2"><?= $questionnaire_info['template_section'] ?></td>
					            <td style="text-align:left;"><input type="radio" value="5" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $yes; ?>/>Yes</td>
					            <td style="text-align:left;" colspan="5"><input type="radio" value="0" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php $no; ?>/>No</td>
					        </tr>
						<?php
						}
						else{
						?>
							<tr>
						        <th style="vertical-align:middle; width:100%;" colspan="7" class="odd"></th>
						    </tr>
					    <?php 
					    $yes = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 5.00 ? "checked" : '';
						$no = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 0 ? "checked" : '';
					    ?>
					    	<tr>
					            <td style="text-align:left; vertical-align:top;" colspan="2"><?= $questionnaire_info['template_section'] ?></td>
					            <td style="text-align:left;"><input type="radio" value="5" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $yes; ?>/>Yes</td>
					            <td style="text-align:left;" colspan="5"><input type="radio" value="0" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php $no; ?>/>No</td>
					        </tr>
					    <?php
						}
					}
					elseif( $questionnaire_info['section_type_id'] == 3 ){ // Essay
						if( $current_section_type == $questionnaire_info['section_type_id'] ){
						?>
							<tr>
					            <td style="text-align:left; vertical-align:top;"><?= $questionnaire_info['template_section'] ?></td>
					            <?php $questionnaire_info_remarks = isset($questionnaire_info['remarks'])  ? $questionnaire_info['remarks'] : ''; ?>
					            <td style="text-align:left;" colspan="6"><textarea class="form-control" style="width:100%;" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" readonly><?php echo $questionnaire_info_remarks; ?></textarea></td>
					        </tr>
						<?php
						}
						else{
						?>
							<tr>
						        <th style="vertical-align:middle; width:100%;" colspan="7" class="odd"></th>
						    </tr>
					    	<tr>
					            <td style="text-align:left; vertical-align:top;"><?= $questionnaire_info['template_section'] ?></td>
					            <?php $questionnaire_info_remarks = isset($questionnaire_info['remarks'])  ? $questionnaire_info['remarks'] : ''; ?>
					            <td style="text-align:left;" colspan="6"><textarea class="form-control" style="width:100%;" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" readonly><?php echo $questionnaire_info_remarks; ?></textarea></td>
					        </tr>
						<?php
						}
					}
					elseif( $questionnaire_info['section_type_id'] == 4 ){ // 6-point scale
						if( $current_section_type == $questionnaire_info['section_type_id'] ){
							$qi0 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 0.00 ? "checked" : '';
							$qi1 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 1.00 ? "checked" : '';
							$qi2 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 2.00 ? "checked" : '';
							$qi3 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 3.00 ? "checked" : '';
							$qi4 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 4.00 ? "checked" : '';
							$qi5 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 5.00 ? "checked" : '';
						?>
							<tr>
					            <td style="text-align:left; vertical-align:top;"><?= $questionnaire_info['template_section'] ?></td>  
					        	<td style="text-align:center;"><label class="radio-inline"><input type="radio" value="1" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi0; ?> /></label></td>
					            <td style="text-align:center;"><label class="radio-inline"><input type="radio" value="1" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi1; ?> /></label></td>
					            <td style="text-align:center;"><label class="radio-inline"><input type="radio" value="2" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi2; ?> /></label></td>
					            <td style="text-align:center;"><label class="radio-inline"><input type="radio" value="3" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi3; ?> /></label></td>
					            <td style="text-align:center;"><label class="radio-inline"><input type="radio" value="4" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi4; ?> /></label></td>
					            <td style="text-align:center;"><label class="radio-inline"><input type="radio" value="5" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi5; ?> /></label></td> 
					        </tr>
						<?php
						}
						else{
						?>
							<tr>
						        <th style="vertical-align:middle; width:40%;" class="odd">
						        </th>
						        <th style="vertical-align:middle; width:12%;" class="odd">
						        	Not Much
						        </th>
						        <th style="vertical-align:middle; width:12%;" class="odd">
						        	Basic
						        </th>
						        <th style="vertical-align:middle; width:12%;" class="odd">
						        	Average
						        </th>
						        <th style="vertical-align:middle; width:12%;" class="odd">
						        	Good
						        </th>
						        <th style="vertical-align:middle; width:12%;" class="odd">
						        	Very Good
						        </th>
						        <th style="vertical-align:middle; width:12%;" class="odd">
						        	Excellent
						        </th>
						    </tr>
						    <?php 
						    $qi0 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 0.00 ? "checked" : '';
							$qi1 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 1.00 ? "checked" : '';
							$qi2 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 2.00 ? "checked" : '';
							$qi3 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 3.00 ? "checked" : '';
							$qi4 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 4.00 ? "checked" : '';
							$qi5 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 5.00 ? "checked" : '';
						    ?>
					    	<tr>
					            <td style="text-align:left; vertical-align:top;"><?= $questionnaire_info['template_section'] ?></td>
								<td style="text-align:center;"><label class="radio-inline"><input type="radio" value="1" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi0; ?> /></label></td>
					            <td style="text-align:center;"><label class="radio-inline"><input type="radio" value="1" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi1; ?> /></label></td>
					            <td style="text-align:center;"><label class="radio-inline"><input type="radio" value="2" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi2; ?> /></label></td>
					            <td style="text-align:center;"><label class="radio-inline"><input type="radio" value="3" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi3; ?> /></label></td>
					            <td style="text-align:center;"><label class="radio-inline"><input type="radio" value="4" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi4; ?> /></label></td>
					            <td style="text-align:center;"><label class="radio-inline"><input type="radio" value="5" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi5; ?> /></label></td>  
					        </tr>
						<?php
						}
					}
					elseif( $questionnaire_info['section_type_id'] == 5 ){ // 4-point scale
						if( $current_section_type == $questionnaire_info['section_type_id'] ){

						$qi1 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 1.25 ? "checked" : '';
						$qi2 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 2.5 ? "checked" : '';
						$qi3 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 3.75 ? "checked" : '';
						$qi4 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 5 ? "checked" : '';
						?>
							<tr>
					            <td style="text-align:left; vertical-align:top;" colspan="3"><?= $questionnaire_info['template_section'] ?></td>
					            <td style="text-align:center;"><input type="radio" value="1.25" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi1; ?> /></td>
					            <td style="text-align:center;"><input type="radio" value="2.5" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi2; ?>/></td>
					            <td style="text-align:center;"><input type="radio" value="3.75" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi3; ?>/></td>
					            <td style="text-align:center;"><input type="radio" value="5" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi4; ?>/></td>
					        </tr>
						<?php
						}
						else{
						?>
							<tr>
						        <th style="vertical-align:middle; width:40%;" class="odd" colspan="3">
						        </th>
						        <th style="vertical-align:middle; width:12%;" class="odd">
						        	Unsatisfactory
						        </th>
						        <th style="vertical-align:middle; width:12%;" class="odd">
						        	Needs improvement
						        </th>
						        <th style="vertical-align:middle; width:12%;" class="odd">
						        	Meets requirements
						        </th>
						        <th style="vertical-align:middle; width:12%;" class="odd">
						        	Excellent
						        </th>
						    </tr>
						    <?php 
						    $qi1 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 1.25 ? "checked" : '';
							$qi2 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 2.5 ? "checked" : '';
							$qi3 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 3.75 ? "checked" : '';
							$qi4 = isset($questionnaire_info['score']) && $questionnaire_info['score'] == 5 ? "checked" : '';
						    ?>
					    	<tr>
	 							<td style="text-align:left; vertical-align:top;" colspan="3"><?= $questionnaire_info['template_section'] ?></td>
					            <td style="text-align:center;"><input type="radio" value="1.25" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi1; ?> /></td>
					            <td style="text-align:center;"><input type="radio" value="2.5" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi2; ?>/></td>
					            <td style="text-align:center;"><input type="radio" value="3.75" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi3; ?>/></td>
					            <td style="text-align:center;"><input type="radio" value="5" class="feedback_average" name="template_section[<?= $questionnaire_info['template_section_id'] ?>]" <?php echo $qi4; ?>/></td>
					        </tr>
						<?php
						}
					} 
					$current_section_type = $questionnaire_info['section_type_id'];
					$current_feedback_category = $questionnaire_info['evaluation_template_id'];
					}
				}
			?>
		    </tbody>
		</table>
		<div class="form-group">
			<label class="control-label col-md-3">Total Score</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="training_feedback[total_score]" id="total_score" value="{{ $record['training_feedback_total_score'] }}" readonly /> 
			</div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3">Average Score</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="training_feedback[average_score]" id="average_score" value="{{ $record['training_feedback_average_score'] }}" readonly/> 
			</div>	
		</div>
	</div>
</div>