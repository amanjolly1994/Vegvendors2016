// Contains validation of all forms

$(document).ready(function(){

	

	//Validation of Location form

	$("#locationForm").submit(function(){
		var areaVar = document.forms["locationForm"]["area"].value;
		var subareaVar = document.forms["locationForm"]["subarea"].value;
		if(areaVar == null || areaVar == "")
		{
			// alert("Please select your area.")
			return false;
		}
			

		else if( subareaVar == null || subareaVar == "" )
		{
			// alert("Please select your sub area");
			return false;
		}

		else
			return true;
	});


	// All DASHBOARD JS AND AJAX

	


});
