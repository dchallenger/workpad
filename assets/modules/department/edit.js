$('.select2me').select2({
    placeholder: "Select an option",
    allowClear: true
});

$('#users_department-status_id-temp').change(function(){
	if( $(this).is(':checked') )
		$('#users_department-status_id').val('1');
	else
		$('#users_department-status_id').val('0');
});