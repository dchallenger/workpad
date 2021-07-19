
if (jQuery().datepicker) {
    $('#tran_date').parent('.date-picker').datepicker({
        rtl: App.isRTL(),
        autoclose: true
    });
    $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
}
$(document).ready(function(){
    $('#values').select2({
        placeholder: "Select Employee",
        allowClear: true
    });

    $('#period-process-type').die().live('change', function () {
        var type = $('#period-process-type').val();
        var data = $('#form-period-options').serialize();
        if(type == 'company_id')
        {
            $('#company_val').select2({
                placeholder: "Select Employee",
                allowClear: true
            });
            $('#company_div').show();
            $.ajax({
                url: base_url + module.get('route') + '/get_company',
                type: 'post',
                data: data,
                dataType: 'json',             
                success: function (response) {
                    handle_ajax_message( response.message );
                    $('#company_val').html( response.options );

                     $('#company_val').live('change', function () {
                            $.ajax({
                                url: base_url + module.get('route') + '/get_dropdown_options',
                                type: 'post',
                                data: data + '&company_val='+$('#company_val').val(),
                                dataType: 'json',
                                beforeSend: function(){
                                    // $('.fa-spin').addClass('fa-spinner');
                                },              
                                success: function (response) {
                                    $.unblockUI();
                                    $('#values option').remove();
                                    $('#values').append(response.options);
                                }
                            });

                        // }

                    });
                }
            });
        }   
        else
        {  
            $('#company_div').hide();
            $('#company_val option').remove();
            $.ajax({
                url: base_url + module.get('route') + '/get_dropdown_options',
                type: 'post',
                data: $('#form-period-options').serialize(),
                dataType: 'json',
                beforeSend: function(){
                    // $('.fa-spin').addClass('fa-spinner');
                },              
                success: function (response) {
                    handle_ajax_message( response.message );
                    $('#values').html( response.options );
                    
                }
            });
        }   
    }); 
});



function process_form( record_id )
{
    $.ajax({
        url: base_url + module.get('route') + '/process_form',
        type:"POST",
        async: false,
        data: 'record_id='+record_id,
        dataType: "json",
        beforeSend: function(){
            $('body').modalmanager('loading');
        },
        success: function ( response ) {
            // $("#tran_date").parent().datepicker('setStartDate',  $(this).val())
            $('.modal-container').attr('data-width', '780');
            $('.modal-container').html(response.process_form);
            $('.modal-container').modal();
        }
    });
}

function process_sbr( record_id )
{
    $.ajax({
        url: base_url + module.get('route') + '/process',
        type:"POST",
        data: $('#form-sbr').serialize() + '&record_id=' + record_id,
        dataType: "json",
        async: false,
        beforeSend: function(){
            $('.fa-spin').addClass('fa-spinner');
        },
        success: function ( response ) {  
            $('.fa-spin').removeClass('fa-spinner');
            $('.modal-container').modal('hide');
            handle_ajax_message( response.message );  
        }
    });
    $.unblockUI(); 
}