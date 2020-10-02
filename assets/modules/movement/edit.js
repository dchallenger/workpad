$(document).ready(function(){
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