$(document).ready(function(){
	$('#users_compensation-status_id-temp').change(function(){
		if( $(this).is(':checked') )
			$('#users_compensation-status_id').val('1');
		else
			$('#users_compensation-status_id').val('0');
	});
});