$(document).ready(function(){
    $('#payroll_current_transaction-on_hold-temp').change(function(){
    	if( $(this).is(':checked') )
    		$('#payroll_current_transaction-on_hold').val('1');
    	else
    		$('#payroll_current_transaction-on_hold').val('0');
    });
    $(":input").inputmask();
    if (jQuery().datepicker) {
        $('#payroll_current_transaction-payroll_date').parent('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
        $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
    }

    $('.select2me').select2({
        placeholder: "Select an option",
        allowClear: true
    });
});