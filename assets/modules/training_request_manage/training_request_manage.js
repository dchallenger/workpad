function Module(){
	var theme_path = base_url + "assets/";
	var mod_code = "training_request_manage";
	var route = "training/training_request_manage";
	this.get = function( to_get ){
		if( eval( to_get ) == undefined )
			return false;
		else
			return eval( to_get );
	};
}			
var module = new Module();