$(document).ready(function() {
	if (jQuery().datepicker) {
		$('.date-picker').datepicker({
			rtl: App.isRTL(),
			autoclose: true
		});
	}

	$('#date_from,#date_to').on("changeDate", function() {
		var date_from = $('#date_from').val();
		var date_to = $('#date_to').val();

		if (date_from != '' && date_to != '')
			get_list(date_from,date_to);
	});
});

function get_list(date_from,date_to)
{
	var search = $('input[name="list-search"]').val();
	var filter_by = 'date_time';
	var filter_value = date_from+'-'+date_to;
	
	$('#record-list').empty().die().infiniteScroll({
		dataPath: base_url + module.get('route') + '/get_list',
		itemSelector: 'tr.record',
		onDataLoading: function(){ 
			$("#loader").show();
			$("#no_record").hide();
		},
		onDataLoaded: function(page, records){ 
			$("#loader").hide();
			if( page == 0 && records == 0)
			{
				$("#no_record").show();
			}
		},
		onDataError: function(){ 
			return;
		},
		search: search,
		filter_by: filter_by,
		filter_value: filter_value
	});
}