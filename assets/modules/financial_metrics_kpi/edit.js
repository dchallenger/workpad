$(document).ready(function(){
	$('#performance_setup_financial_metrics_kpi-status_id-temp').change(function(){
		if( $(this).is(':checked') )
			$('#performance_setup_financial_metrics_kpi-status_id').val('1');
		else
			$('#performance_setup_financial_metrics_kpi-status_id').val('0');
	});
});