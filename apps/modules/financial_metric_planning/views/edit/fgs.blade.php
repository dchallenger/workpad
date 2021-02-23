<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Financial Metric Info</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Performance Planning</label>
			<div class="col-md-7">
				<?php
					$db->select('planning_id,notes');
                    $db->order_by('notes', '0');
                    $db->where('deleted', '0');
                    $options = $db->get('performance_planning');
                    $performance_financial_metric_planning_planning_id_options = array('' => 'Select...');
                    foreach($options->result() as $option) {
                    	$performance_financial_metric_planning_planning_id_options[$option->planning_id] = $option->notes;
                	} 
                ?>
                <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
                    {{ form_dropdown('performance_financial_metric_planning[planning_id]',$performance_financial_metric_planning_planning_id_options, $record['performance_financial_metric_planning.planning_id'], 'class="form-control select2me" data-placeholder="Select..." id="performance_financial_metric_planning-planning_id"') }}
                </div> 				
            </div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Employees</label>
			<div class="col-md-7">
				<?php
					$db->select('user_id,full_name');
                    $db->where('deleted', '0');
                    $db->where('user_id >', 1);
                    $db->order_by('full_name');
                    $options = $db->get('users');
					$performance_financial_metric_planning_user_ids_options = array();
                    foreach($options->result() as $option) {
                        $performance_financial_metric_planning_user_ids_options[$option->user_id] = $option->full_name;
                	} 
                ?>
                <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
                    {{ form_dropdown('performance_financial_metric_planning[user_ids][]',$performance_financial_metric_planning_user_ids_options, explode(',', $record['performance_financial_metric_planning.user_ids']), 'class="form-control" data-placeholder="Select..." multiple="multiple" id="performance_financial_metric_planning-user_ids"') }}
              	</div>
            </div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Financial Metric KPI</label>
			<div class="col-md-7">
				<?php
					$db->select('financial_metrics_kpi_id,financial_metrics_kpi');
                    $db->where('deleted', '0');
                    $options = $db->get('performance_setup_financial_metrics_kpi');
					$performance_financial_metric_planning_financial_metric_kpi_ids_options = array();
                    foreach($options->result() as $option) {
                        $performance_financial_metric_planning_financial_metric_kpi_ids_options[$option->financial_metrics_kpi_id] = $option->financial_metrics_kpi;
                    } 
                ?>
                <div class="input-group">
					<span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
                    {{ form_dropdown('performance_financial_metric_planning[financial_metric_kpi_ids][]',$performance_financial_metric_planning_financial_metric_kpi_ids_options, explode(',', $record['performance_financial_metric_planning.financial_metric_kpi_ids']), 'class="form-control" data-placeholder="Select..." multiple="multiple" id="performance_financial_metric_planning-financial_metric_kpi_ids"') }}
                </div>
            </div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Key in Weight</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="performance_financial_metric_planning[key_in_weight]" id="performance_financial_metric_planning-key_in_weight" value="{{ $record['performance_financial_metric_planning.key_in_weight'] }}" placeholder="Enter Key in Weight" />
			</div>	
		</div>	
	</div>
</div>
<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Financial Metric Details</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form" id="kpi_container">
		@if($financial_metric_planning_details && $financial_metric_planning_details->num_rows() > 0)
			@foreach($financial_metric_planning_details->result() as $row)
				<div class="row" data-kpi="{{$row->financial_metrics_kpi}}">
					<input type="hidden" class="form-control" name="performance_financial_metric_planning[financial_metric_planning_details_id][]" value="{{$row->financial_metric_planning_details_id}}"/>
					<div class="col-md-4">
						<div class="">
							<label class="control-label"><span class="required">* </span>Key Performance Indicators / Measures</label>
							<input type="text" class="form-control" name="" id="performance_financial_metric_planning-key_in_weight" value="{{$row->financial_metrics_kpi}}" readonly/>
							<input type="hidden" class="form-control" name="performance_financial_metric_planning[kpi][]" id="performance_financial_metric_planning-key_in_weight" value="{{ $row->financial_metric_kpi_id}}" readonly/>
						</div>						
					</div>
					<div class="col-md-4">			
						<div class="">
							<label class="control-label"><span class="required">* </span>% Weight</label>
							<input type="text" class="form-control" name="performance_financial_metric_planning[weight][]" id="performance_financial_metric_planning-key_in_weight" value="{{ $row->weight }}" placeholder="Enter Weight" />
						</div>						
					</div>
					<div class="col-md-4">			
						<div class="">
							<label class="control-label"><span class="required">* </span>Target </label>
							<input type="text" class="form-control" name="performance_financial_metric_planning[target][]" id="performance_financial_metric_planning-key_in_weight" value="{{ $row->value }}" placeholder="Enter Target" />
						</div>						
					</div>
				</div>
			@endforeach
		@endif
	</div>
</div>