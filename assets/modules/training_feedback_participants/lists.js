function create_list()
{
	var search = $('input[name="list-search"]').val();
	var filter_by = $('.list-filter.active').attr('filter_by');
	var filter_value = $('.list-filter.active').attr('filter_value');
	var calendar_id = $('input[name="calendar_id"]').val();
	
	$('#record-list').empty().die().infiniteScroll({
		dataPath: base_url + module.get('route') + '/get_list/'+calendar_id,
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

function print_evaluation (record_id)
{
    var data = {
        record_id:record_id,
        }
    $.blockUI({ message: '<div>Loading, please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />', 
        onBlock: function(){
            $.ajax({
                url: base_url + module.get('route') + '/print_evaluation',
                type:"POST",
                async: false,
                data: data,
                dataType: "json",
                success: function ( response ) {
                    if( response.filename != undefined )
                    {
                        window.open( root_url + response.filename );
                    }
                    $.unblockUI();
                    handle_ajax_message( response.message );
                }
            });
        },
        baseZ: 999999999
    });
}
