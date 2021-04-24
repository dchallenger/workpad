$(document).ready(function(){
    $('#training_application-budgeted-temp').change(function(){
    	if( $(this).is(':checked') )
    		$('#training_application-budgeted').val('1');
    	else
    		$('#training_application-budgeted').val('0');
    });
    $('#training_application-service_bond-temp').change(function(){
    	if( $(this).is(':checked') )
    		$('#training_application-service_bond').val('1');
    	else
    		$('#training_application-service_bond').val('0');
    });
    $('#training_application-allocated').select2({
        placeholder: "Select an option",
        allowClear: true
    });
    $('#training_application-competency').select2({
        placeholder: "Select an option",
        allowClear: true
    });
    $('#training_application-training_provider').select2({
        placeholder: "Select an option",
        allowClear: true
    });
    $('#training_application-training_course_id').select2({
        placeholder: "Select an option",
        allowClear: true
    });
    if (jQuery().datepicker) {
        $('#training_application-date_to').parent('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
        $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
    }
    if (jQuery().datepicker) {
        $('#training_application-date_from').parent('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
        $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
    }
    $('#training_application-training_type').select2({
        placeholder: "Select an option",
        allowClear: true
    });
    $('#training_application-user_id').select2({
        placeholder: "Select an option",
        allowClear: true
    });
});

var epap = {
    init: function() {
        epap.add_objective();
        epap.del_objective();
        epap.add_action_plan();
        epap.del_action_plan();
        epap.add_knowledge_transfer();
        epap.del_knowledge_transfer();         
    },
    add_objective: function() {
        $('.add_objective').live('click',function() {
            var elem = $(this);

            data = {
                record_id : 0
            }            

            $.ajax({
                url: base_url + module.get('route') + '/get_objective',
                type: "POST",
                async: false,
                data: data,
                dataType: "json",
                beforeSend: function () {
                },
                success: function (response) {
                    $(elem).closest('div.objective_main_container').find('.objective_container').append(response.objective_content);
                    $('#training_application-training_objective').select2({
                        placeholder: "Select an option",
                        allowClear: true
                    });                    
                }
            });
        });
    },
    del_objective: function() {
        $('.delete_objective').live('click', function() {
            $(this).closest('.portlet').remove();    
        })
    },
    add_action_plan: function() {
        $('.add_action_plan').live('click',function() {
            var elem = $(this);

            data = {
                record_id : 0
            }            

            $.ajax({
                url: base_url + module.get('route') + '/get_action_plan',
                type: "POST",
                async: false,
                data: data,
                dataType: "json",
                beforeSend: function () {
                },
                success: function (response) {
                    $(elem).closest('div.action_plan_main_container').find('.action_plan_container').append(response.objective_content);                  
                }
            });
        });
    },
    del_action_plan: function() {
        $('.delete_action_plan').live('click', function() {
            $(this).closest('.portlet').remove();    
        })
    },
    add_knowledge_transfer: function() {
        $('.add_knowledge_transfer').live('click',function() {
            var elem = $(this);

            data = {
                record_id : 0
            }            

            $.ajax({
                url: base_url + module.get('route') + '/get_knowledge_transfer',
                type: "POST",
                async: false,
                data: data,
                dataType: "json",
                beforeSend: function () {
                },
                success: function (response) {
                    $(elem).closest('div.knowledge_transfer_main_container').find('.knowledge_transfer_container').append(response.objective_content);
                    $('#training_application-knowledge_transfer').select2({
                        placeholder: "Select an option",
                        allowClear: true
                    });                    
                }
            });
        });
    },
    del_knowledge_transfer: function() {
        $('.delete_knowledge_transfer').live('click', function() {
            $(this).closest('.portlet').remove();    
        })
    } 
}

epap.init();