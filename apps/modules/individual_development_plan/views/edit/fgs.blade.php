<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Employee Details</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
		<div class="portlet-body form">			
			<div class="form-group">
				<label class="control-label col-md-3">Employee</label>
				<div class="col-md-7">
					<?php 
						$db->select('user_id,full_name');
		                $db->order_by('full_name', '0');
		                $db->where('deleted', '0');
		                $options = $db->get('users'); 	                            
		                $performance_appraisal_idp_user_id_options = array('' => '');
	                    foreach($options->result() as $option) {
							$performance_appraisal_idp_user_id_options[$option->user_id] = $option->full_name;
	                    } 
                    ?>							
                    <div class="input-group">
						<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
	                    {{ form_dropdown('performance_appraisal_idp[user_id]',$performance_appraisal_idp_user_id_options, $record['performance_appraisal_idp.user_id'], 'class="form-control select2me" data-placeholder="Select..." id="performance_appraisal_idp-user_id"') }}
	                </div> 				
                </div>	
			</div>			
		</div>
</div>
<div class="portlet">
	<div class="portlet-title">
		<div class="caption">
			Individual Development Plan
			<a id="add_idp" href="javascript:void(0)" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
		</div>	
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title">
					The performance development plan discussion provides an opportunity to identify the employee's development needs. In areas where improvement or growth can be made, the team member and coach need to make specific plans and commitments.
				</h3>
			</div>
			<div class="table-scrollable">
				<table class="table">
					<thead>
						<tr>
							<th class="bold" width="13%">Areas for Development</th>
							<th class="bold" width="13%">Learning Mode</th>
							<th class="bold" width="15%">Competencies</th>
							<th class="bold" width="15%">Development Category</th>
							<th class="bold" width="15%">Topic</th>
							<th class="bold" width="9%">Target Completion</th>
							<th class="bold" width="15%">Remarks</th>
							<th width="5%"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div class="no-padding col-md-12">
									<select name="" class="form-control select2me">
										<option value=""></option>
										@if($areas_development && $areas_development->num_rows() > 0)
											@foreach($areas_development->result() as $row)
												<option value="{{$row->appraisal_areas_development_id}}">{{$row->appraisal_areas_development}}</option>
											@endforeach
										@endif
									</select>
								</div>
							</td>
							<td>
								<div class="no-padding col-md-12">
									<select name="" class="form-control select2me">
										<option value=""></option>
										@if($learning_mode && $learning_mode->num_rows() > 0)
											@foreach($learning_mode->result() as $row)
												<option value="{{$row->learning_mode_id}}">{{$row->learning_mode}}</option>
											@endforeach
										@endif
									</select>
								</div>
							</td>
							<td>
								<div class="no-padding col-md-12">
									<select name="" class="form-control select2me">
										<option value=""></option>
										@if($competencies && $competencies->num_rows() > 0)
											@foreach($competencies->result() as $row)
												<option value="{{$row->category_id}}">{{$row->category}}</option>
											@endforeach
										@endif
									</select>
								</div>
							</td>
							<td>
								<div class="no-padding col-md-12">
									<select name="" class="form-control select2me">
										<option value=""></option>
										@if($development_category && $development_category->num_rows() > 0)
											@foreach($development_category->result() as $row)
												<option value="{{$row->appraisal_development_category_id}}">{{$row->appraisal_development_category}}</option>
											@endforeach
										@endif
									</select>
								</div>
							</td>
							<td>
								<input type="text" class="form-control" name="" id="" value=""/>
							</td>
							<td>
								<div class="no-padding col-md-12">
									<select name="" class="form-control select2me">
										<option value=""></option>
										@if($target_completion && $target_completion->num_rows() > 0)
											@foreach($target_completion->result() as $row)
												<option value="{{$row->target_completion_id}}">{{$row->target_completion}}</option>
											@endforeach
										@endif
									</select>
								</div>
							</td>
							<td>
								<textarea class="form-control" rows="4" name=""></textarea>
							</td>
							<td>
								&nbsp;
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>		
	</div>
</div>
<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Development Budget for the Year (HRA Use Only)</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">			
		<div class="form-group">
			<label class="control-label col-md-3">Individual Training Budget</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="performance_appraisal_idp[itb]" id="performance_appraisal_idp-itb" value="{{ $record['performance_appraisal_idp.itb'] }}" placeholder="Enter Individual Training Budget" readonly/>
			</div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3">Common Training Budget</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="performance_appraisal_idp[ctb]" id="performance_appraisal_idp-ctb" value="{{ $record['performance_appraisal_idp.ctb'] }}" placeholder="Enter Common Training Budget" readonly/>
			</div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3">Supplemental Training Budget</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="performance_appraisal_idp[stb]" id="performance_appraisal_idp-stb" value="{{ $record['performance_appraisal_idp.stb'] }}" placeholder="Enter Supplemental Training Budget" />
			</div>	
		</div>	
		<div class="form-group">
			<label class="control-label col-md-3">Total Development Budget for the Year</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="performance_appraisal_idp[total_budget]" id="performance_appraisal_idp-total_budget" value="{{ $record['performance_appraisal_idp.total_budget'] }}" placeholder="Enter Total Development Budget for the Year" />
			</div>	
		</div>				
	</div>
</div>
<div class="portlet">
	<div class="portlet-title">
		<div class="caption">IDP Commitment for the Year (HRA Use Only)</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">
		<div class="form-group">
			<label class="control-label col-md-3">% of IDP Completed vs. Planned</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="performance_appraisal_idp[idp_completed_planned]" id="performance_appraisal_idp-idp_completed_planned" value="{{ $record['performance_appraisal_idp.idp_completed_planned'] }}" placeholder="Enter % of IDP Completed vs. Planned" />
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">% of individual Development Initiatives Commited for the Year</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="performance_appraisal_idp[idp_committed]" id="performance_appraisal_idp-idp_committed" value="{{ $record['performance_appraisal_idp.idp_committed'] }}" placeholder="Enter % of individual Development Initiatives Commited for the Year" />
			</div>	
		</div>
	</div>
</div>