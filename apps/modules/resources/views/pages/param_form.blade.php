<div class="portlet">
		<div class="portlet-body form">
			<form class="form-horizontal">
				<div class="portlet">
					<div class="portlet-body form">
						<input type="hidden" name="coe_description" id="coe_description">
						<input type="hidden" name="display_name" id="display_name">
    					<div class="form-body">
    						<h3>Certificate</h3>
    						<table class="table">
								<tbody>
									<tr>
										<td>Type of Certificate <span style="color:red">* </span></td>
										<td>
											<select name="coe" class="form-control select2me coe" data-placeholder="Select...">
												<option value=""></option>
												<option value="coe_w_compensation">COE with Compensation</option>
												<option value="coe_wo_compensation">COE without Compensation</option>
												<option value="cfr">COE for Resigned</option>
												<option value="cov">Certificate of Vehicle Assignment</option>
												<option value="cmb">Certificate of Maternity Benefit</option>
												<option value="cea">Certificate with Employee Address</option>
												<!-- <option value="coe_tenure">COE Tenure</option> -->
											</select>								
										</td>
									</tr>
									<tr>
										<td>Employee <span style="color:red">* </span></td>
										<td>
											<select name="user_id" class="form-control select2me user" data-placeholder="Select...">
												<option value=""></option>
												<?php
													if ($list_employee && $list_employee->num_rows() > 0){
														foreach ($list_employee->result() as $row) {
												?>
															<option value="<?php echo $row->user_id ?>"><?php echo $row->full_name ?></option>
												<?php
														}
													}
												?>
											</select>	
											<select name="user_id" class="form-control select2me user" data-placeholder="Select..." style="display:none" disabled >
												<option value=""></option>
												<?php
													if ($list_employee_resigned && $list_employee_resigned->num_rows() > 0){
														foreach ($list_employee_resigned->result() as $row) {
												?>
															<option value="<?php echo $row->user_id ?>"><?php echo $row->full_name ?></option>
												<?php
														}
													}
												?>
											</select>																			
										</td>
									</tr>
									<tr>
										<td>Purpose</td>
										<td>
											<textarea class="form-control" name="purpose" id="purpose" placeholder="Enter Purpose" rows="4"></textarea>																		
										</td>
									</tr>
									<tr class="cov_dependencies" style="display:none">
										<td>Unit</td>
										<td>
											<input class="form-control" name="unit" id="unit" placeholder="Enter Unit" value="">
										</td>
									</tr>
									<tr  class="cov_dependencies" style="display:none">
										<td>Sticker No.</td>
										<td>
											<input class="form-control" name="sticker_no" id="sticker_no" placeholder="Enter Sticker No.">
										</td>
									</tr>
									<tr class="cfr_dependencies" style="display:none">
										<td>Reason for Leaving</td>
										<td>
											<textarea class="form-control" name="reason_for_leaving" id="reason_for_leaving" placeholder="Enter Reason for Leaving" rows="4"></textarea>																		
										</td>
									</tr>																		
		                		</tbody>
							</table>
        				</div>
   					</div>
				</div>				
				<div class="form-actions fluid">
				    <div class="col-md-12 text-center">
				        <button type="button" class="btn btn-sm btn-primary" onclick="ajax_export_custom( $(this).closest('form'))">PDF</button>
				      	<a class="btn default btn-sm" data-dismiss="modal">Close</a>
				    </div>
				</div>
			</form>
       	</div>  		
	</div>

<script>
	$(document).ready(function(){
		$('.select2me').select2({
		    placeholder: "Select an option",
		    allowClear: true
		});
	});
</script>	