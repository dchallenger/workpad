function Module(){
	var theme_path = base_url + "assets/";
	var mod_code = "hr_validation";
	var route = "time/validation";
	this.get = function( to_get ){
		if( eval( to_get ) == undefined )
			return false;
		else
			return eval( to_get );
	};
}			
var module = new Module();