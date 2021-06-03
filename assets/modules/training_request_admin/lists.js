$(document).ready(function(){	
	$('.filter-status').click(function(){
		$('.filter-status').removeClass('label-success');
		$('.filter-status').addClass('label-default');
		$(this).removeClass('label-default');
		$(this).addClass('label-success')
		create_list();
	});
});


function create_list()
{
	var search = $('input[name="list-search"]').val();
	
	var filter_by = {
		status_id: $('.filter-status.label-success').attr('filter_value'),
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

function print_request (record_id)
{
    var data = {
        record_id:record_id,
        }
    $.blockUI({ message: '<div>Loading, please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />', 
        onBlock: function(){
            $.ajax({
                url: base_url + module.get('route') + '/print_request',
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