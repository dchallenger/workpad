<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Financial Metric Info</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">
		<div class="form-group hidden">
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
                    {{ form_dropdown('performance_financial_metric_planning[planning_id]',$performance_financial_metric_planning_planning_id_options, $record['performance_financial_metric_planning_planning_id'], 'class="form-control select2me" data-placeholder="Select..." id="performance_financial_metric_planning-planning_id" disabled') }}
                </div> 				
            </div>	
		</div>
		<div class="form-group hidden">
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
                    {{ form_dropdown('performance_financial_metric_planning[user_ids][]',$performance_financial_metric_planning_user_ids_options, explode(',', $record['performance_financial_metric_planning_user_ids']), 'class="form-control" data-placeholder="Select..." multiple="multiple" id="performance_financial_metric_planning-user_ids" disabled') }}
              	</div>
            </div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Financial Metrics Title</label>
			<div class="col-md-7">
				<input readonly type="text" class="form-control" name="performance_financial_metric_planning[title]" id="performance_financial_metric_planning-title" value="{{ $record['performance_financial_metric_sbu_unit'] }}" />
			</div>	
		</div>			
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Financial Metric KPI</label>
			<div class="col-md-7">
                <input readonly type="text" class="form-control" name="performance_financial_metric_planning[title]" id="performance_financial_metric_planning-title" value="" />
            </div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Key in Weight</label>
			<div class="col-md-7">
				<input readonly type="text" class="form-control" name="performance_financial_metric_planning[key_in_weight]" id="performance_financial_metric_planning-key_in_weight" value="{{ $record['performance_financial_metric_planning_key_in_weight'] }}" placeholder="Enter Key in Weight" />
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Remarks</label>
			<div class="col-md-7">
				<textarea class="form-control" name="performance_financial_metric_planning[remarks]" readonly>{{ $record['performance_financial_metric_planning_remarks'] }}</textarea>
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
			<?php 
				$total_weight = 0;
				$total_weighted_rating = 0;
			?>
			@foreach($financial_metric_planning_details->result() as $row)
				<?php
					$total_weight += $row->weight;
					$total_weighted_rating += remove_comma($row->weighted_rating);
				?>
				<div class="row">
					<div class="col-md-3">
						<div class="">
							<label class="control-label"><span class="required">* </span>Key Performance Indicators / Measures</label>
							<input type="text" class="form-control" name="" id="performance_financial_metric_planning-key_in_weight" value="{{$row->financial_metric_kpi}}" readonly/>
						</div>						
					</div>
					<div class="col-md-1">			
						<div class="">
							<label class="control-label"><span class="required">* </span>% Weight</label>
							<input type="text" class="form-control" name="performance_financial_metric_planning[weight][]" id="performance_financial_metric_planning-key_in_weight" value="{{ $row->weight }}" placeholder="Enter Weight" readonly/>
						</div>						
					</div>
					<div class="col-md-1">			
						<div class="">
							<label class="control-label"><span class="required">* </span>Target </label>
							<input type="text" class="form-control" name="performance_financial_metric_planning[target][]" id="performance_financial_metric_planning-key_in_weight" value="{{ $row->value }}" placeholder="Enter Target" readonly/>
						</div>						
					</div>
					<div class="col-md-2">
                        <div class="">
                            <label class="control-label">Rating Comp<span class="required">*</span></label>
                            <select name="performance_financial_metric_planning[rating_comp][]" class="form-control select2me rating_comp" data-placeholder="Select..." disabled>
                                <option value="1" <?php echo $row->rating_comp == 1 ? "selected" : ""; ?>>Actual/Target</option>
                                <option value="2" <?php echo $row->rating_comp == 2 ? "selected" : ""; ?>>Target/Actual</option>
                            </select>
                        </div>
					</div>
					<div class="col-md-1">			
						<div class="">
							<label class="control-label"><span class="required">* </span>Actual </label>
							<input type="text" class="form-control actual" name="performance_financial_metric_planning[actual][]" value="{{ $row->actual }}" placeholder="Enter Actual" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false" readonly/>
						</div>						
					</div>
					<div class="col-md-1">			
						<div class="">
							<label class="control-label">Rating </label>
							<input type="text" readonly class="form-control fm_rating" name="performance_financial_metric_planning[rating][]" value="{{ $row->rating }}" placeholder="Enter Rating" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false" readonly/>
						</div>						
					</div>
					<div class="col-md-2">			
						<div class="">
							<label class="control-label">Weighted Rating </label>
							<input type="text" readonly class="form-control weighted_rating" name="performance_financial_metric_planning[weighted_rating][]" value="{{ $row->weighted_rating }}" placeholder="Enter Weighted Rating" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false" readonly/>
						</div>						
					</div>
				</div>
			@endforeach
			<br />
			<div class="row">
				<div class="col-md-3 bold">TOTAL</div>
				<div class="col-md-1">
					<div class="">
						<input type="text" readonly class="form-control weight" name="performance_financial_metric_planning[weight][]" value="{{ $total_weight }}" placeholder="Enter Weight" data-inputmask="'mask': '9', 'repeat': 3, 'greedy' : false"/>
					</div>
				</div>
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-2">&nbsp</div>
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-2">			
					<div class="">
						<input type="text" readonly class="form-control weighted_rating" name="performance_financial_metric_planning[weighted_rating][]" value="{{ number_format(floatval($total_weighted_rating), 4) }}" placeholder="Enter Weighted Rating" data-inputmask="'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false"/>
					</div>						
				</div>
			</div>
		@endif
	</div>
</div>