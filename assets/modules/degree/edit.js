$(document).ready(function(){
$('#users_education_degree_obtained-status_id-temp').change(function(){
	if( $(this).is(':checked') )
		$('#users_education_degree_obtained-status_id').val('1');
	else
		$('#users_education_degree_obtained-status_id').val('0');
});});