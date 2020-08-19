$(document).ready(function(){
	$('#performance_setup_library-status_id-temp').change(function(){
		if( $(this).is(':checked') )
			$('#performance_setup_library-status_id').val('1');
		else
			$('#performance_setup_library-status_id').val('0');
	});

	$('.add_library_value').click(function() {
		var html = '<div class="form-group">\
			<div class="col-md-5">\
				<input type="text" class="form-control" placeholder="Value" name="library_value[]">\
			</div>\
			<div class="col-md-6">\
				<textarea class="form-control" rows="3" placeholder="Description" name="library_value_description[]"></textarea>\
			</div>\
			<div class="col-md-1">\
				<div class="btn-group">\
				    <a href="javascript:void(0)" class="btn btn-danger btn-sm delete_row">\
				      	<i class="fa fa-trash-o"></i>\
				    </a>\
				</div>\
			</div>\
		</div>';

		$('.libary_value_container').append(html);
	});

	$('.delete_row').live('click',function() {
		$(this).closest('.form-group').remove();
	})
});