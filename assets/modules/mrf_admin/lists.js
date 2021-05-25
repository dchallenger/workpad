function ajax_export( record_id )
{
	$.blockUI({ message: '<div>'+lang.common.processing_message+'</div><img src="'+root_url+'assets/img/ajax-loading.gif" />', 
		onBlock: function(){
			$.ajax({
				// {{ get_mod_route('report_generator') }}
				url: base_url + module.get('route') +'/export_pdf_mrf',
				type:"POST",
				dataType: "json",
				data:'record_id='+record_id,
				async: false,
				success: function ( response ) {
					if( response.filename != undefined )
					{
						window.open( root_url + response.filename );
					}
					handle_ajax_message( response.message );
				}
			});
		},
		baseZ: 300000000
	});
	$.unblockUI();	
}

function change_status( record_id, status_id )
{
	bootbox.confirm("Are you sure you want to change the status?", function(confirm) {
		if( confirm )
		{
			$.blockUI({ message: '<div>'+lang.common.processing+'</div><img src="'+root_url+'assets/img/ajax-loading.gif" />', 
				onBlock: function(){
					$.ajax({
						url: base_url + module.get('route') + '/change_status',
						type:"POST",
						async: false,
						data: {record_id:record_id, status_id:status_id},
						dataType: "json",
						success: function ( response ) {
							handle_ajax_message( response.message );
							refresh_list();
						}
					});
				}
			});
			$.unblockUI();
		}
	});
}