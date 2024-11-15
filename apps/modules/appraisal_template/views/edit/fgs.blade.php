<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Template </div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">			
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Template Title</label>
			<div class="col-md-7">							
				<input type="text" class="form-control" name="performance_template[template]" id="performance_template-template" value="{{ $record['performance_template.template'] }}" placeholder="Enter Template Title" />
			</div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Template Code</label>
			<div class="col-md-7">							
				<input type="text" class="form-control" name="performance_template[template_code]" id="performance_template-template_code" value="{{ $record['performance_template.template_code'] }}" placeholder="Enter Template Code" /> 				
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Company</label>
			<div class="col-md-7">
				<?php
					$db->select('company_id,company');
                    $db->order_by('company', '0');
                    $db->where('deleted', '0');
                    $options = $db->get('users_company'); 	                            
                    $performance_template_company_id_options = array();
                    	foreach($options->result() as $option)
                    	{
							$performance_template_company_id_options[$option->company_id] = $option->company;
                    	} 
                ?>							
                <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
                        {{ form_multiselect('performance_template[company_id][]',$performance_template_company_id_options, explode(',',$record['performance_template.company_id']), 'class="form-control select2me" data-placeholder="Select..." id="performance_template-company_id"') }}
                </div> 				
            </div>	
		</div>
		<div class="form-group hidden">
			<label class="control-label col-md-3"><span class="required">* </span>Position Classification</label>
			<div class="col-md-7">
				<?php
					$db->select('position_classification_id,position_classification');
                    $db->order_by('position_classification', '0');
                    $db->where('deleted', '0');
                    $options = $db->get('users_position_classification'); 	                            
                    $performance_template_position_classification_id_options = array('' => 'Select...');
                    	foreach($options->result() as $option)
                    	{
							$performance_template_position_classification_id_options[$option->position_classification_id] = $option->position_classification;
                    	} 
                ?>							
                <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
                        {{ form_dropdown('performance_template[position_classification_id]',$performance_template_position_classification_id_options, $record['performance_template.position_classification_id'], 'class="form-control select2me" data-placeholder="Select..." id="performance_template-position_classification_id"') }}
                </div> 				
            </div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Level</label>
			<div class="col-md-7">
				<?php
					$db->select('employment_type_id,employment_type');
                    $db->order_by('employment_type', '0');
                    $db->where('deleted', '0');
                    $options = $db->get('partners_employment_type'); 	                            
                    $performance_template_employment_type_id_options = array();
                    	foreach($options->result() as $option)
                    	{
							$performance_template_employment_type_id_options[$option->employment_type_id] = $option->employment_type;
                    	} 
                ?>							
                <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
                        {{ form_multiselect('performance_template[employment_type_id][]',$performance_template_employment_type_id_options, explode(',',$record['performance_template.employment_type_id']), 'class="form-control select2me" data-placeholder="Select..." id="performance_template-employment_type_id"') }}
                </div> 				
            </div>	
		</div>		
		<div class="form-group hidden">
			<label class="control-label col-md-3"><span class="required">* </span>Rank</label>
			<div class="col-md-7">
				<?php
					$db->select('job_grade_id,job_level');
                    $db->order_by('job_level', '0');
                    $db->where('deleted', '0');
                    $options = $db->get('users_job_grade_level'); 	                            
                    $performance_template_job_grade_id_options = array('' => 'Select...');
                    	foreach($options->result() as $option)
                    	{
							$performance_template_job_grade_id_options[$option->job_grade_id] = $option->job_level;
                    	} 
                ?>							
                <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
                        {{ form_dropdown('performance_template[job_grade_id]',$performance_template_job_grade_id_options, $record['performance_template.job_grade_id'], 'class="form-control select2me" data-placeholder="Select..." id="performance_template-job_grade_id"') }}
                </div> 				
            </div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Employment Status</label>
			<div class="col-md-7">
				<?php
					$db->select('employment_status_id,employment_status');
                    $db->order_by('employment_status', '0');
                    $db->where('deleted', '0');
                    $options = $db->get('partners_employment_status'); 	                            
                    $performance_template_employment_status_id_options = array();
                    	foreach($options->result() as $option)
                    	{
							$performance_template_employment_status_id_options[$option->employment_status_id] = $option->employment_status;
                    	} 
                ?>							
                <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
                        {{ form_multiselect('performance_template[employment_status_id][]',$performance_template_employment_status_id_options, explode(',', $record['performance_template.employment_status_id']), 'class="form-control select2me" data-placeholder="Select..." id="performance_template-employment_status_id"') }}
                </div> 				
            </div>	
		</div>				
		<div class="form-group hidden">
			<label class="control-label col-md-3"><span class="required">* </span>Applicable for</label>
			<div class="col-md-7">
				<?php
					$db->select('applicable_to_id,applicable_to');
                    $db->order_by('applicable_to', '0');
                    $db->where('deleted', '0');
                    $options = $db->get('performance_template_applicable'); 	                            
                    $performance_template_applicable_to_id_options = array('' => 'Select...');
                    	foreach($options->result() as $option)
                    	{
							$performance_template_applicable_to_id_options[$option->applicable_to_id] = $option->applicable_to;
                    	} 
                ?>							
                <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
                        {{ form_dropdown('performance_template[applicable_to_id]',$performance_template_applicable_to_id_options, $record['performance_template.applicable_to_id'], 'class="form-control select2me" data-placeholder="Select..." id="performance_template-applicable_to_id"') }}
                </div> 				
            </div>	
		</div>			
		<div class="form-group hidden">
			<label class="control-label col-md-3"><span class="required">* </span>Applicable to</label>
			<div class="col-md-7">
				<?php
					$performance_template_applicable_to_options = array();
					if( !empty( $record_id ) )
					{
						$performance_template_applicable_to_options = $mod->_get_applicable_options($record['performance_template.applicable_to_id'], $record['performance_template.applicable_to']);
					}
				?>							
				<div class="input-group">
					<span class="input-group-addon">
                    <i class="fa fa-list-ul"></i>
                    </span>{{ form_dropdown('performance_template[applicable_to][]',$performance_template_applicable_to_options, explode(',', $record['performance_template.applicable_to']), 'class="form-control select2me" multiple="multiple" multiple="multiple" id="performance_template-applicable_to"') }}
                </div>
            </div>	
		</div>						
		<div class="form-group">
			<label class="control-label col-md-3">Description</label>
			<div class="col-md-7">
				<textarea class="form-control" name="performance_template[description]" id="performance_template-description" placeholder="Enter Description" rows="4">{{ $record['performance_template.description'] }}</textarea> 				
			</div>	
		</div>	
	</div>
</div>
<div class="portlet hideme" style="display:none">
	<div class="portlet-title">
		<div class="caption">Section</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">
		<div class="form-body">
			<div class="form-group">
				<p class="margin-bottom-25">Manage to add sections and configure each settings and relationship.</p>
				<div class="portlet">
					<span class="input-group-btn text-right">
						<button type="button" class="btn btn-success" onclick="section_form('')"><i class="fa fa-plus"></i> Add Section</button>
					</span>
				</div>
			</div>
			<br/>
			<div class="portlet margin-top-25">
				<div class="portlet-body" id="saved-sections"></div>
			</div>
		</div>
	</div>
</div>