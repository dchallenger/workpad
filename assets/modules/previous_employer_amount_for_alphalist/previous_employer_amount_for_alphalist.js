function Module(){
	var theme_path = base_url + "assets/";
	var mod_code = "previous_employer_amount_for_alphalist";
	var route = "payroll/previous_employer_amount_for_alphalist";
	this.get = function( to_get ){
		if( eval( to_get ) == undefined )
			return false;
		else
			return eval( to_get );
	};
}			
var module = new Module();