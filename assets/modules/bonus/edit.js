$(document).ready(function(){
    $('#payroll_bonus-bonus_transaction_id').select2({
        placeholder: "Select an option",
        allowClear: true
    });
    if (jQuery().datepicker) {
        $('#payroll_bonus-payroll_date').parent('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
        $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
    }
    if (jQuery().datepicker) {
        $('#payroll_bonus-date_from').parent('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
        $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
    }
    $(":input").inputmask();
    $('#payroll_bonus-week').multiselect();

    $('#payroll_bonus-transaction_method_id').select2({
        placeholder: "Select an option",
        allowClear: true
    });
    $('#payroll_bonus-account_id').select2({
        placeholder: "Select an option",
        allowClear: true
    });
});

function save_record( form, action, callback )
{
    if ($('.method').val() == 5) {
        var validation = {};  

        $('.list_amount').each(function (index, elem) {
            var orig_value = $(elem).val();
            var value = $(elem).val().replace(",","");

            if (parseFloat(value) > 1000) {
                validation[index] = {};
                validation[index]['type'] = "error";
                validation[index]['message'] = orig_value + ' is not a valid percentage';
            }
        });

        if (!$.isEmptyObject(validation)) {
            handle_ajax_message( validation );
            return false;
        }        
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