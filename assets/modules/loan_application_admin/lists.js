$(document).ready(function()
{
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
});

function create_list()
{
    var search = $('input[name="list-search"]').val();
    var filter_by = {
        loan_type_id: $('.form-filter.label-success').attr('filter_value'),
        loan_application_status_id: $('.status-filter.label-success').attr('filter_value'), 
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
        },
        onDataError: function(){ 
            return;
        },
        search: search,
        filter_by: filter_by,
        filter_value: filter_value
    });
}

function print_application (record_id)
{
    var data = {
        record_id:record_id,
        }
    $.blockUI({ message: '<div>Loading, please wait...</div><img src="'+root_url+'assets/img/ajax-loading.gif" />', 
        onBlock: function(){
            $.ajax({
                url: base_url + module.get('route') + '/print_application',
                type:"POST",
                async: false,
                data: data,
                dataType: "json",
                success: function ( response ) {
                    if( response.filename != undefined )
                    {
                        window.open( root_url + response.filename );
                    }
                    $.unblockUI();
                    handle_ajax_message( response.message );
                }
            });
        },
        baseZ: 999999999
    });
}