$(document).ready(function(){
	$('#performance_financial_metric_planning-user_ids').multiselect();
	$('#performance_financial_metric_planning-financial_metric_kpi_ids').multiselect();

	$('#performance_financial_metric_planning-financial_metric_kpi_ids').change(function() {
        $("#performance_financial_metric_planning-financial_metric_kpi_ids option").each(function(){
            var optionValue = $(this).val();
            var optionText = $(this).text();

			if ($("#performance_financial_metric_planning-financial_metric_kpi_ids option[value="+optionValue+"]:selected").length > 0) {
	            var html = '<div class="row" data-kpi="'+optionText+'">\
					<div class="col-md-4">\
						<div class="">\
							<label class="control-label"><span class="required">* </span>Key Performance Indicators / Measures</label>\
							<input type="text" class="form-control" name="" id="performance_financial_metric_planning-key_in_weight" value="'+optionText+'" readonly/>\
							<input type="hidden" class="form-control" name="performance_financial_metric_planning[kpi][]" value="'+optionValue+'"/>\
						</div>\
					</div>\
					<div class="col-md-4">\
						<div class="">\
							<label class="control-label">% Weight</label>\
							<input type="text" class="form-control weight" name="performance_financial_metric_planning[weight][]" value="" placeholder="Enter Weight" />\
						</div>\
					</div>\
					<div class="col-md-4">\
						<div class="">\
							<label class="control-label"><span class="required">* </span>Target </label>\
							<input type="text" class="form-control" name="performance_financial_metric_planning[target][]" value="" placeholder="Enter Target" />\
						</div>\
					</div>\
				</div>';

				if ($("div.row[data-kpi='" + optionText +"']").length < 1)
					$('#kpi_container').append(html);
    		} else {
    			if ($("div.row[data-kpi='" + optionText +"']").length > 0)
    				$("div.row[data-kpi='" + optionText +"']").remove();
    		}
            // collect all values
            //selections.push(optionValue);
        });
	})

	$('#performance_financial_metric_planning-planning_id').select2({
	    placeholder: "Select an option",
	    allowClear: true
	});

	$('.weight').live('keyup', function() {
		var total_weight = 0;
	    $('.weight').each(function (index, element) {
	        if ($(element).val() != '' && parseFloat($(element).val()) > 0) {
	            total_weight += parseFloat($(element).val());
	        }
	    });
	    $('#performance_financial_metric_planning-key_in_weight').val(total_weight);
	});
});

function save_record( form, action, callback )
{
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