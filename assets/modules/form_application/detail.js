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

function back_to_mainform(cancel){
    if(cancel==1){
        get_selected_dates($('#record_id').val(), $('#form_status_id').val(), $('#time_forms-date_from').val(), $('#time_forms-date_to').val());    
    }
    $('#change_options').hide();
    $('#main_form').show();
    $('.form-actions').show();
}