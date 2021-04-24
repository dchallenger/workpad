<div class="portlet">

	<div class="portlet-title">
		<div class="caption">Employee Details</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>

	<div class="portlet-body form">	
			
		<div class="form-group">
			<label class="control-label col-md-3">Employee</label>
			<div class="col-md-7">							
				<input type="text" class="form-control" name="employee" id="employee" disabled="disabled" value="{{ $record['employee'] }}" placeholder="" /> 				
			</div>	
		</div>

		<div class="form-group">
			<label class="control-label col-md-3">Position</label>
			<div class="col-md-7">							
				<input type="text" class="form-control" name="position" id="position" disabled="disabled" value="{{ $record['position'] }}" placeholder="" /> 				
			</div>	
		</div>

		<div class="form-group">
			<label class="control-label col-md-3">Division</label>
			<div class="col-md-7">							
				<input type="text" class="form-control" name="division" id="division" disabled="disabled" value="{{ $record['division'] }}" placeholder="" /> 				
			</div>	
		</div>

		<div class="form-group">
			<label class="control-label col-md-3">Department</label>
			<div class="col-md-7">							
				<input type="text" class="form-control" name="department" id="department" disabled="disabled" value="{{ $record['department'] }}" placeholder="" /> 				
			</div>	
		</div>

		<div class="form-group">
			<label class="control-label col-md-3">Rank</label>
			<div class="col-md-7">							
				<input type="text" class="form-control" name="rank" id="rank" disabled="disabled" value="{{ $record['rank'] }}" placeholder="" /> 				
			</div>	
		</div>

		<div class="form-group">
			<label class="control-label col-md-3">Employment Status</label>
			<div class="col-md-7">							
				<input type="text" class="form-control" name="employment_status" id="employment_status" disabled="disabled" value="{{ $record['employment_status'] }}" placeholder="" /> 				
			</div>	
		</div>
		<div class="form-group hidden">
			<label class="control-label col-md-3">Daily Training Cost</label>
			<div class="col-md-7">							
				<input type="text" class="form-control" name="daily_training_cost" id="daily_training_cost" disabled="disabled" value="{{ $record['cost_per_pax'] }}" placeholder="" /> 				
			</div>	
		</div>
	</div>
	
</div>

<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Training Details</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<?php if(!empty($employee_training_result)) { ?>		
		<div class="portlet-body form">	
			<div class="form-group">
				<label class="control-label col-md-3">Training Course</label>
				<div class="col-md-7">							
					<input type="text" class="form-control" name="course" id="course" disabled="disabled" value="{{ $employee_training_result['training_course'] }}" placeholder="" /> 				
				</div>	
			</div>

			<div class="form-group">
				<label class="control-label col-md-3">Training Provider</label>
				<div class="col-md-7">							
					<input type="text" class="form-control" name="provider" id="provider" disabled="disabled" value="{{ $employee_training_result['provider'] }}" placeholder="" /> 				
				</div>	
			</div>

			<div class="form-group">
				<label class="control-label col-md-3">Venue</label>
				<div class="col-md-7">							
					<input type="text" class="form-control" name="venue" id="venue" disabled="disabled" value="{{ $employee_training_result['venue'] }}" placeholder="" /> 				
				</div>	
			</div>

			<div class="form-group">
				<label class="control-label col-md-3">Start Date</label>
				<div class="col-md-7">							
					<input type="text" class="form-control" name="start_date" id="start_date" disabled="disabled" value="{{ general_date($employee_training_result['start_date']) }}" placeholder="" /> 				
				</div>	
			</div>

			<div class="form-group">
				<label class="control-label col-md-3">End Date</label>
				<div class="col-md-7">							
					<input type="text" class="form-control" name="end_date" id="end_date" disabled="disabled" value="{{ general_date($employee_training_result['end_date']) }}" placeholder="" /> 				
				</div>	
			</div>

			<div class="form-group">
				<label class="control-label col-md-3">Training Cost</label>
				<div class="col-md-7">							
					<input type="text" class="form-control" name="cost_per_pax" id="cost_per_pax" disabled="disabled" value="{{ $employee_training_result['cost_per_pax'] }}" placeholder="" /> 				
				</div>	
			</div>
		</div>
	<?php } ?>		
</div>

<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Service Bond Details</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<?php if(!empty($employee_training_result)) { ?>		
		<div class="portlet-body form">	
			<div class="form-group">
				<label class="control-label col-md-3">With Bond</label>
				<div class="col-md-7">							
					<input type="text" class="form-control" name="end_date" id="end_date" disabled="disabled" value="{{ ($employee_training_result['with_bond'] == 1 ? 'Yes' : 'No') }}" placeholder="" /> 				
				</div>	
			</div>

			<div class="form-group">
				<label class="control-label col-md-3">Cost</label>
				<div class="col-md-7">							
					<input type="text" class="form-control" name="cost_per_pax" id="cost_per_pax" disabled="disabled" value="{{ $employee_training_result['cost'] }}" placeholder="" /> 				
				</div>	
			</div>
			
			<div class="form-group">
				<label class="control-label col-md-3">Length of Service</label>
				<div class="col-md-7">							
					<input type="text" class="form-control" name="bond_status" id="bond_status" disabled="disabled" value="{{ $employee_training_result['length_of_service'] }}" placeholder="" /> 				
				</div>	
			</div>
		</div>
	<?php } ?>		
</div>