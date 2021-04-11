$(document).ready(function(){
$('#users_education_school-status_id-temp').change(function(){
	if( $(this).is(':checked') )
		$('#users_education_school-status_id').val('1');
	else
		$('#users_education_school-status_id').val('0');
});});