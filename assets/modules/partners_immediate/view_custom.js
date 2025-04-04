$(document).ready(function() {
    var service = get_service(  $('#partners-effectivity_date').val() );
    $('span.calculatedservice').html(service+"&nbsp;&nbsp;years of service")

	var sbu_unit_ids = $('#partners-sbu_unit').val();
	$.ajax({
		url: base_url + module.get('route') + '/get_sbu_unit_percentage',
		type:"POST",
		async: false,
		data: 'sbu_unit_ids='+sbu_unit_ids,
		dataType: "json",
		success: function ( response ) {
			$('.total_percentage').html(response.total_perentage);
		}
	});		    
});

function view_personal_details(modal_form, key_class, sequence){	
	$.ajax({
		url: base_url + module.get('route') + '/view_personal_details',
		type:"POST",
		async: false,
		data: 'modal_form='+modal_form+'&key_class='+key_class+'&sequence='+sequence+'&record_id='+$('#record_id').val(),
		dataType: "json",
		beforeSend: function(){
			// $('body').modalmanager('loading');
		},
		success: function ( response ) {

			for( var i in response.message )
			{
				if(response.message[i].message != "")
				{
					var message_type = response.message[i].type;
					notify(response.message[i].type, response.message[i].message);
				}
			}

			if( typeof(response.view_details) != 'undefined' )
			{	
				$('.modal-container-partners').html(response.view_details).modal();		
			}

		}
	});	
}

function view_movement_details(movement_id, action_id, type_id, cause){	
	var data = {
		type_id: type_id,
		movement_id: movement_id,
		action_id: action_id,
		cause: cause
	};
	
	$.ajax({
	url: base_url + module.get('route') + '/get_action_movement_details',
	type:"POST",
	async: false,
	data: data,
	dataType: "json",
	beforeSend: function(){
				$('body').modalmanager('loading');
			},
			success: function ( response ) {

				for( var i in response.message )
				{
					if(response.message[i].message != "")
					{
						var message_type = response.message[i].type;
						notify(response.message[i].type, response.message[i].message);
					}
				}

				if( typeof(response.add_movement) != 'undefined' )
				{	
					$('.modal-container-action').html(response.add_movement);
					$('.move_action_modal').append(response.type_of_movement);	
					$('.modal-container-action').modal('show');	
					// FormComponents.init();
				}

			}
	});	
}

// Handle Select2 Dropdowns
var handleSelect2 = function() {
    if (jQuery().select2) {
        $('.select2me').select2({
            placeholder: "Select",
            allowClear: true
        });
    }
}

jQuery(document).ready(function() {    
   // App.init(); // initlayout and core plugins
		UIExtendedModals.init();
});