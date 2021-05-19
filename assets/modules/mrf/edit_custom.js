$(document).ready(function(){
	$('#plan_code').select2({
	    placeholder: "Select an option",
	    allowClear: true
	});	

    $('.yes_no').change(function(){
        if( $(this).is(':checked') ) {
            $(this).parent().parent().find('.yes_no_val').val('1');
        } else {
            $(this).parent().parent().find('.yes_no_val').val('0');
        }
    });	

	if ($('.wysihtml5').size() > 0) {
		$('.wysihtml5').wysihtml5({
			"stylesheets": ["assets/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
		});
	
		$('input[name="_wysihtml5_mode"]').addClass('dontserializeme');
	}

	if (jQuery().infiniteScroll){
		create_list();

		$('form#list-search').submit(function( event ) {
			event.preventDefault();
			create_list();
		});	
	}

	$('.filter-type').click(function(){
		$('.filter-type').removeClass('label-success');
		$('.filter-type').addClass('label-default');
		$(this).removeClass('label-default');
		$(this).addClass('label-success')
		create_list();
	});
	$('.filter-status').click(function(){
		$('.filter-status').removeClass('label-success');
		$('.filter-status').addClass('label-default');
		$(this).removeClass('label-default');
		$(this).addClass('label-success')
		create_list();
	});

	$('#recruitment_request-budgeted').change(function() {
		if ($(this).val() == 0) {
			$('.purpose').hide();
			$('.mrf_plan_code').hide();
			$("#recruitment_request-position_id").select2("val", "");
			$("#recruitment_request-employment_status_id").select2("val", "");
			$('#recruitment_request-date_needed').val("");
			$('#recruitment_request-quantity').val("");			
		} else {
			$('.purpose').show();
			$('.mrf_plan_code').show();
		}
	});

	$('#recruitment_request-budgeted').trigger('change');

	$('.course').live('change',function() {
		if ($(this).val() == 99999)
			$('.others_course').show()
		else {
			$('.others_course').val('');
			$('.others_course').hide();
		}
	});

	$('.course').trigger('change');

	if( $('#recruitment_request-department_id').val() ){
		get_dept_immediate( $('#recruitment_request-department_id').val() );
	}

	$('#recruitment_request-department_id').change(function(){
		get_plan_code($(this).val());
		get_dept_immediate( $(this).val() );
	});

	$('#recruitment_request-division_id').change(function(){
		get_div_immediate( $(this).val() );
	});

	show_hide_contract_duration( $('#recruitment_request-employment_status_id').val() );
	$('#recruitment_request-employment_status_id').change(function(){
		show_hide_contract_duration( $(this).val() );
	});

/*	show_hide_budget_from_to( $('#recruitment_request-budgeted').val() );
	$('#recruitment_request-budgeted').change(function(){
		show_hide_budget_from_to( $(this).val() );
	});
*/
	$('#recruitment_request-nature_id').trigger('change');
	
	if($('#recruitment_request-nature_id').val() == ''){
		$('.replacement_of').hide();
		$('.due_to').hide();	
	}else{
		if($('#recruitment_request-nature_id').val() == 5){
			$('.replacement_of').show();
			$('.due_to').show();
		}else{
			$('.replacement_of').hide();
			$('.due_to').hide();
		}
	}

	$('#recruitment_request-nature_id').change(function(){
		var nature_id = $(this).val();
		if(nature_id == 5){
			$('.replacement_of').show();
			$('.due_to').show();
		}else{
			$('.replacement_of').hide();
			$('.due_to').hide();
		}
	});


	$('#recruitment_request-due_to_id').trigger('change');
	
	if($('#recruitment_request-due_to_id').val() == ''){
		$('.location').hide();
		$('.date_from').hide();	
		$('.date_to').hide();	
	}else{
		if($('#recruitment_request-due_to_id').val() == 4){
			$('.date_from').hide();	
			$('.date_to').hide();				
			$('.location').show();
		}else if ($('#recruitment_request-due_to_id').val() == 5){
			$('.date_from').show();	
			$('.date_to').show();				
			$('.location').hide();
		}else{
			$('.location').hide();
			$('.date_from').hide();	
			$('.date_to').hide();				
		}
	}

	$('#recruitment_request-due_to_id').change(function(){
		var due_to_id = $(this).val();
		if(due_to_id == 4){
			$('.location').show();
			$('.date_from').hide();	
			$('.date_to').hide();
		}else if ($('#recruitment_request-due_to_id').val() == 5){
			$('.date_from').show();	
			$('.date_to').show();				
			$('.location').hide();
		}else{
			$('.location').hide();
			$('.date_from').hide();	
			$('.date_to').hide();	
		}
	});

	if (jQuery().inputmask){
		$(".mask_number").inputmask('decimal', {
	        groupSeparator: ",", 
	        digits: 2,
	        autoGroup: true,
	        numericInput: true,
	        rightAlignNumerics: false
        
        });
	}

	$('#plan_code').live('change',function() {
		if ($('#recruitment_request-budgeted').val() == 1) {
			$.ajax({
				url: base_url + module.get('route') + '/get_plan_details',
				type:"POST",
				async: false,
				data: {plan_code : $(this).val()},
				dataType: "json",
				beforeSend: function(){
				},
				success: function ( response ) {
					if (response.checker == 'success') {
						$("#recruitment_request-position_id").select2("val", response.position_id);
						$("#recruitment_request-employment_status_id").select2("val", response.employment_status_id);
						$('#recruitment_request-date_needed').val(response.date_needed);
						$('#recruitment_request-quantity').val(response.needed);
					}
					else {
						$("#recruitment_request-position_id").select2("val", "");
						$("#recruitment_request-employment_status_id").select2("val", "");
						$('#recruitment_request-date_needed').val("");
						$('#recruitment_request-quantity').val("");							
					}
				}
			});		
		}		
	});
});

function show_hide_contract_duration(employment_status_id){
	if( employment_status_id == 4 || employment_status_id == 5 || employment_status_id == 6
		){
		$('#contract_duration').removeClass('hidden');
	}else{
		$('#contract_duration').addClass('hidden');
	}
}

function show_hide_budget_from_to(budgeted){
	update_nature_req(budgeted);
	if( budgeted == 2 ){
		$('.change_plan').removeClass('hidden');
	}else{
		$('.change_plan').addClass('hidden');
	}
	// if(budgeted == 0){
	// 	$('.replacement_of').show();
	// }else{
	// 	$('.replacement_of').show();
	// }
}

function update_nature_req(budgeted)
{
	$.ajax({
	    url: base_url + module.get('route') + '/update_nature_req',
	    type: "POST",
	    async: false,
		data: {budgeted: budgeted, record_id : $('#record_id').val()},
	    dataType: "json",
	    beforeSend: function () {
	    },
	    success: function (response) {
	    	$('#recruitment_request-nature_id').html(response.natures);
    		// $("#dept_loader").hide();
    		// $("#department_div").show();
	    	// $('select[name="user_id"]').html('');
	    }
	});		
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function get_dept_immediate(dept_id){
	var data = {
		dept_id: dept_id
	};
	$.ajax({
		url: base_url + module.get('route') + '/get_dept_immediate',
		type:"POST",
		async: false,
		data: data,
		dataType: "json",
		beforeSend: function(){
		},
		success: function ( response ) {

			if( typeof(response.retrieved_immediate) != 'undefined' )
			{	
				$('#recruitment_request-immediate').val(response.immediate);
			}else{
				$('#recruitment_request-immediate').val('');
			}
		}
	});	
}

function get_div_immediate(div_id){
	var data = {
		div_id: div_id
	};
	$.ajax({
		url: base_url + module.get('route') + '/get_div_immediate',
		type:"POST",
		async: false,
		data: data,
		dataType: "json",
		beforeSend: function(){
		},
		success: function ( response ) {

			if( typeof(response.retrieved_immediate) != 'undefined' )
			{	
				$('#recruitment_request-div_head').val(response.immediate);
			}else{
				$('#recruitment_request-div_head').val('');
			}
		}
	});	
}

function get_plan_code(dept_id){
	var data = {
		dept_id: dept_id
	};
	$.ajax({
		url: base_url + module.get('route') + '/get_plan_code',
		type:"POST",
		async: false,
		data: data,
		dataType: "json",
		beforeSend: function(){
		},
		success: function ( response ) {
			$('#plan_code').html(response.plan_code);
			$('#plan_code').select2({
			    placeholder: "Select an option",
			    allowClear: true
			});			
		}
	});	
}

function create_list()
{
	var search = $('input[name="list-search"]').val();
	
	var filter_by = {
		hiring_type: $('.filter-type.label-success').attr('filter_value'),
		status_id: $('.filter-status.label-success').attr('filter_value'),
	}

	var filter_value = $('.list-filter.active').attr('filter_value');

	$('#record-list').empty().die().infiniteScroll({
		dataPath: base_url + module.get('route') + '/get_list',
		itemSelector: 'tr.record',
		onDataLoading: function(){ 
			$("#loader").show();
			$("#no_record").hide();
		},
		onDataLoaded: function(page, records){ 
			$("#loader").hide();
			
			if( page == 0 && records == 0)
			{
				$("#no_record").show();
			}
		},
		onDataError: function(){ 
			return;
		},
		search: search,
		filter_by: filter_by,
		filter_value: filter_value
	});
}

function save_record( form, status_id, status )
{

    bootbox.confirm("Are you sure you want to "+status+" this request?", function(confirm) {
        if( confirm )
        {
        	$.blockUI({ message: saving_message(),
        		onBlock: function(){

        			var data = form.find(":not('.dontserializeme')").serialize();
        			$.ajax({
        				url: base_url + module.get('route') + '/save',
        				type:"POST",
        				data: data + '&recruitment[status_id]='+status_id,
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
    });
}