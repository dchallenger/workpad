$(document).ready(function(){
	if( $('#record_id').val() > 0 ){
		$('#sectionsDiv').show('fast');
	}

	get_sections();
});


function get_sections()
{
	$('#saved-sections').block({ message: '<div>Loading sections, please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />', 
		onBlock: function(){
			$.ajax({
				url: base_url + module.get('route') + '/get_sections',
				type:"POST",
				async: false,
				data: 'evaluation_template_id='+$('#record_id').val()+'&type=detail',
				dataType: "json",
				beforeSend: function(){
				},
				success: function ( response ) {
					handle_ajax_message( response.message );
					
					if( typeof(response.sections) != 'undefined' )
					{
						$('#saved-sections').html(response.sections);
					}
					
				}
			});
		}
	});
	$('#saved-sections').unblock();	
}