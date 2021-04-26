<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Financial Metrics KPI</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Key Performance Indicators</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="performance_setup_financial_metrics_kpi[financial_metrics_kpi]" id="performance_setup_financial_metrics_kpi-financial_metrics_kpi" value="{{ $record['performance_setup_financial_metrics_kpi.financial_metrics_kpi'] }}" placeholder="Enter Key Performance Indicators" />
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">
				Is Active
			</label>
			<div class="col-md-7">
				<div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
					<input type="checkbox" value="1" @if( $record['performance_setup_financial_metrics_kpi.status_id'] || empty($record_id) ) checked="checked" @endif name="performance_setup_financial_metrics_kpi[status_id][temp]" id="performance_setup_financial_metrics_kpi-status_id-temp" class="dontserializeme toggle"/>
					<input type="hidden" name="performance_setup_financial_metrics_kpi[status_id]" id="performance_setup_financial_metrics_kpi-status_id" value="@if( $record['performance_setup_financial_metrics_kpi.status_id'] || empty($record_id) ) 1 @else 0 @endif"/>
				</div>
			</div>
		</div>		
	</div>
</div>