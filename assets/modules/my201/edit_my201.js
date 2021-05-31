$(document).ready(function() {
	FormComponents.init();

	$(":input").inputmask();

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
	    	
	$('.make-switch').not(".has-switch")['bootstrapSwitch']();
	$('label[for="partners_personal_history-family-dependent-temp"]').css('margin-top', '0');
    $('label[for="partners_personal_history-family-dependent-hmo-temp"]').css('margin-top', '0');
    $('label[for="partners_personal_history-family-dependent-insurance-temp"]').css('margin-top', '0');

	$('.dependent').change(function(){
	    if( $(this).is(':checked') ){
	    	$(this).parent().next().val(1);
	    }
	    else{
	    	$(this).parent().next().val(0);
	    }
	});
	
	if (jQuery().datepicker) {
	    $('#users_profile-birth_date').parent('.date-picker').datepicker({
	        rtl: App.isRTL(),
	        autoclose: true
	    });
	    $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
	}

	$('.form-undo').click(function() {
		$('form').submit();
	})

	$('.select2me').select2({
		placeholder: "Select an option",
		allowClear: true		
	});

	$('#same_present').live('click', function() {
		var pres_address = $('#partners_personal-address_1').val();
		var pres_city = $('#partners_personal-present_city').val();
		var pres_country = $('#partners_personal-present_country').val();
		var pres_zipcode = $('#partners_personal-zip_code').val();

		if ($('#same_present').is(':checked')) {
			$('#partners_personal-permanent_address').val(pres_address);
			$('#partners_personal-permanent_city').val(pres_city);
			$('#partners_personal-permanent_country').val(pres_country);
			$('#partners_personal-permanent_zipcode').val(pres_zipcode);

			$('#partners_personal-permanent_city').select2().trigger('change');
			$('#partners_personal-permanent_zipcode').select2().trigger('change');
		}
		else {
			$('#partners_personal-permanent_address').val('');
			$("#partners_personal-permanent_city").select2("val", "");
			$("#partners_personal-permanent_country").select2("val", "");
			$('#partners_personal-permanent_zipcode').val('');			
		}
	});	

	$('#partners_personal-solo_parent-temp').change(function(){
	    if( $(this).is(':checked') )
	        $('#partners_personal-solo_parent').val('1');
	    else
	        $('#partners_personal-solo_parent').val('0');
	});
	$('label[for="partners_personal-solo_parent-temp"]').css('margin-top', '0');		

	if (jQuery().datepicker) {
	    $('#partners_personal-birth_date').parent('.date-picker').datepicker({
	        rtl: App.isRTL(),
	        autoclose: true
	    });
	    $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
	}

    $('#partners_personal_history-training-budgeted-temp').change(function(){
        if( $(this).is(':checked') ){
            $(this).parent().next().val(1);
        }
        else{
            $(this).parent().next().val(0);
        }
    }); 
	$('label[for="partners_personal_history-training-budgeted-temp"]').css('margin-top', '0');

	$('#partners_personal_history-test-result-temp').change(function(){
	    if( $(this).is(':checked') )
	        $('#partners_personal_history-test-result').val('1');
	    else
	        $('#partners_personal_history-test-result').val('0');
	});
	$('label[for="partners_personal_history-test-result-temp"]').css('margin-top', '0');

    $('.test_attach').fileupload({ 
        url: base_url + module.get('route') + '/single_upload',
        autoUpload: true,
        contentType: false,
    }).bind('fileuploadadd', function (e, data) {
        $.blockUI({ message: '<div>Attaching file, please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />' });
    }).bind('fileuploaddone', function (e, data) { 

        $.unblockUI();
        var file = data.result.file;
        if(file.error != undefined && file.error != "")
		{
			notify('error', file.error);
		}
		else{
            $(this).parent().parent().parent().children('span').children('span').children('span.fileupload-preview').html(file.name);
            $(this).parent().children('span.fileupload-new').css('display', 'none');
            $(this).parent().children('.fileupload-exists').css('display', 'inline-block');
            $(this).parent().parent().children('.fileupload-delete').css('display', 'inline-block');
        	$(this).parent().parent().parent().parent().children('input:hidden:first').val(file.url);
        }
    }).bind('fileuploadfail', function (e, data) { 
        $.unblockUI();
        notify('error', data.errorThrown);
    });

    $('.licensure_attach').fileupload({ 
        url: base_url + module.get('route') + '/single_upload',
        autoUpload: true,
        contentType: false,
    }).bind('fileuploadadd', function (e, data) {
        $.blockUI({ message: '<div>Attaching file, please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />' });
    }).bind('fileuploaddone', function (e, data) { 

        $.unblockUI();
        var file = data.result.file;
        if(file.error != undefined && file.error != "")
		{
			notify('error', file.error);
		}
		else{
            $(this).parent().parent().parent().children('span').children('span').children('span.fileupload-preview').html(file.name);
            $(this).parent().children('span.fileupload-new').css('display', 'none');
            $(this).parent().children('.fileupload-exists').css('display', 'inline-block');
            $(this).parent().parent().children('.fileupload-delete').css('display', 'inline-block');
        	$(this).parent().parent().parent().parent().children('input:hidden:first').val(file.url);
        }
    }).bind('fileuploadfail', function (e, data) { 
        $.unblockUI();
        notify('error', data.errorThrown);
    });
    
/*	$('#partners_personal_history-licensure-attach-fileupload').fileupload({
        url: base_url + module.get('route') + '/single_upload',
        autoUpload: true,
    }).bind('fileuploadadd', function (e, data) {
        $.blockUI({ message: '<div>Attaching file, please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />' });
    }).bind('fileuploaddone', function (e, data) {
        $.unblockUI();
        var file = data.result.file;
        if(file.error != undefined && file.error != "")
        {
            notify('error', file.error);
        }
        else{
            $('#partners_personal_history-licensure-attach').val(file.url);
            $('#partners_personal_history-licensure-attach-container .fileupload-preview').html(file.name);
            $('#partners_personal_history-licensure-attach-container .fileupload-new').each(function(){ $(this).css('display', 'none') });
            $('#partners_personal_history-licensure-attach-container .fileupload-exists').each(function(){ $(this).css('display', 'inline-block') });
        }
    }).bind('fileuploadfail', function (e, data) {
        $.unblockUI();
        notify('error', data.errorThrown);
    });

    $('#partners_personal_history-licensure-attach-container .fileupload-delete').click(function(){
        $('#partners_personal_history-licensure-attach').val('');
        $('#partners_personal_history-licensure-attach-container .fileupload-preview').html('');
        $('#partners_personal_history-licensure-attach-container .fileupload-new').each(function(){ $(this).css('display', 'inline-block') });
        $('#partners_personal_history-licensure-attach-container .fileupload-exists').each(function(){ $(this).css('display', 'none') });
    });

    if( $('#partners_personal_history-licensure-attach').val() != "" )
    {
        $('#partners_personal_history-licensure-attach-container .fileupload-new').each(function(){ $(this).css('display', 'none') });
        $('#partners_personal_history-licensure-attach-container .fileupload-exists').each(function(){ $(this).css('display', 'inline-block') });
    }	*/
});

function view_personal_details(modal_form, key_class, sequence){	
	$.ajax({
		url: base_url + module.get('route') + '/view_personal_details',
		type:"POST",
		async: false,
		data: 'modal_form='+modal_form+'&key_class='+key_class+'&sequence='+sequence,
		dataType: "json",
		beforeSend: function(){
			// $('body').modalmanager('loading');
		},
		success: function ( response ) {

			handle_ajax_message( response.message );

			if( typeof(response.view_details) != 'undefined' )
			{	
				$('.modal-container-partners').html(response.view_details).modal();		
			}

		}
	});	
}
function save_partner( partner )
{
	partner.submit( function(e){ e.preventDefault(); } );
	var user_id = $('#record_id').val();
	var partner_id = partner.attr('partner_id');
	//$('input[type="text"],input[type="radio"], textarea, select').attr("disabled", false);		
	$.blockUI({ message: saving_message(), 
		onBlock: function(){
			partner.submit( function(e){ e.preventDefault(); } );
			var partner_id = partner.attr('partner_id');
			var data = partner.find(":not('.dontserializeme')").serialize();
			data = data + '&record_id=' + $('#record_id').val()+ '&fgs_number=' + partner_id;
			


			$.ajax({
				url: base_url + module.get('route') + '/save',
				type:"POST",
				data: data,
				dataType: "json",
				async: false,
				success: function ( response ) {
					handle_ajax_message( response.message );
					//$('input[type="text"],input[type="radio"], textarea, select').attr("disabled", true);		
					
				}
			});
		}
	});
	$.unblockUI();	

    // location.reload();
}


	//remove phone
function remove_form(div_form, mode, tab){
	if(tab == 'history'){
		$('#'+div_form).parent().parent().parent().remove();
		var count = ($('#'+mode+'_count').val() - 1);
		$('#'+mode+'_count').val(count);
	}else{
		$('#'+div_form).parent().parent().remove();
		var count = ($('#'+mode+'_count').val() - 1);
		var counting = $('#'+mode+'_counting').val();
		if( count == 1 ){
			$('.action_'+mode).remove();
			var span_delete_add = '<a class="btn btn-default action_'+mode+' add_'+mode+'" id="add_'+mode+'" onclick="add_form(\'contact_'+mode+'\', \''+mode+'\')" ><i class="fa fa-plus"></i></a>';
			$('.add_delete_'+mode).append(span_delete_add);
		}else{
			$( "#personal_"+mode+" div.form-group:last-child span.add_delete_"+mode+":last-child a.add_"+mode ).remove();
			var span_delete_add = '<a class="btn btn-default action_'+mode+' add_'+mode+'" id="add_'+mode+'" onclick="add_form(\'contact_'+mode+'\', \''+mode+'\')" ><i class="fa fa-plus"></i></a>';			
			$( "#personal_"+mode+" div.form-group:last-child span.add_delete_"+mode+":last-child" ).append(span_delete_add);	
		}
		$('#'+mode+'_count').val(count);	
		var count_val = 1;
		var num = 1;
		while(counting >= num){
			if( $('#'+mode+'_display_count-'+num).length ) {
				if(count_val == 1){
					$('#'+mode+'_display_count-'+num).text('');
				}else{
					$('#'+mode+'_display_count-'+num).text(count_val);
				}
				count_val++;
			}
			num++;
		}
	}
}

//add phone 
function add_form(add_form, mode, sequence){
	var count = $('#'+mode+'_count').val();
	var counting = $('#'+mode+'_counting').val();
	var form_category = ( $('#'+mode+'_category').length ) ? $('#'+mode+'_category').val() : '';
	if( count == 1 ){
		$('.action_'+mode).remove();
		var span_delete_add = '<a class="btn btn-default action_"'+mode+' id="delete_'+mode+'-'+counting+'" onclick="remove_form(this.id, \''+mode+'\')" ><i class="fa fa-trash-o"></i></a>';
		$('.add_delete_'+mode).append(span_delete_add);
	}
	$.ajax({
		url: base_url + module.get('route') + '/add_form',
		type:"POST",
		async: false,
		data: 'add_form='+add_form+'&count='+count+'&category='+form_category+'&counting='+counting,
		dataType: "json",
		beforeSend: function(){
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
			if( typeof(response.add_form) != 'undefined' )
			{	
				$('#add_'+mode).remove();
				$('#'+mode+'_count').val(response.count);
				$('#'+mode+'_counting').val(response.counting);
				$('#personal_'+mode).append(response.add_form);
				// handleSelect2();
				FormComponents.init();

				$(":input").inputmask();						
			}

		}
	});	
}

function _calculateAge(birthday, count) { // birthday is a date
	dateString = birthday.value;

	var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
	$( "#partners_personal_history-family-age"+count ).val(age);
}

function view_movement_details(movement_id, action_id, type_id, cause){	
	var data = {
		movement_id: movement_id,
		type_id: type_id,
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