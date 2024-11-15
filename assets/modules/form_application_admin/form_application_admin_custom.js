$(document).ready(function(){
    $('#time_forms-datetime_from,#time_forms-datetime_to,#time_forms-date_to').live('change',function(e){
        var focus_date = Date.parse($('#time_forms-focus_date').val());
        if ($('#time_forms-date_to').length > 0){
            var date_from = Date.parse($('#time_forms-date_to').val());
            var date_to = Date.parse($('#time_forms-date_to').val());
        }
        else{
            var date_from = Date.parse($('#time_forms-datetime_from').val());
            var date_to = Date.parse($('#time_forms-datetime_to').val());
        }

        var no_days_before = dateDiff(focus_date,date_from,'days');
        var no_days_after = dateDiff(focus_date,date_to,'days');

        if ((focus_date < date_from) && no_days_before > 1){
            $('#time_forms-focus_date').val('')
            notify('error', 'Focus date should less than or equal to 1 day');
        }

        if ((focus_date > date_to) && no_days_after > 1){
            $('#time_forms-focus_date').val('')
            notify('error', 'Focus date should less than or equal to 1 day');
        }  
    });

    if (jQuery().infiniteScroll){
        $('#form-list').infiniteScroll({
            dataPath: base_url + module.get('route') + '/get_list',
            itemSelector: 'tr.record',
            onDataLoading: function(){ 
                $("#loader").show();
            },
            onDataLoaded: function(x, y, z){ 
                $("#loader").hide();

                if( x <= 0 ){
                    $('.well').show();
                }
                else{
                    $('.well').hide();
                }

                initPopup();

            },
            onDataError: function(){ 
                return;
            },
            search: $('input[name="list-search"]').val()
        });

        $('form#list-search').submit(function( event ) {
            event.preventDefault();
            $('#form-list').infiniteScroll('search');
        }); 

        $('form#list-search-mobile').submit(function( event ) {
                event.preventDefault();
                $('input[name="list-search"]').val( $('input[name="list-search-mobile"]').val() );
                $('#form-list').infiniteScroll('search');
            }); 

        $('input[name="list-search"]').live('keypress',function(){
                $('#form-list').infiniteScroll('search');
            });

            $('input[name="list-search-mobile"]').live('keypress',function(){
                $('input[name="list-search"]').val( $('input[name="list-search-mobile"]').val() );
                $('#form-list').infiniteScroll('search');
            });

    }

	if( $('#goto_vl_co').length > 0 && $('#view').val() != 'edit_blanket' ){
		$('#change_options').hide();
        get_selected_dates($('#record_id').val(), $('#form_status_id').val(), '', '');
    }

   // $('.form-filter').click(function(){

   //      $('.form-filter').each(function(){
   //          if( $(this).hasClass('label-info') ){
   //              $(this).removeClass('label-info').addClass('label-default');
   //          }
   //      });

   //      var form_id = $(this).data('form-id');

   //      if( $(this).hasClass('option') == true ){

   //          $('.form-filter').each(function(){

   //              if( !$(this).hasClass('option') && $(this).data('form-id') == form_id ){

   //                  $(this).removeClass('label-default').addClass('label-info');

   //              }


   //          });

   //      }
   //      else{

   //          $(this).removeClass('label-default').addClass('label-info');

   //      }

   //     $('#form-list').empty();
   //     $('#form-list').infiniteScroll({
   //          dataPath: base_url + module.get('route') + '/get_list',
   //          itemSelector: 'tr.record',
   //          onDataLoading: function(){ 
   //              $("#loader").show();
   //          },
   //          onDataLoaded: function(x, y, z){ 
   //              $("#loader").hide();

   //              if( x <= 0 ){
   //                  $('.well').show();
   //              }
   //              else{
   //                  $('.well').hide();
   //              }

   //              initPopup();

   //          },
   //          onDataError: function(){ 
   //              return;
   //          },
   //          search: $('input[name="list-search"]').val(),
   //          filter: form_id
   //      });

   //  });

   $('#goto_vl_co').click(function () {
    	$('#main_form').hide();
        $('.form-actions').hide();
    	$('#change_options').show();
    });

   $('#back_form_details').click(function(){
   		$('#main_form').show();
        $('.form-actions').show();
    	$('#change_options').hide();
   });

   $('.approve_view').click(function(){

        var form_id     = $(this).data('forms-id');
        var user_id     = $(this).data('user-id');
        var user_name   = $(this).data('user-name');
        var form_owner  = $(this).data('form-owner');
        var form_name   = $(this).data('form-name');
        var decission   = $(this).data('decission');

/*        if (!$("#comment-" + form_id).val()) {
            $("#comment-" + form_id).focus();
            return false;
        } else {
            comment = $("#comment-" + form_id).val();
        }*/

        comment = $("#comment-" + form_id).val();
        
        var data = {
            formid: form_id,
            userid: user_id,
            username: user_name,
            decission: decission,
            formownerid: form_owner,
            formname: form_name,
            comment: comment
        };

        submitDecission(data,'detail');

   });

   $('.disapprove_view').click(function(){

        var form_id = $(this).data('forms-id');
        var user_id = $(this).data('user-id');
        var form_owner  = $(this).data('form-owner');
        var decission = $(this).data('decission');
        var serialize_data = $('form#cancel_form').serialize();
        var comment = '';

        if (!$("#comment-" + form_id).val()) {
            $("#comment-" + form_id).focus();
            notify('error', 'The Remarks field is required' );
            return false;
        } else {
            comment = $("#comment-" + form_id).val();
        }

        // var data = {
        //     formid: form_id,
        //     userid: user_id,
        //     decission: decission,
        //     formownerid: form_owner,
        //     comment: comment,
        //     serialize_data: serialize_data
        // };

        // submitDecission(data,'detail');

        //due to the modification for the cancellation of selected date or whole shift
        $.blockUI({ message: saving_message(),
            onBlock: function(){
                $.ajax({
                    url: base_url + module.get('route') + '/forms_decission',
                    type: "POST",
                    async: false,
                    data: $('form#cancel_form').serialize() + '&formid=' + form_id+ '&userid=' + user_id+ '&decission=' + decission+ '&formownerid=' + form_owner+ '&comment=' + comment,
                    dataType: "json",
                    beforeSend: function () {

                        $('.popover-content').block();
                    },
                    success: function (response) {

                        $('.popover-content').unblock();

                        for (var i in response.message) {
                            notify(response.message[i].type, response.message[i].message);
                        }

                        if (response.action == 'insert') {
                            after_save(response);
                        }

                        setTimeout(function(){window.location.replace(base_url + module.get('route'))},2000);
                    }
                });
            },
            baseZ: 300000000
        });
        setTimeout(function(){$.unblockUI()},2000);

   });

   $('.cancel_view').click(function(){

        var form_id = $(this).data('forms-id');
        var user_id = $(this).data('user-id');
        var form_owner  = $(this).data('form-owner');
        var decission = $(this).data('decission');
        var comment = '';

        if (!$("#comment-" + form_id).val()) {
            $("#comment-" + form_id).focus();
            return false;
        } else {
            comment = $("#comment-" + form_id).val();
        }

        var data = {
            formid: form_id,
            userid: user_id,
            decission: decission,
            formownerid: form_owner,
            comment: comment
        };

        submitDecission(data,'detail');

   });
   
    $('.filter-paydate').click(function(){
        $('.filter-paydate').removeClass('label-success');
        $('.filter-paydate').addClass('label-default');
        $(this).removeClass('label-default');
        $(this).addClass('label-success')
        create_list();
    });
    $('.form-filter').click(function(){
        $('.form-filter').removeClass('label-success');
        $('.form-filter').addClass('label-default');
        $(this).removeClass('label-default');
        $(this).addClass('label-success')
        create_list();
    });
    $('.status-filter').click(function(){
        $('.status-filter').removeClass('label-success');
        $('.status-filter').addClass('label-default');
        $(this).removeClass('label-default');
        $(this).addClass('label-success')
        create_list();
    });
    $('.filing_type-filter').click(function(){
        $('.filing_type-filter').removeClass('label-success');
        $('.filing_type-filter').addClass('label-default');
        $(this).removeClass('label-default');
        $(this).addClass('label-success')
        create_list();
    });

    $('.employees_list').live('change', function() {
        if ($('#form_type').val() != 11)
            get_selected_dates($('#record_id').val(), $('#form_status_id').val(), $('#time_forms-date_from').val(), $('#time_forms-date_to').val(),$(this).val()); 
    })
});

function create_list()
{
    var search = $('input[name="list-search"]').val();
    var filter_by = {
        pay_date: $('.filter-paydate.label-success').attr('filter_value'),
        form_id: $('.form-filter.label-success').attr('filter_value'),
        form_status_id: $('.status-filter.label-success').attr('filter_value'),
        filing_type: $('.filing_type-filter.label-success').attr('filter_value'),
    }
    var filter_value = $('.status-filter.label-success').attr('filter_value');

    $('#form-list').empty().die().infiniteScroll({
        dataPath: base_url + module.get('route') + '/get_list',
        itemSelector: 'tr.record',
        onDataLoading: function(){ 
            $("#loader").show();
            $("#no_record").hide();
        },
        onDataLoaded: function(page, records){ 
            $("#loader").hide();
            if( page == 0 && records == 0)
            {
                $("#no_record").show();
            }
            initPopup();
        },
        onDataError: function(){ 
            return;
        },
        search: search,
        filter_by: filter_by,
        filter_value: filter_value
    });
}

function submitDecission(data,view) {

    $.blockUI({ message: saving_message(),
        onBlock: function(){
            $.ajax({
                url: base_url + module.get('route') + '/forms_decission',
                type: "POST",
                async: false,
                data: data,
                dataType: "json",
                beforeSend: function () {

                    $('.popover-content').block();
                },
                success: function (response) {

                    $('.popover-content').unblock();

                    for (var i in response.message) {
                        notify(response.message[i].type, response.message[i].message);
                    }

                    if (response.action == 'insert') {
                        after_save(response);
                    }

                    if( view == 'index' ){

                        $('.custom_popover').popover('hide');

                        $('#form-list').empty();

                        $('#form-list').infiniteScroll({
                            dataPath: base_url + module.get('route') + '/get_list',
                            itemSelector: 'tr.record',
                            onDataLoading: function(){ 
                                $("#loader").show();
                            },
                            onDataLoaded: function(x, y, z){ 
                                $("#loader").hide();

                                initPopup();

                            },
                            onDataError: function(){ 
                                return;
                            },
                            search: $('input[name="list-search"]').val()
                        });
                    }
                    else{
                        setTimeout(function(){window.location.replace(base_url + module.get('route'))},2000);
                    }
                }
            });
        },
        baseZ: 300000000
    });
    setTimeout(function(){$.unblockUI()},2000);
}

function initPopup(){

    var showTodoQuickView = function (e) {
        e.preventDefault();
        //$(this).popover('hide');
        $(this).popover('show');
        //$(this).popover('toggle');
    }
    , hideTodoQuickView = function (e) {
        e.preventDefault();
        $(this).popover('hide');
    };

    $('.custom_popover').on('click', function(e){
        e.preventDefault();
    });

    $('.custom_popover')
        .popover({ 
            trigger: 'manual', 
            title: '', 
            content: '', 
            html:true })
        .on('click', showTodoQuickView)
        .parent()
        .delegate('button.close-pop', 'click', function(e) {
            e.preventDefault();
            $('.custom_popover').popover('hide');
        })
        .delegate('button.approve-pop', 'click', function(e) {
            e.preventDefault();
            //$('.custom_popover').popover('hide');
            //console.log('now update forms set selected item to approved!');

            
            var form_id     = $(this).data('forms-id');
            var user_id     = $(this).data('user-id');
            var user_name   = $(this).data('user-name');
            var form_owner  = $(this).data('form-owner');
            var form_name   = $(this).data('form-name');
            var decission   = $(this).data('decission');

            // if (!$("#comment-" + form_id).val()) {
            //     $("#comment-" + form_id).focus();
            //     return false;
            // } else {
                comment = $("#comment-" + form_id).val();
            // }

            var data = {
                formid: form_id,
                userid: user_id,
                username: user_name,
                decission: decission,
                formownerid: form_owner,
                formname: form_name,
                comment: comment
            };

            submitDecission(data,'index');


        })
        .delegate('button.decline-pop', 'click', function(e) {
            e.preventDefault();
            //console.log('now update forms set selected item to declined!');

            var form_id = $(this).data('forms-id');
            var user_id = $(this).data('user-id');
            var decission = $(this).data('decission');
            var comment = '';

            if (!$("#comment-" + form_id).val()) {
                $("#comment-" + form_id).focus();
                notify("warning", "The Remarks field is required");
                return false;
            } else {
                comment = $("#comment-" + form_id).val();
            }

            var data = {
                formid: form_id,
                userid: user_id,
                decission: decission,
                comment: comment
            };

            submitDecission(data,'index');


        });


}

function back_to_mainform(cancel){
        if(cancel==1){
            get_selected_dates($('#record_id').val(), $('#form_status_id').val(), $('#time_forms-date_from').val(), $('#time_forms-date_to').val());    
        }
        $('#change_options').hide();
        $('#main_form').show();
        $('.form-actions').show();
    }

function get_selected_dates(forms_id, form_status_id, date_from, date_to, user_ids = []){
        var form_id = $('#form_type').val(); 
        $.ajax({
            url: base_url + module.get('route') + '/get_selected_dates',
            type:"POST",
            async: false,
            data: 'form_id='+form_id+'&forms_id='+forms_id+'&form_status_id='+form_status_id+'&date_from='+date_from+'&date_to='+date_to+'&view='+$('#view').val()+'&user_ids='+user_ids,
            dataType: "json",
            success: function ( response ) {
                $('#change_options').html(response.selected_dates);
                $('#days').html(response.days);
            }
        });
    }

function get_form_details(form_id, forms_id){
    $.ajax({
        url: base_url + module.get('route') + '/get_form_details',
        type:"POST",
        async: false,
        data: 'form_id='+form_id+'&forms_id='+forms_id,
        dataType: "json",
        success: function ( response ) {
            $('#manage_dialog-'+forms_id).attr('data-content', response.form_details);
        }
    });
}

function after_save( response ){    

    //console.log('PERFORMING NODE+SOCKET NOTIFICATION AND LOADING...');
   // console.log('THE RESPONSE DATA: ');
    //console.log(response);
    //console.log('CURRENT USER ID: ');
    //console.log(user_id);
    
    if(response.action == 'insert'){

        if(response.type == 'feed'){ console.log('you have just been FED up!!!... ');


            /*!*
            * The following are socket actions performing
            * dashboard feed notification and post feed
            * broadcast.
            **/

            socket.emit(
                'get_push_data', 
                {
                    channel: 'get_notification', 
                    args: { 
                        broadcaster: user_id, 
                        notify: true 
                    }
                }
            );
            
            // autoload feeds to their respective recipient/s
            socket.emit(
                'get_push_data', 
                {
                    channel: 'get_feed', 
                    args: { 
                        broadcaster: user_id,
                        target: response.target, 
                        notify: false 
                    }
                }
            );
        }
        else if(response.type == 'greetings'){ console.log('loading greetings!!!... ');

            /*!*
            * The following is/are socket actions performing
            * dashboard Birthday Greetings notifications
            * broadcast.
            **/
            socket.emit(
                'get_push_data', 
                {
                    channel: 'get_notification', 
                    args: { 
                        broadcaster: user_id, 
                        notify: true 
                    }
                }
            );
        }
        else if(response.type == 'todo'){ console.log('commencing to do... ');

            /*!*
            * The following is/are socket actions performing
            * dashboard Todo notification and Todo update 
            * broadcast on/with their respective recipient.
            **/

            // notify recipients with the results of their
            // submitted forms
            socket.emit(
                'get_push_data', 
                {
                    channel: 'get_notification', 
                    args: { 
                        broadcaster: user_id, 
                        notify: true 
                    }
                }
            );          
        }

    }
}


    function save_form( forms, status )
    {
        $.blockUI({ message: saving_message(),
            onBlock: function(){
                forms.submit( function(e){ e.preventDefault(); } );
                var save_url = forms.attr('action');
                var data = forms.find(":not('.dontserializeme')").serialize()
                $.ajax({
                    url: save_url,
                    type:"POST",
                    data: data + "&form_status_id=" + status,
                    dataType: "json",
                    async: false,
                    beforeSend: function(){
                        $('form#edit-forms-form').block({ message: '<div>Saving '+$('#forms_title').val()+', please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />' });
                    },
                    success: function ( response ) {
                        $('form#edit-forms-form').unblock();
                        
                        if( typeof response.forms_id != 'undefiend' )
                        {
                            $('form#edit-forms-form input[name="forms_id"]').val( response.forms_id );
                        }

                        handle_ajax_message( response.message );

                        if( typeof (response.notified) != 'undefined' )
                        {
                            for(var i in response.notified)
                            {
                                socket.emit('get_push_data', {channel: 'get_user_'+response.notified[i]+'_notification', args: { broadcaster: user_id, notify: true }});
                            }
                        }

                        if(response.saved )
                        {
                            setTimeout(function(){window.location.replace(base_url + module.get('route'))},1000);
                            // window.location.replace(base_url + module.get('route'));
                        }


                    }
                });
            },
            baseZ: 300000000
        });
        setTimeout(function(){$.unblockUI()},2000);
        // $.unblockUI();
    }

function selectedDates_showmore( nxt, button )
{
    for( var i = nxt; i <= (nxt + 5); i++ )
    {
        $('span.toggle-'+i).removeClass('hidden');
    }
    
    $('span.toggler-'+(i-1)).removeClass('hidden');
    $('span.toggler-'+(nxt)).remove();
}

function selectedDates_showmore_div( nxt, button )
{
    for( var i = nxt; i <= (nxt + 5); i++ )
    {
        $('.toggle-'+i).removeClass('hidden');
    }
    
    $('.toggler-'+(i-1)).removeClass('hidden');
    $('.toggler-'+(nxt)).remove();
}


