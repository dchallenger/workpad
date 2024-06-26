$(document).ready(function(){
	$(":input").inputmask();

	$('.financial_metric').select2({
	    placeholder: "Select Financial Metric Title",
	    allowClear: true
	});

    $('#individual_planning_appraisee_acceptance_tmp').change(function() {
    	if( $(this).is(':checked') )
    		$('#individual_planning_appraisee_acceptance').val('1');
    	else
    		$('#individual_planning_appraisee_acceptance').val('0');
    });	

    $('.key_weight').trigger('keyup');
	//get_section_items();
});

function view_transaction_logs( planning_id, user_id )
{
	$.blockUI({ message: loading_message(),
		onBlock: function(){
			var data = {
				planning_id: planning_id,
				user_id:user_id
			};
			$.ajax({
				url: base_url + module.get('route') + '/view_transaction_logs',
				type:"POST",
				data: data,
				dataType: "json",
				async: false,
				success: function ( response ) {
					handle_ajax_message( response.message );

					if( typeof(response.trans_logs) != 'undefined' )
					{
						$('.modal-container').attr('data-width', '800');
						$('.modal-container').html(response.trans_logs);
						$('.modal-container').modal();
					}
				}
			});
		},
		baseZ: 300000000
	});
	$.unblockUI();
}

function add_item( column_id, item_id = 0, parent_id, section_id, elem )
{
    $('tbody.section-'+section_id).block({ message: '<div>Loading section items, please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />',
        onBlock: function(){
            var data = {
                planning_id: $('input[name="planning_id"]').val(),
                user_id: $('input[name="user_id"]').val(),
                template_id: $('input[name="template_id"]').val(),
                section_id: section_id,
                parent_id: parent_id,
                item_id: item_id
            };

            $.ajax({
                url: base_url + module.get('route') + '/get_section_items',
                type:"POST",
                data: data,
                dataType: "json",
                async: true,
                success: function ( response ) {
                    handle_ajax_message( response.message );
                    if (!parent_id){
                        $('tbody.section-'+section_id).find('tr.markings').before( response.items );
                    }
                    else{
                        $(elem).closest('tr').after(response.items);
                        $(elem).parent('span').remove();                        
                    }
                    calc_weight();

                    if( !response.show_add_row )
                    {
                        $('button.add-kra-'+response.section_column_id).closest('tr').addClass('hidden');
                    }
                    else{
                        $('button.add-kra-'+response.section_column_id).closest('tr').removeClass('hidden');
                    }
                    $('tbody.section-'+section_id).unblock();
                }
            });
        },
        baseZ: 300000000
    }); 
}

function save_item()
{
	$.blockUI({ message: '<div>Saving, please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />',
		onBlock: function(){			
			save_form($("#planning-form"), 1);
			$.ajax({
				url: base_url + module.get('route') + '/save_item',
				type:"POST",
				data: $('form#item-form').serialize(),
				dataType: "json",
				async: false,
				success: function ( response ) {
					handle_ajax_message( response.message );
					if(response.close_modal)
						$('.modal-container').modal('hide');
					get_items( $('form#item-form input[name="section_column_id"]').val() );

					if( !response.show_add_row )
					{
						$('button.add-kra-'+response.section_column_id).closest('tr').addClass('hidden');
					}
					else{
						$('button.add-kra-'+response.section_column_id).closest('tr').removeClass('hidden');
					}
				}
			});
		},
		baseZ: 300000000
	});
	$.unblockUI();	
}

function get_items( column_id )
{
	$.blockUI({ message: '<div>Reloading section items, please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />',
		onBlock: function(){
			var data = {
				planning_id: $('input[name="planning_id"]').val(),
				user_id: $('input[name="user_id"]').val(),
				template_id: $('input[name="template_id"]').val(),
				column_id: column_id
			};
			$.ajax({
				url: base_url + module.get('route') + '/get_items',
				type:"POST",
				data: data,
				dataType: "json",
				async: false,
				success: function ( response ) {
					handle_ajax_message( response.message );
					$('tbody.section-'+response.section_id + ' tr:not(.first-row)').each(function(){
						$(this).remove();
					});
					$('tbody.section-'+response.section_id).prepend( response.items );
					calc_weight();
				}
			});
		},
		baseZ: 300000000
	});
	$.unblockUI();
}

function get_section_item( section_id )
{
	$('tbody.section-'+section_id).block({ message: '<div>Loading section items, please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />',
		onBlock: function(){
			var data = {
				planning_id: $('input[name="planning_id"]').val(),
				user_id: $('input[name="user_id"]').val(),
				template_id: $('input[name="template_id"]').val(),
				section_id: section_id
			};

			$.ajax({
				url: base_url + module.get('route') + '/get_section_items',
				type:"POST",
				data: data,
				dataType: "json",
				async: true,
				success: function ( response ) {
					handle_ajax_message( response.message );
					$('tbody.section-'+section_id + ' tr:not(.first-row)').each(function(){
						$(this).remove();
					});
					$('tbody.section-'+section_id).prepend( response.items );
					calc_weight();

					if( !response.show_add_row )
					{
						$('button.add-kra-'+response.section_column_id).closest('tr').addClass('hidden');
					}
					else{
						$('button.add-kra-'+response.section_column_id).closest('tr').removeClass('hidden');
					}
					$('tbody.section-'+section_id).unblock();
				}
			});
		},
		baseZ: 300000000
	});	
}

function calc_weight()
{
	$('tbody.get-section').each(function(){
		var $this = $(this);
		var total = 0;
		$this.find('input.weight').each(function(){
			$(this).stop().change(function(){
				calc_weight();	
			});
			total = total + parseFloat( $(this).val() );
		});

		if( !isNaN(total) )
			$(this).find('input#total-weight').val( round(total,2) );
	});
}

function get_section_items()
{
	$('tbody.get-section').each(function(){
		var section_id = $(this).attr('section');
		get_section_item(section_id);
	});
}

function delete_item( item_id )
{
	bootbox.confirm("Are you sure you want to delete this item?", function(confirm) {
		if( confirm )
		{
			save_form($("#planning-form"), 1);
			$.blockUI({ message: '<div>Deleting, please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />', 
				onBlock: function(){
					$.ajax({
						url: base_url + module.get('route') + '/delete_item',
						type:"POST",
						async: false,
						data: {item_id:item_id},
						dataType: "json",
						success: function ( response ) {
							get_section_items()		
						}
					});
				}
			});
			$.unblockUI();
		}
	});
}

function change_status(form, status_id)
{
	if (validate()) {

	    if (status_id == 2) {
	    	var validation = {};
	    	var ctr = 1;

	    	$('.kpi').each(function (index, element) {
	    		var kpi_val = $(this).val();
	    		var score_card = $(this).data('score-card');
				var weight_val = $(this).closest('tr').find('.weight').val();

	    		if (kpi_val == "" && (weight_val > 0 && weight_val != '')) {
	                validation[ctr] = {};
	                validation[ctr]['type'] = "error";
	                validation[ctr]['message'] = 'Under "'+score_card+'" KPI should not blank';
	                ctr++;
	    		}
	    	});

	    	$('.target').each(function (index, element) {
	    		var target_val = $(this).val();
	    		var score_card = $(this).data('score-card');
	    		var weight_val = $(this).closest('tr').find('.weight').val();

	    		if (target_val == "" && (weight_val > 0 && weight_val != '')) {
	                validation[ctr] = {};
	                validation[ctr]['type'] = "error";
	                validation[ctr]['message'] = 'Under "'+score_card+'" Target should not blank';
	                ctr++
	    		}
	    	});

	        if (!$.isEmptyObject(validation)) {
	            handle_ajax_message( validation );
	            return false;
	        }	    	
	    }

		validation = 1;
		$.blockUI({ message: '<div>Saving, please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />',
			onBlock: function(){
				var data = form.find(":not('.dontserializeme')").serialize() 
				+ '&status_id='+status_id + 
				'&validation='+validation;
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
							window.location = response.redirect;
					}
				});
			},
			baseZ: 300000000
		});
		$.unblockUI();	
	}
}

function save_form(form, status_id)
{
	validation = 0;
	form.find('input[name="status_id"]').val(status_id);
	$.blockUI({ message: '<div>Saving, please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />',
		onBlock: function(){
			var data = form.find(":not('.dontserializeme')").serialize() 
			+'&validation='+validation;
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

					// if(response.redirect)
					// 	window.location = response.redirect;
				}
			});
		},
		baseZ: 300000000
	});
	$.unblockUI();	
}

function for_discussion( form, status_id )
{
	$.ajax({
	    url: base_url + module.get('route') + '/get_notes',
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

	        	/*$('#greetings_dialog').html(response.greetings);
				$('#greetings_dialog').modal('show');	*/            
	        }
	        handle_ajax_message( response.message );
	    }
	});
}

function init_notes()
{
	$('#note-form').stop().submit(function(e){
		e.preventDefault();
		add_note();
	});
}

function add_note()
{
	$.blockUI({ message: '<div>Loading notes, please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />',
		onBlock: function(){
			$.ajax({
				url: base_url + module.get('route') + '/save_note',
				type:"POST",
				data: $('#discussion-form').serialize() +'&'+$('#note-form').serialize() 
				+'&'+ $('#planning-form').find(":not('.dontserializeme')").serialize()
				+ '&validation=1',
				dataType: "json",
				async: false,
				success: function ( response ) {
					handle_ajax_message( response.message );
					submitDiscussion();
					//console.log(response.weight_error);
					if(!response.weight_error){
						window.location = response.redirect;
					}
				}
			});		
		},
		baseZ: 300000000
	});
	$.unblockUI();
}


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

	        	/*$('#greetings_dialog').html(response.greetings);
				$('#greetings_dialog').modal('show');	*/            
	        }
	        handle_ajax_message( response.message );
	    }
	});
}

//for oclp
$(document).on('change', '.upload_appraisal_planning', function (e) {
	e.preventDefault();

	var data = {
		appraisee_user_id: $('.appraisee_user_id').val(),
		planning_id: $(this).val(),
		section_id: $(this).data('section_id')
	};

	if ($(this).val() != '') {
		bootbox.confirm('Are you sure you want to upload "' + $("option:selected").text() + '" performance planning?', function(confirm) {
			if( confirm )
			{
				$.blockUI({ message: '<div>Updating content, please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />', 
					onBlock: function(){
						$.ajax({
							url: base_url + module.get('route') + '/populate_appraisal_planning',
							type:"POST",
							data: data,
							dataType: "json",
							async: false,
							success: function ( response ) {
								handle_ajax_message( response.message );

								$('.kra-section').html(response.items);
							}
						});
					}
				});
				$.unblockUI();
			}
		});	
	}
});

$(document).on('change', '.financial_metric', function (e) {
	e.preventDefault();

	var data = {
		financial_metric_ids: $(this).val(),
		section_id: $(this).data('section_id')
	};

	if ($(this).val() != null) {
		bootbox.confirm('Are you sure you want to load Financial Metrics?', function(confirm) {
			if( confirm )
			{
				$.blockUI({ message: '<div>Updating content, please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />', 
					onBlock: function(){
						$.ajax({
							url: base_url + module.get('route') + '/populate_financial_metric',
							type:"POST",
							data: data,
							dataType: "json",
							async: false,
							success: function ( response ) {
								handle_ajax_message( response.message );

								$('.fmt').remove();
								$('tbody.get-section').prepend(response.items);
							}
						});
					}
				});
				$.unblockUI();
			}
		});	
	}
});

$(document).on('keypress', '#discussion_notes', function (e) {	
    if (e.which == 13) {
    	e.preventDefault();
        submitDiscussion();
    } else return;
});

$(document).on('click', '.add_row', function (e) {
	e.preventDefault();

	var data = {
		section_id: $(this).data('section_id'),
		scorecard_id: $(this).data('scorecard_id')
	};

	var elem = $(this);
	var question = $(this).data('num_question');

    $.ajax({
        url: base_url + module.get('route') + '/add_row',
        type:"POST",
        data: data,
        dataType: "json",
        async: true,
        success: function ( response ) {
            handle_ajax_message( response.message );

            if ($('.'+question+'').length > 0)
            	$('.'+question+'').before(response.items);
            else
            	$(elem).closest('tr').after(response.items);

            $(":input").inputmask();
            // calc_weight();
        }
    });
});

$(document).on('click', '.delete_row', function (e) {
	e.preventDefault();

	$(this).closest('tr').remove();
});


$(document).on('keyup', '.weight', function (e) {
	e.preventDefault();

    var question = $(this).attr('question');
    var total_weight_average = 0;
    $('.weight[question='+question+']').each(function (index, element) {
        if ($(element).val() != '') {
            total_weight_average += parseFloat($(element).val());
        }   
    })
    $('.key_weight[question='+question+']').val(total_weight_average);  

    $('.key_weight').trigger('keyup');
});

$(document).on('keyup', '.key_weight', function (e) {
	e.preventDefault();

    var scorecard_id = $(this).attr('question');

    if ($(this).val() != '')
    	$('.key_weight_total_'+scorecard_id).html(parseFloat($(this).val()));
});

$(document).on('click', '.add_idp', function (e) {
	e.preventDefault();

	var data = {
		section_id: $(this).data('section_id'),
		scorecard_id: $(this).data('scorecard_id')
	};

	var elem = $(this);

    $.ajax({
        url: base_url + module.get('route') + '/add_idp',
        type:"POST",
        data: data,
        dataType: "json",
        async: true,
        success: function ( response ) {
            handle_ajax_message( response.message );
			
			$('tbody.idp').append(response.items);

            $(":input").inputmask();
        }
    });
});

$(document).on('click', '.delete_idp', function (e) {
	e.preventDefault();

	$(this).closest('tr').remove();
});

//end for oclp

$(document).on('click', '#discussion_notes_btn', function (e) {
    e.preventDefault();
    submitDiscussion();
});

var submitDiscussion = function () {
    if (!$("#discussion_notes").val().trim()) {
        $("#discussion_notes").focus();
        return false;
    };

    var data = {
        discussion_notes: $("#discussion_notes").val(),
        message_type: $("#message_type").val(),
        user_id: $("#user_id").val()
    };
    
	$.blockUI({ message: '<div>Loading notes, please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />',
		onBlock: function(){
			$.ajax({
		        url: base_url + module.get('route') + '/submitDiscussion',
		        type: "POST",
		        async: false,
		        data: $('#discussion-form').serialize() ,
		        dataType: "json",
		        beforeSend: function () {

		            $("#discussion_notes").attr('disabled', true);
		            $("#icn-greetings-update").removeClass().addClass('fa fa-spinner icon-spin');
		        },
		        success: function (response) {
		            setTimeout(function () {

		                $("#discussion_notes").val('');
		                $("#discussion_notes").attr('disabled', false);

		                if (typeof (response.new_discussion) != 'undefined') {

		                    $(".discussions").prepend(response.new_discussion).fadeIn();
		                    // $('.greetings_container li.no-greetings').remove();
		                    
		                }

		            }, 1000);

		            $.unblockUI();

		            for (var i in response.message) {
		                if (response.message[i].message != "") {
		                    notify(response.message[i].type, response.message[i].message);
		                }
		            }
		        }
		    });
		},
		baseZ: 300000000
	});
	$.unblockUI();
}

function crowdsource_draft(section_id)
{
	var data = {
		planning_id: $('input[name="planning_id"]').val(),
		user_id: $('input[name="user_id"]').val(),
		section_id: section_id
	};

	$.blockUI({ message: loading_message(),
		onBlock: function(){
			$.ajax({
		        url: base_url + module.get('route') + '/get_crowdsource_draft',
		        type: "POST",
		        async: false,
		        data: data,
		        dataType: "json",
		        success: function (response) {
		        	handle_ajax_message( response.message ); 

		        	if( typeof(response.form) != 'undefined' )
					{
						$('.modal-container').attr('data-width', '700');
						$('.modal-container').html(response.form);
						$('.modal-container').modal();
						init_tags();
					}  
		        }
		    });
		},
		baseZ: 300000000
	});
	$.unblockUI();	
}

function validate() {
    var total_key = 0;

    $('.key_weight').each(function(){
        total_key += parseFloat($(this).val());
    });

    if( total_key != 100 ){
        notify('error', 'Total Key Weight must be equal to 100');
        return false;
    }    
    else
    	return true;
}