$(document).ready(function(){
    $('#training_application-include_idp-temp').change(function(){
        if( $(this).is(':checked') ) {
            $('#training_application-include_idp').val('1');
            get_idp();
        } else { 
            $('#training_application-include_idp').val('0');

            $('#training_application-areas_development').select2('val','');
            $('#training_application-competency').select2('val','');            
        }
    });

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

    $('.select2me').select2({
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

    $('#training_application-training_course_id').live('change',function(){
        get_training_course_info($(this).val());
    });

    $('#training_application-training_calendar').change(function (){
        var training_calendar_id = $(this).val();

        if (training_calendar_id != '') {
            $('.min_capacity').show();
            $('.max_capacity').show();
            var url = base_url + module.get('route') + '/get_training_calendar_info';
            $.ajax({
                url: url,
                dataType: 'json',
                type:"POST",
                data: 'training_calendar_id='+training_calendar_id,
                success: function (response) {
                    if (response.message[0].type == 'success') {
                        $('#training_application-training_type').select2("val",response.calendar_info.calendar_type_id);
                        $('#training_application-date_from').val(response.calendar_info.date_from);
                        $('#training_application-date_to').val(response.calendar_info.date_to);
                        $('#training_application-training_course_id').select2("val",response.calendar_info.course_id);
                        $('#training_application-training_provider').select2("val",response.calendar_info.training_provider_id);
                        $('#training_application-venue').val(response.calendar_info.venue);
                        $('#training_application-total_training_hour').val(response.calendar_info.total_training_hours);
                        $('#training_calendar-min_training_capacity').val(response.calendar_info.training_capacity);
                        $('#training_calendar-max_training_capacity').val(response.calendar_info.min_training_capacity);

                    }
                }
            });      
        } else {
            $('.min_capacity').hide();
            $('.max_capacity').hide();            
        }  
    });
    
    if ($('#training_application-training_calendar').val() != '') {
        var training_calendar_id = $('#training_application-training_calendar').val();

        $('.min_capacity').show();
        $('.max_capacity').show();

        var url = base_url + module.get('route') + '/get_training_calendar_info';
        $.ajax({
            url: url,
            dataType: 'json',
            type:"POST",
            data: 'training_calendar_id='+training_calendar_id,
            success: function (response) {
                if (response.message[0].type == 'success') {
                    $('#training_calendar-min_training_capacity').val(response.calendar_info.training_capacity);
                    $('#training_calendar-max_training_capacity').val(response.calendar_info.min_training_capacity);
                }
            }
        });         
    }
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

function get_idp()
{
    $.blockUI({ message: loading_message(), 
        onBlock: function(){
            $.ajax({
                url: base_url + module.get('route') + '/get_idp',
                type:"POST",
                dataType: "json",
                async: false,
                success: function ( response ) {
                    handle_ajax_message( response.message );

                    if( typeof(response.quick_edit_form) != 'undefined' )
                    {
                        $('.modal-container').attr('data-width', '850');
                        $('.modal-container').html(response.quick_edit_form);
                        $('.modal-container').modal();

                        $('.apply_idp').live('click', function() {

                            var area_development = [];
                            var competencies = [];
                            $('.check_val').each(function (index, element) {
                                if ($(element).is(':checked')) {
                                    var area_competencies = $(element).val();
                                    var area_competencies_arr = area_competencies.split('|');
                                    area_development.push(area_competencies_arr[0]);
                                    competencies.push(area_competencies_arr[1]);
                                }
                            });

                            $('#training_application-areas_development').select2('val',area_development );
                            $('#training_application-competency').select2('val',competencies );
                            $('.modal-container').modal('hide');
                        });
                    }
                    $('.modal-container').modal('hide');
                }
            });
        }
    });
    $.unblockUI();  
}
