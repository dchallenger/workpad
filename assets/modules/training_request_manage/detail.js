$(document).ready(function(){
    /*$(":input").inputmask();*/
});

function save_record( form, status_id, status )
{
    bootbox.confirm("Are you sure you want to "+status+" this request?", function(confirm) {
        if( confirm )
        {
        	$.blockUI({ message: saving_message(),
        		onBlock: function(){

        			var data = form.find(":not('.dontserializeme')").serialize();
        			$.ajax({
        				url: base_url + module.get('route') + '/save',
        				type:"POST",
        				data: data + '&training_application[status_id]='+status_id,
        				dataType: "json",
        				async: false,
        				success: function ( response ) {
        					handle_ajax_message( response.message );

        					if( response.saved )
        					{
        						if( response.action == 'insert' )
        							$('#record_id').val( response.record_id );

        						if(status_id != 1)
        						{
        							document.location = base_url + module.get('route');
        						}
        					}
        				}
        			});
        		},
        		baseZ: 300000000
        	});
        	$.unblockUI();
        }
    });
}