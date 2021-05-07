<?php
$qry = "select a.*, b.uitype
FROM {$db->dbprefix}performance_template_section_column a
LEFT JOIN {$db->dbprefix}performance_template_section_column_uitype b on b.uitype_id = a.uitype_id
WHERE a.deleted = 0 AND a.template_section_id = 40
ORDER BY a.sequence";
$columns = $db->query( $qry );
?>
<div class="portlet">
	<div class="portlet-body form">
		<form class="form-horizontal">
			<div class="portlet">
				<div class="portlet-body form">
					<div class="form-body">
						<h3>Performance Planning IDP Details</h3><hr>
						<table class="table">
							<thead>
								<tr>
									<?php foreach($columns->result_array() as $key => $val) { ?>
										<th width="" class="bold">
											<span><?php echo $val['title'] ?></span>
										</th>
									<?php } ?>
									<th>Action</th>
									<th width="1%">
										&nbsp;
									</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach($list_idp->result() as $val1) {
								?>	
										<tr class="">
											<td width="" rowspan="">
												<select class="form-control" name="areas_development" disabled>
													<option value="">Select</option>													
													<?php if($areas_development && $areas_development->num_rows() > 0) {
														foreach($areas_development->result() as $row) {
																$selected = "";
																if($val1->areas_for_development == $row->appraisal_areas_development_id)
																	$selected = 'selected="selected"';
													?>
															<option value="<?php echo $row->appraisal_areas_development_id ?>" <?php echo $selected ?>><?php echo $row->appraisal_areas_development ?></option>
													<?php 
														}
													}
													?>
												</select>
											</td>
											<td width="" rowspan="">
												<select class="form-control" name="learning_mode" disabled>
													<option value="">Select</option>													
													<?php if($learning_mode && $learning_mode->num_rows() > 0) {
														foreach($learning_mode->result() as $row) {
																$selected = "";
																if($val1->learning_mode == $row->learning_mode_id)
																	$selected = 'selected="selected"';
															?>														
															<option value="<?php echo $row->learning_mode_id ?>" <?php echo $selected ?>><?php echo $row->learning_mode ?></option>
													<?php 
														}
													}
													?>
												</select>
											</td>
											<td width="" rowspan="">
												<select class="form-control" name="competencies" disabled>
													<option value="">Select</option>													
													<?php if($competencies && $competencies->num_rows() > 0) {
														foreach($competencies->result() as $row) {
																$selected = "";
																if($val1->competencies == $row->category_id)
																	$selected = 'selected="selected"';
															?>															
															<option value="<?php echo $row->category_id ?>" <?php echo $selected ?>><?php echo $row->category ?></option>
													<?php 
														}
													}
													?>
												</select>
											</td>
											<td width="" rowspan="">
												<select class="form-control" name="completion" disabled>
													<option value="">Select</option>													
													<?php if($target_completion && $target_completion->num_rows() > 0) {
														foreach($target_completion->result() as $row) {
																$selected = "";
																if($val1->target_completion == $row->target_completion_id)
																	$selected = 'selected="selected"';
															?>															
															<option value="<?php echo $row->target_completion_id ?>" <?php echo $selected ?>><?php echo $row->target_completion ?></option>
													<?php 
														}
													}
													?>
												</select>
											</td>
											<td width="" rowspan="">
												<textarea class="form-control" rows="2" name="remarks" disabled><?php echo $val1->remarks ?></textarea>
											</td>
											<td>
										        <div>
										            <input type="checkbox" class="record-checker check_val" name="" value="<?php echo $val1->areas_for_development ?>|<?php echo $val1->competencies ?>" />
										        </div>											
											</td>
										</tr>
								<?php 
									} 
								?>
							</tbody>
						</table>
        			</div>
   				</div>
			</div>				
			<div class="form-actions fluid">
			    <div class="col-md-12 text-center">
			        <button type="button" class="btn btn-sm green apply_idp">Submit</button>
			      	<a class="btn default btn-sm" data-dismiss="modal">Close</a>
			    </div>
			</div>
		</form>
   	</div>  				
</div>