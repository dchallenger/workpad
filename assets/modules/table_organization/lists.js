$(document).ready(function() {
	$('.select2me').select2({
	    placeholder: "Select an option",
	    allowClear: true
	});

	$('#filter').live('change', function() {
		if ($(this).val() == 3 || $(this).val() == 4) {
			$('.division_container').show();
			$('.department_container').hide();
			$('#department').val('');
		} else if ($(this).val() == 5) {
			$('.department_container').show();
			$('.division_container').hide();
			$('#division').val('');
		} else {
			$('.department_container').hide();
			$('.division_container').hide();
			$('#department').val('');
			$('#division').val('');
		}
		
		$(".div_dept").select2("val", "");
	});

	$('.generate_table_organization').live('click', function() {
		var filter = $('#filter').val();
		var division = $('#division').val();
		var department = $('#department').val();
		
		data = 'filter='+ filter +'&division='+division+'&department='+department;

		$.blockUI({ message: loading_message(), 
			onBlock: function(){
				$.ajax({
					url: base_url + module.get('route') + '/generate_organization',
					type:"POST",
					data: data,
					dataType: "json",
					async: false,
					success: function ( response ) {
						handle_ajax_message( response.message );

						if( typeof(response.html) != '' )
						{
							$('.table_organization_container').html(response.html);
						}
					}
				});
			}
		});
		$.unblockUI();			
	});
});