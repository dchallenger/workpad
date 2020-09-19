$(document).ready(function(){
	$(":input").inputmask();
	
	$('.select2me').select2({
	    placeholder: "Select an option",
	    allowClear: true
	});
	$('.date-picker').datepicker({
		rtl: App.isRTL(),
		autoclose: true
	});	
});