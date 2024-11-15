$(document).ready(function(e) { 
	$('.filter-company').click(function(){
		$('.filter-company').removeClass('label-success');
		$('.filter-company').addClass('label-default');
		$(this).removeClass('label-default');
		$(this).addClass('label-success')
		create_list();
	});	
});

function create_list()
{
	var search = $('input[name="list-search"]').val();
	var filter_by = {
		company_id: $('.filter-company.label-success').attr('filter_value'),
	}
	var filter_value = $('.list-filter.active').attr('filter_value');

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
