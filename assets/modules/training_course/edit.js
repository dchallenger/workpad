$(document).ready(function(){
    $('.select2me').select2({
        placeholder: "Select an option",
        allowClear: true
    });

    $('#training_course-position_id').multiselect({
        selectedList: 1
    }).multiselectfilter();

    $('.ui-multiselect').css('width', '525px');
    $('.ui-multiselect-menu').css('width', '525px');    	
});