$(document).ready(function(){
	$(":input").inputmask();
	
	$('.select2me').select2({
	    placeholder: "Select an option",
	    allowClear: true
	});
	$('.date-picker').datepicker({
		rtl: App.isRTL(),
		autoclose: true
	});	
});


function save_record( form, action, callback )
{
	if ($('#time_form_balance_fcc_setup-company_id').val() == null) {
		$('#time_form_balance_fcc_setup-company_id').prepend(new Option("", ""));
		$('#time_form_balance_fcc_setup-company_id').select2("val", "").trigger('change');
	}
		
	if ($('#time_form_balance_fcc_setup-employment_type').val() == null) {
		$('#time_form_balance_fcc_setup-employment_type').prepend(new Option("", ""));
		$('#time_form_balance_fcc_setup-employment_type').select2("val", "").trigger('change');
	}

	if ($('#time_form_balance_fcc_setup-employment_status').val() == null) {
		$('#time_form_balance_fcc_setup-employment_status').prepend(new Option("", ""));
		$('#time_form_balance_fcc_setup-employment_status').select2("val", "").trigger('change');
	}

	if ($('#time_form_balance_fcc_setup-job_level').val() == null) {
		$('#time_form_balance_fcc_setup-job_level').prepend(new Option("", ""));
		$('#time_form_balance_fcc_setup-job_level').select2("val", "").trigger('change');
	}	

	$.blockUI({ message: saving_message(),
		onBlock: function(){

			var hasCKItem = form.find("textarea.ckeditor");

			if(hasCKItem && (typeof editor != 'undefined')){
				
				for ( instance in CKEDITOR.instances )
        			CKEDITOR.instances[instance].updateElement();
			}

			var data = form.find(":not('.dontserializeme')").serialize();
			$.ajax({
				url: base_url + module.get('route') + '/save',
				type:"POST",
				data: data,
				dataType: "json",
				async: false,
				success: function ( response ) {
					handle_ajax_message( response.message );

					if( response.saved )
					{
						if( response.action == 'insert' )
							$('#record_id').val( response.record_id );

						if (typeof(after_save) == typeof(Function)) after_save( response );
						if (typeof(callback) == typeof(Function)) callback( response );

						switch( action )
						{
							case 'new':
								document.location = base_url + module.get('route') + '/add';
								break;
						}
					}

					/*if(response.notify != "undefined")
					{
						for(var i in response.group_notif)
							socket.emit('get_push_data', {channel: 'get_user_'+response.notify[i]+'_notification', args: { broadcaster: user_id, notify: true }});
					}*/

					if(response.group_notif != "undefined")
					{
						for(var i in response.group_notif)
							socket.emit('get_push_data', {channel: 'get_group_'+response.group_notif[i]+'_notification', args: { broadcaster: user_id, notify: true }});
					}
				}
			});
		},
		baseZ: 300000000
	});
	$.unblockUI();
}