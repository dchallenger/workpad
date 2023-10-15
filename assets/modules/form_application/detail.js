$(document).ready(function(){
    $('#change_options').hide();

    if( $('#goto_vl_co').length > 0 ){
        get_selected_dates($('#record_id').val(), $('#form_status_id').val(), $('#time_forms-date_from').val(), $('#time_forms-date_to').val());
    }

    $('#goto_vl_co').click(function () {
        $('#main_form').hide();
        $('.form-actions').hide();
        $('#change_options').show();
    });

    $('.cancelled').click(function () {
        var record_id = $(this).data('record-id');
        var remarks = $('#remarks').val();

        if (!remarks) {
            $('#remarks').focus();
            notify('error', 'The Remarks field is required' );
            return false;
        } else {
            var data = {
                record_id: record_id,
                remarks: remarks
            };

            bootbox.confirm(lang.form_app.you_sure_cancel, function(confirm) {
                if( confirm )
                {
                    _cancel_record( data );
                } 
            });
        }
    });   
});

function get_selected_dates(forms_id, form_status_id, date_from, date_to, view){
    if( mobileapp )
    {
        var params = {
            'forms_id': forms_id,
            'form_status_id': form_status_id,
            'date_from': date_from,
            'date_to': date_to,
            'view': $('#view').val(),
            'form_code': $('#form_code').val()   
        };
        ajax( base_url + module.get('route') + '/get_selected_dates', params, function( response ){
            $('#change_options').html(response.selected_dates);
            $('#days').html(response.days);
        });
    }
    else{
        $.ajax({
            url: base_url + module.get('route') + '/get_selected_dates',
            type:"POST",
            async: false,
            data: 'forms_id='+forms_id+'&form_status_id='+form_status_id+'&date_from='+date_from+'&date_to='+date_to+'&view='+$('#view').val()+'&form_code='+$('#form_code').val(),
            dataType: "json",
            success: function ( response ) {
                $('#change_options').html(response.selected_dates);
                $('#days').html(response.days);
            }
        });
    }
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
            data: records,
            dataType: "json",
            beforeSend: function(){
                $('.popover-content').block();
            },
            success: function ( response ) {
                for (var i in response.message) {
                    notify(response.message[i].type, response.message[i].message);
                }
                
                if( view == 'index' ){

                    $('.custom_popover').popover('hide');

                    $('#form-list').empty();

                    $('#form-list').infiniteScroll({
                        dataPath: base_url + module.get('route') + '/get_list',
                        itemSelector: 'tr.record',
                        onDataLoading: function(){ 
                            $("#loader").show();
                        },
                        onDataLoaded: function(x, y, z){ 
                            $("#loader").hide();

                            initPopup();

                        },
                        onDataError: function(){ 
                            return;
                        },
                        search: $('input[name="list-search"]').val()
                    });
                }
                else{
                    setTimeout(function(){window.location.replace(base_url + module.get('route'))},2000);
                }
            }
        });    
    }
    
}

function back_to_mainform(cancel){
    if(cancel==1){
        get_selected_dates($('#record_id').val(), $('#form_status_id').val(), $('#time_forms-date_from').val(), $('#time_forms-date_to').val());    
    }
    $('#change_options').hide();
    $('#main_form').show();
    $('.form-actions').show();
}