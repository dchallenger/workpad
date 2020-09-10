$(document).ready(function(){
	$('#users_sbu_unit-status_id-temp').change(function(){
		if( $(this).is(':checked') )
			$('#users_sbu_unit-status_id').val('1');
		else
			$('#users_sbu_unit-status_id').val('0');
	});
});