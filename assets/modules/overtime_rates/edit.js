$(document).ready(function(){
    $('.select2me').select2({
        placeholder: "Select an option",
        allowClear: true
    });

    $('#payroll_overtime').change(function() {
    	var rate = $(this).find(':selected').data('rate')
    	$('#payroll_overtime_rates-overtime_rate').val(rate);
    })
});