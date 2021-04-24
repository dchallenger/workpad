$(document).ready(function () {
    $('.close_training').live('click',function (e) {
        e.preventDefault();

        var status = $(this).data('status');
        var training_calendar_id = $(this).data('record_id');

        bootbox.confirm("Are you sure you want to close this training calendar?", function(confirm) {
            if( confirm )
            {
                var url = base_url + module.get('route') + '/close_calendar';
                var data = 'status=' + status + '&training_calendar_id=' + training_calendar_id;

                 $.ajax({
                    url: url,
                    dataType: 'json',
                    type:"POST",
                    data: data,
        			beforeSend: function(){
        				$('body').modalmanager('loading');
        			},
                    success: function (response) {
        				$('body').modalmanager('removeLoading');
                        
        				handle_ajax_message( response.message );

        				$('#record-list').infiniteScroll('search');
                    }
                });        
            }
        });                 
    });

    $('.cancel_training').live('click',function () {
        e.preventDefault();

        var status = $(this).data('status');
        var training_calendar_id = $(this).data('record_id');

        var url = base_url + module.get('route') + '/cancel_calendar';
        var data = 'status=' + status + '&training_calendar_id=' + training_calendar_id;

         $.ajax({
            url: url,
            dataType: 'json',
            type:"POST",
            data: data,
			beforeSend: function(){
				$('body').modalmanager('loading');
			},
            success: function (response) {
				$('body').modalmanager('removeLoading');
				handle_ajax_message( response.message );

				$('#record-list').infiniteScroll('search');
            }

        }); 
    });    
});