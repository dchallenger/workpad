$(document).ready(function()
{
	init_load();

	$('#reload_api').click(function() {
		$.ajax({
		  	url: "https://prod-16.southeastasia.logic.azure.com:443/workflows/8b36a42112dd4eeab5306a62ca79f446/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=F_ybkzDd1txYZ__HtE8xsriAZBskJrCn5zKkAtvJqGk&app-id=0d87e33e-1150-ed11-bba3-000d3a85690c&key=b1998835-4d15-43ec-836a-c6f17841cc85",
		  	type: "get", //send it through get method
		  	dataType: 'json',
		    beforeSend: function () {
		        $.blockUI({
		        	message: '<img src="'+ root_url +'assets/img/ajax-modal-loading.gif"><br />Loading data, please wait...',
		        	css: {
						background: 'none',
						border: 'none',		
				    	'z-index':'99999'		    	
					},
					baseZ: 20000,
		        });
		    },
			success: function(response) {
				$.unblockUI();
				var arr_allocation = [];
				$.each(response, function (key, value) {
					arr_allocation.push({
						sbu : value['crba2_sbuallocation@OData.Community.Display.V1.FormattedValue'],
						allocation : value.crba2_allocation,
						employee_number : (typeof value.crba2_Manpower !== 'undefined' ? value.crba2_Manpower.crba2_employeenumber : '')
					});
			    });

				var json_allocation = JSON.stringify(arr_allocation);

				$.blockUI({ message: saving_message(),
					onBlock: function(){
						$.ajax({
							url: base_url + module.get('route') + '/save',
							type:"POST",
							data: {allocation : json_allocation},
							dataType: "json",
							async: false,
							beforeSend: function () {
								
							},
							success: function ( response ) {
								get_list();
								$('#date_processed').html(response.date_processed);
								handle_ajax_message( response.message );
							}
						});
					},
					baseZ: 300000000
				});
				$.unblockUI();
			},
			error: function(xhr) {
				notify('error', xhr);
			}
		});
	});
});

function get_list(){
	var filter_value = $(this).data('filter_value');

	$('#record-list').empty();
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
		search: $('input[name="list-search"]').val(),
        filter_value: filter_value 
	});
}

function init_load() {
	$.ajax({
		url: base_url + module.get('route') + '/get_date_processed',
		type:"POST",
		dataType: "json",
		async: false,
		beforeSend: function () {
			
		},
		success: function ( response ) {
			$('#date_processed').html(response.date_processed);
		}
	});
}