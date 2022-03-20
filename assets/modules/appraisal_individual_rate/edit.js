$(document).ready(function(){
    $(":input").inputmask();

    var appraisal_object = {
        none_core_no_question: 0,
        total_weight_average: {},
        grand_total_weight_average: 0,
        total_weighted_score: 0,
        total_self_weighted_score: {},
        grand_total_self_weighted_score: 0,
        total_coach_weighted_score: {},
        grand_total_coach_weighted_score: 0        
    };

    var total_weighted_score = 0;
    $('.key_weight').each(function (index, element) {
        if ($(element).val() != '' && parseFloat($(element).val()) > 0) {
            appraisal_object.none_core_no_question++;
            total_weighted_score += parseFloat($(this).val());

            var question = $(this).attr('question');
            $('.key_weight_total_'+question).html(parseFloat($(this).val()));
            $('.none_core_score_car_library_key_weight_'+question).html(parseFloat($(this).val()));
        }
    });

    appraisal_object.total_weighted_score = total_weighted_score;

    $('.total_weighted_score').html(appraisal_object.total_weighted_score+'%');

    $('.none_core_self_rating').live('keyup',function(){
        var question = $(this).attr('question');
        var key_weight = parseFloat($('.key_weight[question='+question+']').val());

        var parent = $(this).closest('tr');
        var section_id = $(parent).attr('section-id');
        var ratio_weigth = parseFloat($(parent).attr('ratio-weight'));
        var self_rating = parseFloat($(this).val());
        var target = parseFloat($(parent).find('.target').val());
        var weight = parseFloat($(parent).find('.weight').val());
        var achieved = Math.round((self_rating / target) * 100);
        var weight_average = ((achieved * weight) / 100).toFixed(2);

        if (achieved > 150)
            achieved = 150;
        else if (achieved < 50)
            achieved = 50;

        weight_average = ((achieved * weight) / 100).toFixed(2);

        if (self_rating == 0) {
            achieved = 0;
            weight_average = 0;
        }

        $(parent).find('.self_achieved').val(!isNaN(achieved) ? parseInt(achieved) : '');
        $(parent).find('.self_weight_average').val(!isNaN(weight_average) ? weight_average : '');

        var total_weight_average = 0;
        $('.self_weight_average[question='+question+']').each(function (index, element) {
            if ($(element).val() != '' && !isNaN($(element).val())) {
                total_weight_average += parseFloat($(element).val());
            }
        })

        appraisal_object.total_weight_average['q'+question] = total_weight_average;

        appraisal_object.grand_total_weight_average = sum_object(appraisal_object.total_weight_average).toFixed(2);

        var section_rate = get_in_range(parseFloat(appraisal_object.grand_total_weight_average));
        
        var total_self_weighted_score = (section_rate * ratio_weigth) / 100;

        appraisal_object.total_self_weighted_score['sec'+section_id] = parseFloat(total_self_weighted_score.toFixed(2));

        appraisal_object.grand_total_self_weighted_score = sum_object(appraisal_object.total_self_weighted_score);

        setTimeout(function(){
            $('.self_section_rating_'+section_id+'').html(appraisal_object.grand_total_weight_average);
            $('.non_core_self_rating_'+question).html((total_weight_average).toFixed(2));
            $('.self_total_weighted_'+section_id+'').html(total_self_weighted_score.toFixed(2));

            $('.self_rating').html(parseFloat(appraisal_object.grand_total_self_weighted_score).toFixed(2));
            $('.self_rating').val(parseFloat(appraisal_object.grand_total_self_weighted_score).toFixed(2));

            $('.none_core_score_car_library_self_rating_'+question+'').val((total_weight_average).toFixed(2));
            $('.section_total_weight_ave_'+section_id+'').val(appraisal_object.grand_total_weight_average);
            $('.section_total_weighted_score_'+section_id+'').val(total_self_weighted_score.toFixed(2));
        }, 3000);
    });

    $('.none_core_coach_rating').live('keyup',function(){
        var question = $(this).attr('question');
        var key_weight = parseFloat($('.key_weight[question='+question+']').val());

        var parent = $(this).closest('tr');
        var section_id = $(parent).attr('section-id');
        var ratio_weigth = parseFloat($(parent).attr('ratio-weight'));
        var coach_rating = parseFloat($(this).val());
        var target = parseFloat($(parent).find('.target').val());
        var weight = parseFloat($(parent).find('.weight').val());
        var achieved = Math.round((coach_rating / target) * 100);
        var weight_average = ((achieved * weight) / 100).toFixed(2);

        if (achieved > 150)
            achieved = 150;
        else if (achieved < 50)
            achieved = 50;

        weight_average = ((achieved * weight) / 100).toFixed(2);

        if (coach_rating == 0) {
            achieved = 0;
            weight_average = 0;
        }

        $(parent).find('.coach_achieved').val(!isNaN(achieved) ? parseInt(achieved) : '');
        $(parent).find('.coach_weight_average').val(!isNaN(weight_average) ? weight_average : '');

        var total_weight_average = 0;
        $('.coach_weight_average[question='+question+']').each(function (index, element) {
            if ($(element).val() != '' && !isNaN($(element).val())) {
                total_weight_average += parseFloat($(element).val());
            }
        });

        appraisal_object.total_weight_average['q'+question] = total_weight_average;            

        appraisal_object.grand_total_weight_average = sum_object(appraisal_object.total_weight_average).toFixed(2);

        var section_rate = get_in_range(parseFloat(appraisal_object.grand_total_weight_average));
        
        var total_coach_weighted_score = (section_rate * ratio_weigth) / 100;

        appraisal_object.total_coach_weighted_score['sec'+section_id] = parseFloat(total_coach_weighted_score.toFixed(2));

        appraisal_object.grand_total_coach_weighted_score = sum_object(appraisal_object.total_coach_weighted_score);

        setTimeout(function(){
            $('.coach_section_rating_'+section_id+'').html(appraisal_object.grand_total_weight_average);
            $('.non_core_coach_rating_'+question).html((appraisal_object.total_weight_average['q'+question]).toFixed(2));
            $('.coach_total_weighted_'+section_id+'').html(total_coach_weighted_score.toFixed(2));

            $('.coach_rating').html(parseFloat(appraisal_object.grand_total_coach_weighted_score).toFixed(2));
            $('.coach_rating').val(parseFloat(appraisal_object.grand_total_coach_weighted_score).toFixed(2));

            $('.none_core_score_car_library_coach_rating_'+question+'').val((total_weight_average).toFixed(2));
            $('.section_coach_section_rating_'+section_id+'').val(appraisal_object.grand_total_weight_average);
            $('.section_coach_total_weighted_score_'+section_id+'').val(total_coach_weighted_score.toFixed(2));
        }, 3000);
    });

    $('.core_self_rating').live('change',function(){

        var question = $(this).attr('question');
        var ratio_weigth = parseFloat($(this).attr('ratio-weight'));        
        var section_id = $(this).attr('section-id');
        var total_section = 0;

        $('.core_self_rating_'+question).html(parseFloat($(this).val()).toFixed(2));

        var cnt = 0
        $('.core_self_rating[section-id='+section_id+']').each(function (index, element) {
            var val = $(element).val();
            if (val != '') {
                total_section += parseFloat(val);
            }   
            cnt += 1;
        })

        total_section = (total_section / cnt);

        var total_self_weighted_score = parseFloat(((total_section * ratio_weigth) / 100).toFixed(2));

        appraisal_object.total_self_weighted_score['sec'+section_id] = total_self_weighted_score;
        appraisal_object.grand_total_self_weighted_score = sum_object(appraisal_object.total_self_weighted_score);

        $('.self_section_rating_'+section_id).html(total_section.toFixed(2));
        $('.self_total_weighted_'+section_id).html(total_self_weighted_score);

        $('.self_rating').html(parseFloat(appraisal_object.grand_total_self_weighted_score).toFixed(2));
        $('.self_rating').val(parseFloat(appraisal_object.grand_total_self_weighted_score).toFixed(2));

        $('.core_score_car_library_self_rating_'+question+'').val(parseFloat($(this).val()).toFixed(2));
        $('.section_total_weight_ave_'+section_id).val(total_section.toFixed(2));
        $('.section_total_weighted_score_'+section_id).val(total_self_weighted_score);
    });

    $('.core_coach_rating').live('change',function(){

        var question = $(this).attr('question');
        var ratio_weigth = parseFloat($(this).attr('ratio-weight'));        
        var section_id = $(this).attr('section-id');
        var total_section = 0;

        $('.core_coach_rating_'+question).html(parseFloat($(this).val()).toFixed(2));

        var cnt = 0
        $('.core_coach_rating[section-id='+section_id+']').each(function (index, element) {
            var val = $(element).val();
            if (val != '') {
                total_section += parseFloat(val);
            }   
            cnt += 1;
        })

        total_section = (total_section / cnt);

        var total_coach_weighted_score = parseFloat(((total_section * ratio_weigth) / 100).toFixed(2));

        appraisal_object.total_coach_weighted_score['sec'+section_id] = total_coach_weighted_score;
        appraisal_object.grand_total_coach_weighted_score = sum_object(appraisal_object.total_coach_weighted_score);

        $('.coach_section_rating_'+section_id).html(total_section.toFixed(2));
        $('.coach_total_weighted_'+section_id).html(total_coach_weighted_score);

        $('.coach_rating').html(parseFloat(appraisal_object.grand_total_coach_weighted_score).toFixed(2));
        $('.coach_rating').val(parseFloat(appraisal_object.grand_total_coach_weighted_score).toFixed(2));

        $('.core_score_car_library_coach_rating_'+question+'').val(parseFloat($(this).val()).toFixed(2));
        $('.section_coach_section_rating_'+section_id).val(total_section.toFixed(2));
        $('.section_coach_total_weighted_score_'+section_id).val(total_coach_weighted_score);
    });

    $('.none_core_coach_rating').each(function(){
        $(this).trigger('keyup');
    });

    $('.none_core_self_rating').each(function(){
        $(this).trigger('keyup');
    });

    $('.core_self_rating').each(function(){
        $(this).trigger('change');
    });

    $('.core_coach_rating').each(function(){
        $(this).trigger('change');
    });        
});        

function view_discussion( form, status_id )
{
    $.ajax({
        url: base_url + module.get('route') + '/view_discussion',
        type: "POST",
        async: false,
        data: form.find(":not('.dontserializeme')").serialize() + '&status_id='+status_id,
        dataType: "json",
        beforeSend: function () {
            $.blockUI({
                message: '<img src="'+ base_url +'assets/img/ajax-modal-loading.gif"><br />Loading discussion, please wait...',
                css: {
                    background: 'none',
                    border: 'none',     
                    'z-index':'99999'               
                },
                baseZ: 20000,
            });
        },
        success: function (response) {
            $.unblockUI();

            if (typeof (response.notes) != 'undefined') {
                $('.modal-container').html(response.notes);
                $('.modal-container').modal();          
            }
            handle_ajax_message( response.message );
        }
    });
}

function get_in_range(val) {
    var rate = 0;

    if (val > 0 && val < 65)
        rate = 1;
    else if (val >= 65 && val < 80) 
        rate = 2;
    else if (val >= 80 && val < 95) 
        rate = 3;
    else if (val >= 95 && val < 110) 
        rate = 4;
    else if (val >= 110) 
        rate = 5;

    return rate;
}

function sum_object(obj) {
    var sum_val = 0
    $.each(obj, function (key, value) {
        sum_val += value;
    });

    return sum_val;
}

//convert to float without round off
function string_to_float() {
    var str = 12.234556; 
    str = str.toString().split('.');
    var res = str[1].slice(0, 2);
    document.getElementById("demo").innerHTML = str[0]+'.'+res;
}


function change_status_self(form, status_id)
{
    var validation = {};
    
    if (status_id > 1) {
        $('.none_core_self_rating').each(function (index, element){
            var fieldval = parseFloat($(this).val());
            var weight_val = $(this).closest('tr').find('.weight').val();
            var score_card = $(this).data('score-card');

            var valid = /^[-+]?\d+(\.\d+)?$/.test( fieldval );

            if( fieldval.toString() != "" && valid){
                if( fieldval < 0.1 && weight_val > 0){
                    validation[index] = {};
                    validation[index]['type'] = "error";
                    validation[index]['message'] = 'Under "'+score_card+'" has field 0 value';
                }
            }
            else if(isNaN(fieldval.toString())) {
                validation[index] = {};
                validation[index]['type'] = "error";
                validation[index]['message'] = 'Under "'+score_card+'" has empty field';            
            }        
        });

        if (!$.isEmptyObject(validation)) {
            handle_ajax_message( validation );
            return false;
        }

        $('.core_self_rating').each(function (index, element){
            var fieldval = parseFloat($(this).val());
            var library_value = $(this).data('library-value');

            if(fieldval == 0){
                validation[index] = {};
                validation[index]['type'] = "error";
                validation[index]['message'] = 'Under "'+library_value+'" has empty field';
            }
        });

        if (!$.isEmptyObject(validation)) {
            handle_ajax_message( validation );
            return false;
        }        
    }

    $.blockUI({ message: '<div>Saving, please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />',
        onBlock: function(){
            var data = form.find(":not('.dontserializeme')").serialize() + '&status_id='+status_id;
            $.ajax({
                url: base_url + module.get('route') + '/change_status',
                type:"POST",
                data: data,
                dataType: "json",
                async: false,
                success: function ( response ) {
                    handle_ajax_message( response.message );

                    if(response.notify != "undefined")
                    {
                        for(var i in response.notify)
                            socket.emit('get_push_data', {channel: 'get_user_'+response.notify[i]+'_notification', args: { broadcaster: user_id, notify: true }});
                    }

                    if(response.redirect)
                        //window.location = base_url + module.get('route');
                        window.location = response.redirect;
                }
            });
        },
        baseZ: 300000000
    });
    $.unblockUI();  
}