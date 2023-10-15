$(document).ready(function () {
	$('.select2me').select2({
		placeholder: "Select an option",
		allowClear: true		
	});

	if ($('.wysihtml5').size() > 0) {
		$('.wysihtml5').wysihtml5({
			"font-styles": true, //Font styling, e.g. h1, h2, etc.
			"emphasis": true, //Italics, bold, etc.
			"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers.
			"html": false, //Button which allows you to edit the generated HTML.
			"link": false, //Button to insert a link.
			"image": false, //Button to insert an image.
			"color": false,
			"stylesheets": [""+base_url+"assets/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
		});
	}
});

$('#users_benefit-status_id-temp').change(function(){
	if( $(this).is(':checked') )
		$('#users_benefit-status_id').val('1');
	else
		$('#users_benefit-status_id').val('0');
});
