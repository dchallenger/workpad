<div class="portlet">
	<div class="portlet-title">
		<div class="caption">Financial Metrics KPI</div>
		<div class="tools"><a class="collapse" href="javascript:;"></a></div>
	</div>
	<div class="portlet-body form">
		<div class="form-group">
			<label class="control-label col-md-3"><span class="required">* </span>Key Performance Indicators</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="performance_setup_financial_metrics_kpi[financial_metrics_kpi]" id="performance_setup_financial_metrics_kpi-financial_metrics_kpi" value="{{ $record['performance_setup_financial_metrics_kpi_financial_metrics_kpi'] }}" placeholder="Enter Key Performance Indicators" readonly/>
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">
				Is Active
			</label>
			<div class="col-md-7">
				<input type="text" class="form-control" name="performance_setup_financial_metrics_kpi[financial_metrics_kpi]" id="performance_setup_financial_metrics_kpi-financial_metrics_kpi" value="{{ $record['performance_setup_financial_metrics_kpi_status_id'] }}" placeholder="Enter Key Performance Indicators" readonly />
			</div>
		</div>		
	</div>
</div>