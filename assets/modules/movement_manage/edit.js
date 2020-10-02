$(document).ready(function(){
    if (jQuery().datepicker) {
        $('#partners_movement_action_transfer-end_date').parent('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
        $('body').removeClass("modal-open"); 
    }

	if ($('#record_id').val() > 0) {
		edit_movement_details($('#type_id').val(),$('#partners_movement_action-action_id').val());
	}

	if (jQuery().datepicker) {
		$('#partners_movement_action-effectivity_date').parent('.date-picker').datepicker({
			rtl: App.isRTL(),
			autoclose: true
		});
	    $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
	}

	$('#partners_movement_action-type_id').select2({
	    placeholder: "Select an option",
	    allowClear: true
	});

	$('.select2me').select2({
	    placeholder: "Select an option",
	    allowClear: true
	});	

	$('#partners_movement-due_to_id').select2({
	    placeholder: "Select an option",
	    allowClear: true
	});

	$('#type_id').live('change',function(){
		var val = $(this).val();
		if (val == 8){
			$('.cat_type').show();
		}
		else{
			$('.cat_type').hide();			
		}
	});	
	
	var movement_type_transfer = ["1","3","8","9"];

	$('#partners_movement_action-user_id').live('change',function() {
		if ($.inArray($('#type_id').val(),movement_type_transfer) !== -1)
			get_employee_details($(this).val());
	});

	$('#type_id').live('change',function () {
		edit_movement_details($(this).val(),$('#partners_movement_action-action_id').val());
	});

	$('#partners_movement-photo-fileupload').fileupload({ 
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
			$('.files').append(data.result.html);
		}
	}).bind('fileuploadfail', function (e, data) { 
		$.unblockUI();
		notify('error', data.errorThrown);
	});

	$('.delete_attachment').live('click', function(){
		$(this).closest('tr').remove();
	});	
});