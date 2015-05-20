function validateForm(){
	var userName = document.getElementById("username").value;
	var password = document.getElementById("password").value;
	if(!userName){
		alert("User name not valid");
		document.getElementById("usernameerror").innerHTML = "<font color='red'><b> [X]</font>";
		return false;
	}
	else if(!password){
		alert("Password not valid");
		document.getElementById("passworderror").innerHTML = "<font color='red'><b> [X]</font>";
		return false;
	}
	else{
		return true;
	}
}

function validateReg(){
	var firstname = document.getElementById("firstname").value;
	var lastname = document.getElementById("lastname").value;
	var username = document.getElementById("username").value;
	var password1 = document.getElementById("password").value;
	var password2 = document.getElementById("password2").value;
	var email = document.getElementById("email").value;
	var atpos = email.indexOf("@");
	var dotpos = email.lastIndexOf(".");
	if(!firstname){
		alert("First Name Not Valid");
		document.getElementById("errorfirstname").innerHTML = "<font color='red'><b>Not Valid</font>";
		return false;
	}
	else if(!lastname){
		alert("lastname Name Not Valid");
		document.getElementById("errorlastname").innerHTML = "<font color='red'><b>Not Valid</font>";
		return false;
	}
	else if(!username){
		alert("User Name Not Valid");
		document.getElementById("errorusername").innerHTML = "<font color='red'><b>Not Valid</font>";
		return false;
	}
	else if(!password1){
		alert("Password Not Valid");
		document.getElementById("errorpassword1").innerHTML = "<font color='red'><b>Not Valid</font>";
		return false;
	}
	else if(!password2){
		alert("Password Not Valid");
		document.getElementById("errorpassword2").innerHTML = "<font color='red'><b>Not Valid</font>";
		return false;
	}
	else if(password1 != password2){
		alert("Password Mismatch");
		document.getElementById("errorpassword1").innerHTML = "<font color='red'><b>Password not match</font>";
		return false;
	}
	else if(atpos<1 || dotpos<atpos+2 || dotpos+2>email.length){
		alert("Email Not Valid");
		document.getElementById("erroremail").innerHTML = "<font color='red'><b>Email Not Valid</font>";
		return false;
	}

}

function validateBuy(){
	var quantity = document.getElementById("quantity").value;
	if(!quantity){
		alert("Please Enter Quantity");
		return false;
	}
	else if(quantity <= 0){
		alert("Quantity not valid");
		return false;
	}
}

function MapopenWin()
{
window.open("http://www.w3schools.com","_blank","toolbar=no, scrollbars=yes, resizable=no, top=500, left=500, width=900, height=500");
}