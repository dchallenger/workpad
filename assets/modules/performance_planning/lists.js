$(document).ready(function(e) { 
    $('.filter-type').click(function(){
        $('.filter-type').removeClass('label-success');
        $('.filter-type').addClass('label-default');
        $(this).removeClass('label-default');
        $(this).addClass('label-success')
        create_list();
    });

    $('.filter-type-status').click(function(){
        $('.filter-type-status').removeClass('label-success');
        $('.filter-type-status').addClass('label-default');
        $(this).removeClass('label-default');
        $(this).addClass('label-success')

        create_list_status();
    }); 

});

function create_list()
{
    var search = $('input[name="list-search"]').val();
    var filter_by = {
        year: $('.filter-type.label-success').attr('filter_value')
    }
    var filter_value = $('.filter-type.active').attr('filter_value');

    $('#record-list').empty().die().infiniteScroll({
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
        },
        onDataError: function(){ 
            return;
        },
        search: search,
        filter_by: filter_by,
        filter_value: filter_value
    });
}

function create_list_status()
{
    var search = $('input[name="list-search"]').val();
    var filter_by = {
        status_id: $('.filter-type-status.label-success').attr('filter_value')
    }
    var filter_value = $('.filter-type-status.active').attr('filter_value');

    $('#record-list').empty().die().infiniteScroll({
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
        },
        onDataError: function(){ 
            return;
        },
        search: search,
        filter_by: filter_by,
        filter_value: filter_value
    });
}

function open_planning( planning_id, callback )
{
    bootbox.confirm("Are you sure you want to open this performance planning?", function(confirm) {
        if( confirm )
        {
            save_planning_status( planning_id, 1 );
        } 
    });
}

function close_planning(planning_id, callback)
{   
    $.ajax({
        url: base_url + module.get('route') + '/count_unapproved_forms',
        type:"POST",
        data: {planning_id: planning_id},
        dataType: "json",
        async: false,
        beforeSend: function(){
        },
        success: function ( response ) {
            if (response.unapproved_forms_count)
                var message = "There are "+response.unapproved_forms_count+ " unapproved performance planning.<br> Are you sure you want to continue closing?";
            else
                var message = "Are you sure you want to continue closing?";

            bootbox.confirm(message, function(confirm) {
                if( confirm )
                {
                    save_planning_status( planning_id, 0 );
                }
            });
        }
    });
}

function save_planning_status(planning_id, status_id)
{
    $.blockUI({ message: '<div>Saving, please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />', 
        onBlock: function(){
            $.ajax({
                url: base_url + module.get('route') + '/save_planning_status',
                type:"POST",
                data: {planning_id:planning_id, status_id:status_id},
                dataType: "json",
                async: false,
                beforeSend: function(){
                },
                success: function ( response ) {
                    handle_ajax_message( response.message );

                    if (typeof(callback) == typeof(Function))
                        callback();
                    else
                        $('#record-list').infiniteScroll('search');

                }
            });
        },
        baseZ: 300000000
    });
    $.unblockUI();  
}

function copy_record( record_id )
{
    bootbox.prompt('Enter Notes or Description', function(title){
        if( title !== null )
        {
            if( title == "" )
            {
                copy_record( record_id );
                notify('warning', 'Please enter Notes or Description');
                return;
            }

            $.blockUI({ message: '<div>'+lang.common.processing_message+'</div><img src="'+root_url+'assets/img/ajax-loading.gif" />', 
                onBlock: function(){
                    $.ajax({
                        url: base_url + module.get('route') + '/duplicate',
                        type:"POST",
                        async: false,
                        data: {record_id:record_id, title: title},
                        dataType: "json",
                        beforeSend: function(){
                        },
                        success: function ( response ) {
                            handle_ajax_message( response.message );

                            if( response.record_id != null )
                            {
                                window.location = base_url + module.get('route') + '/edit/' + response.record_id;
                            }
                        }
                    });
                }
            });
            $.unblockUI();
        }
    });
}