function hideRecurlyError(){
	document.getElementById("error_recurly").style.display = "none";  
	var x = document.getElementById("error_recurly");   
	x.style.display = "block";   
}	
function recurlyErrors(err_txt){
	var x = document.getElementById("error_recurly");   
	x.style.display = "block";
	document.getElementById('error_recurly').innerHTML = err_txt;
}	
function validateEmail(email){
	return String(email)
	.toLowerCase()
	.match(
	  /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
	);
}	
function validateForm() {
  let first_name = document.forms["recurly-form"]["first_name"].value;
  if (first_name == "") {
	
	  recurlyErrors("First name is required");
	return false;
  }
	
let last_name = document.forms["recurly-form"]["last_name"].value;
  if (last_name == "") {
	recurlyErrors("Last name is required");
	return false;
  }
	
	let email = document.forms["recurly-form"]["email"].value;
  if (email == "") {
   recurlyErrors("Email is required");
	return false;
  }
	if(!validateEmail(email)){
		 
		recurlyErrors("Valid email is required");
	return false;
	}
	let address1 = document.forms["recurly-form"]["address1"].value;
  if (address1 == "") {
	  
	  recurlyErrors("Address is required");
	return false;
  }
	let city = document.forms["recurly-form"]["city"].value;
  if (city == "") {
	  
	  recurlyErrors("City is required");
	return false;
  }
	let state = document.forms["recurly-form"]["state"].value;
  if (state == "") {
	recurlyErrors("State is required");
	return false;
  }
	let postal_code = document.forms["recurly-form"]["postal_code"].value;
  if (postal_code == "") {
	recurlyErrors("Postal Code is required");
	return false;
  }
	
	return true;
}