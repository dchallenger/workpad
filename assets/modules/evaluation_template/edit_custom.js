$(document).ready(function(){
	if( $('#record_id').val() > 0 ){
		$('#sectionsDiv').show('fast');
	}

	$('.add_section').click(function() {
		section_form();
	});

	get_sections();
});

function save_record( form, action, callback )
{
	$.blockUI({ message: saving_message(),
		onBlock: function(){

			var hasCKItem = form.find("textarea.ckeditor");

			if(hasCKItem && (typeof editor != 'undefined')){
				
				for ( instance in CKEDITOR.instances )
        			CKEDITOR.instances[instance].updateElement();
			}

			var data = form.find(":not('.dontserializeme')").serialize();
			$.ajax({
				url: base_url + module.get('route') + '/save',
				type:"POST",
				data: data,
				dataType: "json",
				async: false,
				success: function ( response ) {
					handle_ajax_message( response.message );

					if( response.saved )
					{
						if( response.action == 'insert' ){
							$('#record_id').val( response.record_id );
							$('#sectionsDiv').show('fast');
						}

						if (typeof(after_save) == typeof(Function)) after_save( response );
						if (typeof(callback) == typeof(Function)) callback( response );

						switch( action )
						{
							case 'new':
								document.location = base_url + module.get('route') + '/add';
								break;
						}
					}
				}
			});
		},
		baseZ: 300000000
	});
	$.unblockUI();
}

var headeditor = null;
var footeditor = null;
function section_form( section_id = '')
{
	$.ajax({
		url: base_url + module.get('route') + '/get_section_form',
		type:"POST",
		async: false,
		dataType: "json",
		data: 'template_id='+$('#record_id').val()+'&section_id='+section_id,
		success: function ( response ) {
			if( typeof(response.section_form) != 'undefined' )
			{
				$('.modal-container').attr('data-width', '800');
				$('.modal-container').html(response.section_form);
				$('.modal-container').modal();
				//init_section_type_change();
				//$(":input").inputmask();
				//headeditor = CKEDITOR.replace( 'header' );
				//footeditor = CKEDITOR.replace( 'footer' );
			}	
		}
	});
}


function save_section()
{
	$.blockUI({ message: '<div>Saving section, please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />', 
		onBlock: function(){
			$.ajax({
				url: base_url + module.get('route') + '/save_section',
				type:"POST",
				async: false,
				data: $('#section-form').serialize(),
				dataType: "json",
				beforeSend: function(){
				},
				success: function ( response ) {
					handle_ajax_message( response.message );
					if(response.close_modal)
						$('.modal-container').modal('hide');	

					get_sections();
				}
			});
		},
		baseZ: 20000
	});
	$.unblockUI();
}

function get_sections()
{
	$('#saved-sections').block({ message: '<div>Loading sections, please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />', 
		onBlock: function(){
			$.ajax({
				url: base_url + module.get('route') + '/get_sections',
				type:"POST",
				async: false,
				data: 'evaluation_template_id='+$('#record_id').val()+'&type=edit',
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

function delete_section( template_section_id )
{
	bootbox.confirm("Are you sure you want to delete section?", function(confirm) {
		if( confirm )
		{
			$.blockUI({ message: '<div>Deleting, please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />', 
				onBlock: function(){
					$.ajax({
						url: base_url + module.get('route') + '/delete_section',
						type:"POST",
						async: false,
						dataType: "json",
						data: 'template_section_id='+template_section_id,
						success: function ( response ) {
							handle_ajax_message( response.message );
							get_sections();
						}
					});
				}
			});
			$.unblockUI();
		}
	});
}