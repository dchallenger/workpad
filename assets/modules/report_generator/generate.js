$(document).ready(function(){
	init_filter_ui();
});

function init_filter_ui()
{
	//init date pickers
	$('input').each(function(){
	  $(this).parent('.date-picker').datepicker({
	        rtl: App.isRTL(),
	        autoclose: true
	    });
	});

	$('input.dtp').datetimepicker({
	    isRTL: App.isRTL(),
	    format: "dd MM yyyy - hh:ii",
	    autoclose: true,
	    todayBtn: true,
	    pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left"),
	    minuteStep: 1
	});

	$('input.timepicker-default').timepicker({
        autoclose: true,
        showSeconds: true,
        minuteStep: 1,
        secondStep: 1
    });

/*    $('.multiple_dropdown_tags').select2({
        placeholder: "Select...",
        allowClear: true
    });*/

	var company = '';
	var division = '';
	var department = '';
	var employment_type = '';
	$('#company,#division,#department,#employment_type').change(function(){
		company = $('#company').val();
		division = $('#division').val();
		department = $('#department').val();
		employment_type = $('#employment_type').val();

		var filter = {company:company,division:division,department:department,employment_type:employment_type};

		update_user_filter(filter);
	});

    //$('.multiple_dropdown_tags').multiselect({});

    $(".multiple_dropdown_tags").multiselect({
        selectedList: 1
    }).multiselectfilter();	
/*    $('.ui-multiselect').css('width', '280px');
    $('.ui-multiselect-menu').css('width', '280px');*/
}

function update_department( company_id )
{
	if( company_id != "" )
	{
		$("#list-table").hide();
		$('select[name="department_id"]').select2("val","");
		$('select[name="user_id"]').select2("val","");
		$.ajax({
		    url: base_url + module.get('route') + '/update_department',
		    type: "POST",
		    async: false,
		    data: {company_id: company_id},
		    dataType: "json",
		    beforeSend: function () {
	    		// $("#dept_loader").show();
	    		// $("#department_div").hide();
		    },
		    success: function (response) {
		    	$('#department').html(response.departments);
	    		// $("#dept_loader").hide();
	    		// $("#department_div").show();
		    	// $('select[name="user_id"]').html('');
		    }
		});	
	}
	else{
		$('select[name="department_id"]').html('');
	}		
}

function update_user_filter( filter='' )
{
	if( filter != "" )
	{
		$.ajax({
		    url: base_url + module.get('route') + '/update_user_filter',
		    type: "POST",
		    async: false,
		    data: filter,
		    dataType: "json",
		    beforeSend: function () {
	    		// $("#dept_loader").show();
	    		// $("#department_div").hide();
		    },
		    success: function (response) {
		    	if ($('#full_name').length) {
			    	$('#full_name').html(response.users);
			    	$('#full_name').multiselect("refresh");
		    	}
		    }
		});	
	}	
}

function export_to( form, file )
{
	$.blockUI({ message: '<div>'+lang.common.processing_message+'</div><img src="'+root_url+'assets/img/ajax-loading.gif" />', 
		onBlock: function(){
			$.ajax({
				url: base_url + module.get('route') + '/export',
				type:"POST",
				dataType: "json",
				data: form.serialize() + '&file='+file,
				async: false,
				success: function ( response ) {
					if( response.filename != undefined )
					{
						window.open( root_url + response.filename );
					}
					handle_ajax_message( response.message );
				}
			});
		}
	});
	$.unblockUI();	
}

function export_custom( form, file )
{
	$.blockUI({ message: '<div>'+lang.common.processing_message+'</div><img src="'+root_url+'assets/img/ajax-loading.gif" />', 
		onBlock: function(){
			$.ajax({
				url: base_url + module.get('route') + '/export_custom',
				type:"POST",
				dataType: "json",
				data: form.serialize() + '&file='+file + '&get_result=true',
				async: false,
				success: function ( response ) {
					if( response.filename != undefined )
					{
						window.open( root_url + response.filename );
					}
					handle_ajax_message( response.message );
				}
			});
		}
	});
	$.unblockUI();	
}