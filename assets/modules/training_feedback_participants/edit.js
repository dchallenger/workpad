$(document).ready(function(){
    $('.feedback_average').live('click',function(){
        var total_score = 0;
        var average_score = 0;
        var total_question = 0;
        $('.feedback_average:checked').each(function (index, element) {
            if ($(element).val() != '' && !isNaN($(element).val())) {
                total_score += parseFloat($(element).val());
                total_question++;
            }
        })
        average_score = total_score / total_question;

        $('#total_score').val(total_score);
        $('#average_score').val(parseFloat(average_score).toFixed(2));
    });

/*    function get_total_average(){
    	var url = base_url + module.get('route') + '/get_total_average';
        var data = $('#form_feedback_participants').serialize();

    	$.ajax({
            url: url,
            dataType: 'json',
            type:"POST",
            data: data,
            success: function (response) {
            	$('input[name="training_feedback[total_score]"]').val(response.total_score);
            	$('input[name="training_feedback[average_score]"]').val(response.average_score);
            }
    	});
    }*/
});

function save_record( form, status_id, status )
{
    $.blockUI({ message: saving_message(),
        onBlock: function(){

            var data = form.find(":not('.dontserializeme')").serialize();
            $.ajax({
                url: base_url + module.get('route') + '/save',
                type:"POST",
                data: data + '&status_id='+status_id,
                dataType: "json",
                async: false,
                success: function ( response ) {
                    handle_ajax_message( response.message );

                    if( response.saved )
                    {
                        if( response.action == 'insert' )
                            $('#record_id').val( response.record_id );

                        if(status_id != 1)
                        {
                            document.location = base_url + module.get('route');
                        }
                    }
                }
            });
        },
        baseZ: 300000000
    });
    $.unblockUI();
}