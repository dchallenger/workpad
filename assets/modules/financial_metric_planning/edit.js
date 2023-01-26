$(document).ready(function(){
	$(":input").inputmask();

	$('#performance_financial_metric_planning-user_ids').multiselect();
	$('#performance_financial_metric_planning-financial_metric_kpi_ids').multiselect();

	$('#performance_financial_metric_planning_add_kpi').click(function() {
		var kpi = $('#performance_financial_metric_kpi').val();

		var ctr = 0;
	    $('.kpi').each(function (index, element) {
	    	if($(element).val() == kpi ){
		        ctr++
		    }
		}); 

	    if (ctr > 0) {
	   		notify('error', 'Financial Metric KPI already added details below');
	   		return false;
	    }

	    if (kpi == '') {
	    	return false;
	    }

        var html = '<div class="row">\
			<div class="col-md-3">\
				<div class="">\
					<label class="control-label"><span class="required">* </span>Key Performance Indicators / Measures</label>\
					<input type="text" class="form-control kpi" name="performance_financial_metric_planning[kpi][]" id="performance_financial_metric_planning-key_in_weight" value="'+kpi+'"/>\
				</div>\
			</div>\
			<div class="col-md-1">\
				<div class="">\
					<label class="control-label">% Weight</label>\
					<input type="text" class="form-control weight" name="performance_financial_metric_planning[weight][]" value="" placeholder="Enter Weight" data-inputmask="\'mask\': \'9\', \'repeat\': 3, \'greedy\' : false"/>\
				</div>\
			</div>\
			<div class="col-md-1">\
				<div class="">\
					<label class="control-label"><span class="required">* </span>Target </label>\
					<input type="text" class="form-control target" name="performance_financial_metric_planning[target][]" value="" placeholder="Enter Target" data-inputmask="\'alias\': \'decimal\', \'autoGroup\': true, \'groupSeparator\': \',\', \'groupSize\': 3, \'repeat\': 13, \'greedy\' : false"/>\
				</div>\
			</div>\
			<div class="col-md-2">\
                <div class="form-group">\
                    <label class="control-label">Rating Comp<span class="required">*</span></label>\
                    <select name="performance_financial_metric_planning[rating_comp][]" class="form-control select2me rating-comp" data-placeholder="Select...">\
                        <option value="1">Actual/Target</option>\
                        <option value="2">Target/Actual</option>\
                    </select>\
                </div>\
			</div>\
			<div class="col-md-1">\
				<div class="">\
					<label class="control-label"><span class="required">* </span>Actual </label>\
					<input type="text" class="form-control actual" name="performance_financial_metric_planning[actual][]" value="" placeholder="Enter Actual" data-inputmask="\'alias\': \'decimal\', \'autoGroup\': true, \'groupSeparator\': \',\', \'groupSize\': 3, \'repeat\': 13, \'greedy\' : false"/>\
				</div>\
			</div>\
			<div class="col-md-1">\
				<div class="">\
					<label class="control-label">Rating </label>\
					<input type="text" readonly class="form-control fm_rating" name="performance_financial_metric_planning[rating][]" value="" placeholder="Enter Rating" data-inputmask="\'alias\': \'decimal\', \'autoGroup\': true, \'groupSeparator\': \',\', \'groupSize\': 3, \'repeat\': 13, \'greedy\' : false"/>\
				</div>\
			</div>\
			<div class="col-md-2">\
				<div class="">\
					<label class="control-label">Weighted Rating </label>\
					<input type="text" readonly class="form-control weighted_rating" name="performance_financial_metric_planning[weighted_rating][]" value="" placeholder="Enter Weighted Rating" data-inputmask="\'alias\': \'decimal\', \'autoGroup\': true, \'groupSeparator\': \',\', \'groupSize\': 3, \'repeat\': 13, \'greedy\' : false"/>\
				</div>\
			</div>\
			<div class="col-md-1">\
				<div class="">\
					<label class="control-label">&nbsp; </label>\
		            <span class="input-group-btn">\
                    	<button type="button" class="btn btn-danger del_row_kpi" id="performance_financial_metric_planning_add_kpi"><i class="fa fa-trash-o"></i></button>\
                    </span>\
				</div>\
			</div>\
		</div>';

		$('#kpi_container').append(html);

		del_kpi_row();

		$(":input").inputmask();

		$('.rating_comp').select2({
		    placeholder: "Select an option",
		    allowClear: true
		});
	})

	$('#performance_financial_metric_planning-planning_id').select2({
	    placeholder: "Select an option",
	    allowClear: true
	});

	$('#performance_financial_metric_planning-sbu_unit').select2({
	    placeholder: "Select an option",
	    allowClear: true
	});

	$('.rating_comp').select2({
	    placeholder: "Select an option",
	    allowClear: true
	});


	del_kpi_row();

    $('.actual').live('keyup',function(){
        var parent = $(this).closest('div.row');
        var weight = parseFloat($(parent).find('.weight').val().replace(/,/g, ''));
        var actual = parseFloat($(this).val().replace(/,/g, ''));
        var rating_comp = parseFloat($(parent).find('.rating-comp').val());
        var target = parseFloat($(parent).find('.target').val().replace(/,/g, ''));

        var rating = '';
        var rating_whole = '';
        if (target !== 0) {
	        if (rating_comp == 1) {
	            rating = Math.round(actual / target * 100);
	        	rating_whole = actual / target * 100
	        } else {
	            rating = Math.round(target / actual * 100);
	        	rating_whole = target / actual * 100;
	        }
	    } else {
	    	var rating = 0;
        	var rating_whole = 0;
	    }

        var weighted_rating = rating_whole * weight / 100;

        $(parent).find('.fm_rating').val(rating);
        $(parent).find('.weighted_rating').val(weighted_rating.toFixed(4));

        $('.total_weighted_rating').val(sum_elem('weighted_rating').toFixed(4));
    });

    $('.weight').live('keyup',function() {
        var parent = $(this).closest('div.row');
        var weight = parseFloat($(this).val().replace(/,/g, ''));
        var actual = parseFloat($(parent).find('.actual').val().replace(/,/g, ''));
        var rating_comp = parseFloat($(parent).find('.rating-comp').val());
        var target = parseFloat($(parent).find('.target').val().replace(/,/g, ''));

        var rating = '';
        var rating_whole = '';
        if (target !== 0) {
	        if (rating_comp == 1) {
	            rating = Math.round(actual / target * 100);
	        	rating_whole = actual / target * 100
	        } else {
	            rating = Math.round(target / actual * 100);
	        	rating_whole = target / actual * 100;
	        }
	    } else {
	    	var rating = 0;
        	var rating_whole = 0;
	    }

        var weighted_rating = rating_whole * weight / 100;

        $(parent).find('.fm_rating').val(rating);
        $(parent).find('.weighted_rating').val(weighted_rating.toFixed(4));

        $('.total_weight').val(sum_elem('weight'));
    })

    $('.target').live('keyup',function() {
        var parent = $(this).closest('div.row');
        var weight = parseFloat($(parent).find('.weight').val().replace(/,/g, ''));
        var actual = parseFloat($(parent).find('.actual').val().replace(/,/g, ''));
        var rating_comp = parseFloat($(parent).find('.rating-comp').val());
        var target = parseFloat($(this).val().replace(/,/g, ''));

        var rating = '';
        var rating_whole = '';
        if (target !== 0) {
	        if (rating_comp == 1) {
	            rating = Math.round(actual / target * 100);
	        	rating_whole = actual / target * 100
	        } else {
	            rating = Math.round(target / actual * 100);
	        	rating_whole = target / actual * 100;
	        }
	    } else {
	    	var rating = 0;
        	var rating_whole = 0;
	    }

        var weighted_rating = rating_whole * weight / 100;

        $(parent).find('.fm_rating').val(rating);
        $(parent).find('.weighted_rating').val(weighted_rating.toFixed(4));

        $('.total_weighted_rating').val(sum_elem('weighted_rating').toFixed(4));
    })

    $('.rating-comp').live('change',function() {
        var parent = $(this).closest('div.row');
        var weight = parseFloat($(parent).find('.weight').val().replace(/,/g, ''));
        var actual = parseFloat($(parent).find('.actual').val().replace(/,/g, ''));
        var rating_comp = parseFloat($(this).val());
        var target = parseFloat($(parent).find('.target').val().replace(/,/g, ''));

        var rating = '';
        var rating_whole = '';
        if (target !== 0) {
	        if (rating_comp == 1) {
	            rating = Math.round(actual / target * 100);
	        	rating_whole = actual / target * 100
	        } else {
	            rating = Math.round(target / actual * 100);
	        	rating_whole = target / actual * 100;
	        }
	    } else {
	    	var rating = 0;
        	var rating_whole = 0;
	    }

        var weighted_rating = rating_whole * weight / 100;

        $(parent).find('.fm_rating').val(rating);
        $(parent).find('.weighted_rating').val(weighted_rating.toFixed(4));

        $('.total_weighted_rating').val(sum_elem('weighted_rating').toFixed(4));
    })

	// $('.weight').live('keyup', function() {
	// 	var total_weight = 0;
	//     $('.weight').each(function (index, element) {
	//         if ($(element).val() != '' && parseFloat($(element).val()) > 0) {
	//             total_weight += parseFloat($(element).val());
	//         }
	//     });

	//     // if( total_weight != 100 ){
	//     //     notify('error', 'Total Key Weight must be equal to 100');
	//     //     return false;
	//     // }    
	//     //$('#performance_financial_metric_planning-key_in_weight').val(total_weight);
	// });
});


function sum_elem(elem) {
	var total = 0;
    $('.'+elem+'').each(function(){
        total += parseFloat($(this).val());
    });

    return total;
}

function save_record( form, action, callback )
{
	if (validate()) {
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
								default:
									document.location = base_url + module.get('route');
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
}

function del_kpi_row() {
	$('.del_row_kpi').click(function() {
		$(this).closest('.row').remove();
	});
}

function validate() {
    var total_weight = 0;

    $('.weight').each(function(){
        total_weight += parseFloat($(this).val());
    });

    if( total_weight != 100 ){
        notify('error', 'Total Weight must be equal to 100');
        return false;
    }    
    else
    	return true;
}