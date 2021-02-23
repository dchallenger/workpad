<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Scorecard</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">
		<div class="form-group hidden">
			<label class="control-label col-md-3">Template Section<span class="required">* </span></label>
			<div class="col-md-7">
				<?php	                        
				$ci=& MY_Controller::$instance; 

				$section_options = array();

				$ci->db->where('deleted',0);
				$ci->db->where('parent_id >',0);
				$result = $ci->db->get('performance_template_section');

				if ($result && $result->num_rows() > 0) {
					foreach($result->result_array() as $index => $value){				
						$section_options[$value['template_section_id']] = $value['template_section'];
					}
				}
				?>		

				<div class="input-group">
					<!-- <input type="hidden" size="16" class="form-control" readonly id="loan_application_mobile_enrollment_type_id" name="loan_application_mobile_enrollment_type_id" value="">  -->
					<span class="input-group-addon">
						<i class="fa fa-list-ul"></i>
					</span>
					{{ form_dropdown('performance_setup_scorecard[template_section_id]',$section_options, $record['performance_setup_scorecard.template_section_id'],'id="template_section_id" class="form-control select2me" data-placeholder="Select..."') }}
				</div> 				
			</div>	
		</div>		
		<div class="form-group">
			<label class="control-label col-md-3">Scorecard<span class="required">* </span></label>
			<div class="col-md-7">							
				<input type="text" class="form-control" name="performance_setup_scorecard[scorecard]" id="performance_setup_scorecard-scorecard" value="{{ $record['performance_setup_scorecard_scorecard'] }}" placeholder="Enter Scorecard" readonly/>
			</div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3">Description</label>
			<div class="col-md-7">							
				<input type="text" class="form-control" name="performance_setup_scorecard[description]" id="performance_setup_scorecard-description" value="{{ $record['performance_setup_scorecard_description'] }}" placeholder="Enter Description" readonly/> 				
			</div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3">Is Active</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="performance_setup_scorecard[scorecard]" id="performance_setup_scorecard-scorecard" value="{{ $record['performance_setup_scorecard_status_id'] }}" placeholder="Enter Scorecard" readonly/>			
			</div>	
		</div>	
	</div>
</div>