$(document).ready(function(){
    init_form();
    $(":input").inputmask();

    $('#loan_with_outstanding-temp').change(function(){
        if ($('#record_id').val() < 0) {
            $('#loan_application_loan_balance_amount').val('');
            $('#loan_application_loan_loanable_amount').val('');        
        }
        if( $(this).is(':checked') ) {
            $('#loan_with_outstanding').val('1');
            $('.amount_bal_loan').show();
        } else {
            $('#loan_with_outstanding').val('0');
            $('.amount_bal_loan').hide();
            $('#loan_application_loan_balance_amount').val('');
            $('#loan_application_loan_loanable_amount').val('');                           
        }
    });

    $('#loan_application_loan_balance_amount').live('keyup', function() {
        var loan_amount = parseFloat($('#loan_application_loan_amount').val().replace(',',""));
        var loanable_balance = parseFloat($(this).val().replace(',',""));
        var loanable_amount = parseFloat(loan_amount - loanable_balance);
        $('#loan_application_loan_loanable_amount').val(loanable_amount);
    });

    $('#loan_application_loan_amount').live('keyup', function() {
        var loan_amount = parseFloat($(this).val().replace(',',""));
        var loanable_balance = parseFloat($('#loan_application_loan_balance_amount').val().replace(',',""));
        var loanable_amount = parseFloat(loan_amount - loanable_balance);
        $('#loan_application_loan_loanable_amount').val(loanable_amount);
    });     
    //$("#decimal_val").inputmask({ 'alias': 'decimal', 'autoGroup': true, 'groupSeparator': ',', 'groupSize': 3, 'repeat': 13, 'greedy' : false });
});

function init_form()
{
    var enableDays = ['15', '30'];

    if (jQuery().datepicker) {
        $('#loan_application_loan_deduction_start,#loan_application_pay_period_from').parent('.date-picker').datepicker({
            autoclose: true,
            beforeShowDay: function(date){
                var day = String(date.getDate());
                if (enableDays.indexOf(day) >= 0)
                    return true;
                else
                    return false;
            }
        });
        $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
    }

    if (jQuery().datepicker) {
        $('#loan_application_loan_deduction_end,#loan_application_pay_period_to').parent('.date-picker').datepicker({
            autoclose: true,
            beforeShowDay: function(date){
                var day = String(date.getDate());
                if (enableDays.indexOf(day) >= 0)
                    return true;
                else
                    return false;
            }            
        });
        $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
    }    

    if (jQuery().datepicker) {
        $('#loan_application_pay_period_from').parent('.date-picker').datepicker({
            autoclose: true
        });
        $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
    }   

    if (jQuery().datepicker) {
        $('#loan_application_pay_period_to').parent('.date-picker').datepicker({
            autoclose: true
        });
        $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
    }           
}

function formatDate(d) {
    var day = String(d.getDate())

    //add leading zero if day is is single digit
    if (day.length == 1)
        day = '0' + day

    var month = String((d.getMonth()+1))

    //add leading zero if month is is single digit

    if (month.length == 1)
        month = '0' + month

    return d.getFullYear() + '-' + month + "-" + day;
}

function cancel_record( record_id, callback )
{
    bootbox.confirm(lang.form_app.you_sure, function(confirm) {
        if( confirm )
        {
            _cancel_record( record_id, callback );
        } 
    });
}

function _cancel_record( records, callback )
{
    if( mobileapp )
    {
        var params = {
            records: records
        };
        ajax( base_url + module.get('route') + '/cancel_record', params, function(response){
            $('body').modalmanager('removeLoading');
            handle_ajax_message( response.message );

            if (typeof(callback) == typeof(Function))
                callback();
            else
                $('#form-list').infiniteScroll('search');
        });
    }
    else{
        $.ajax({
            url: base_url + module.get('route') + '/cancel_record',
            type:"POST",
            async: false,
            data: 'records='+records,
            dataType: "json",
            beforeSend: function(){
                $('body').modalmanager('loading');
            },
            success: function ( response ) {
                
            }
        });    
    }
    
}
function save_form( forms, status )
{
    if ($('#time_forms-focus_date').length > 0){
        if ($('#form_code').val() == 'OT'){
            if ($('#time_forms-focus_date').val() == ''){
                notify('error', 'Focus date is required');
                return false;
            }
        }
        else if ($('#form_code').val() == 'DTRP' && $('#dtrp_type').val() == 2){
            if ($('#time_forms-focus_date').val() == ''){
                notify('error', 'Focus date is required');
                return false;
            }
        }            
    }

    $.blockUI({ message: saving_message(),
        onBlock: function(){
            forms.submit( function(e){ e.preventDefault(); } );
            var save_url = forms.attr('action');
            var data = forms.find(":not('.dontserializeme')").serialize()
            if( mobileapp )
            {
                $('form#edit-loan-application').block({ message: '<div> '+lang.form_app.saving+' '+$('#loan_type').val()+', '+lang.form_app.please_wait+'</div><img src="'+root_url+'assets/img/ajax-loading.gif" />' });
                ajax( save_url, data+'&loan_application_status_id='+status, function( response ){
                    $('form#edit-loan-application').unblock();
                        
                    if( typeof response.forms_id != 'undefiend' )
                    {
                        $('form#edit-loan-application input[name="forms_id"]').val( response.forms_id );
                    }

                    handle_ajax_message( response.message );

                    if( typeof (response.notified) != 'undefined' )
                    {
                        for(var i in response.notified)
                        {
                            socket.emit('get_push_data', {channel: 'get_user_'+response.notified[i]+'_notification', args: { broadcaster: user_id, notify: true }});
                        }
                    }

                    if(response.saved )
                    {
                        $('#btn-close-modal').trigger('click');    
                        init_tab_app( true );    
                    }    
                });
            }
            else{  
                $.ajax({
                    url: save_url,
                    type:"POST",
                    data: data + "&loan_application_status_id=" + status,
                    dataType: "json",
                    async: false,
                    beforeSend: function(){
                        
                    },
                    success: function ( response ) {
                        $('form#edit-loan-application').unblock();
                        
                        if( typeof response.forms_id != 'undefiend' )
                        {
                            $('form#edit-loan-application input[name="forms_id"]').val( response.forms_id );
                        }

                        handle_ajax_message( response.message );

                        if( typeof (response.notified) != 'undefined' )
                        {
                            for(var i in response.notified)
                            {
                                socket.emit('get_push_data', {channel: 'get_user_'+response.notified[i]+'_notification', args: { broadcaster: user_id, notify: true }});
                            }
                        }

                        if(response.saved )
                        {
                            setTimeout(function(){window.location.replace(base_url + module.get('route'))},1000);    
                        }
                    }
                });
            }
        },
        baseZ: 300000000
    });
    setTimeout(function(){$.unblockUI()},2000);
    // $.unblockUI();
}

//close filter dropdown once orientation change
window.addEventListener("orientationchange", function() {
    $( ".btn-group" ).trigger( "click" );
}, false);   