$(document).ready(function(){
    $('#training_application-attachment-fileupload').fileupload({
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
    		$('#training_application-attachment').val(file.url);
    		$('#training_application-attachment-container .fileupload-preview').html(file.name);
    		$('#training_application-attachment-container .fileupload-new').each(function(){ $(this).css('display', 'none') });
    		$('#training_application-attachment-container .fileupload-exists').each(function(){ $(this).css('display', 'inline-block') });
    	}
    }).bind('fileuploadfail', function (e, data) {
    	$.unblockUI();
    	notify('error', data.errorThrown);
    });

    $('#training_application-attachment-container .fileupload-delete').click(function(){
    	$('#training_application-attachment').val('');
    	$('#training_application-attachment-container .fileupload-preview').html('');
    	$('#training_application-attachment-container .fileupload-new').each(function(){ $(this).css('display', 'inline-block') });
    	$('#training_application-attachment-container .fileupload-exists').each(function(){ $(this).css('display', 'none') });
    });

    if( $('#training_application-attachment').val() != "" )
    {
    	$('#training_application-attachment-container .fileupload-new').each(function(){ $(this).css('display', 'none') });
    	$('#training_application-attachment-container .fileupload-exists').each(function(){ $(this).css('display', 'inline-block') });
    }
    $('#training_application-competency').select2({
        placeholder: "Select an option",
        allowClear: true
    });
    $('#training_application-areas_development').select2({
        placeholder: "Select an option",
        allowClear: true
    });
    $('#training_application-training_provider').select2({
        placeholder: "Select an option",
        allowClear: true
    });
    $('#training_application-training_course_id').select2({
        placeholder: "Select an option",
        allowClear: true
    });
    if (jQuery().datepicker) {
        $('#training_application-date_to').parent('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
        $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
    }
    if (jQuery().datepicker) {
        $('#training_application-date_from').parent('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
        $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
    }
    $('#training_application-training_type').select2({
        placeholder: "Select an option",
        allowClear: true
    });


    $('#training_application-training_course_id').live('change',function(){
        get_training_course_info($(this).val());
    });    
});


function get_training_course_info(course_id = 0){

    var url = base_url + module.get('route') + '/get_training_course_info';
    $.ajax({
        url: url,
        dataType: 'json',
        type:"POST",
        data: 'course_id='+course_id,
        success: function (response) {
            $('#training_application-training_provider').val(response.training_provider_id);
            $('#training_application-training_provider').select2("val",response.training_provider_id);
        }
    });
}