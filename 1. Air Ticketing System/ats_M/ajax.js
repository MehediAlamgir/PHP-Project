function call_email()
{
	var e = document.getElementById('email').value;

	if(e == '')
	{
		return;
	}
	
	var xmlhttp;
	
	if (window.XMLHttpRequest)
	{
	// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	}
	
	else
	{
	// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4)
		{
			document.getElementById("email_msg").innerHTML=xmlhttp.responseText;			
		}
	}
	
	xmlhttp.open("GET","check.php?email=" + e,true);
	xmlhttp.send();
}


function call_username()
{
	var uname = document.getElementById('un').value;

	if(uname == '')
	{
		return;
	}
	
	var xmlhttp;
	
	if (window.XMLHttpRequest)
	{
	// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	}
	
	else
	{
	// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4)
		{
			document.getElementById("un_msg").innerHTML=xmlhttp.responseText;			
		}
	}
	
	xmlhttp.open("GET","check.php?un=" + uname,true);
	xmlhttp.send();
}


function call_password()
{
	var password = document.getElementById('pass').value;

	if(password == '')
	{
		return;
	}

	else if(password.length>=6)
	{
		document.getElementById("pass_msg").innerHTML="OK";	
	}

	else
	{
		var xmlhttp;
		
		if (window.XMLHttpRequest)
		{
		// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		}
		
		else
		{
		// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4)
			{
				document.getElementById("pass_msg").innerHTML="Password Must Contain at Least 6 character";				
			}
		}
		
		xmlhttp.open("GET","check.php?pass=" + password,true);
		xmlhttp.send();
	}
}


function call_conpassword()
{
	var password = document.getElementById('pass').value;
	var conpassword = document.getElementById('conpass').value;

	if(conpassword == "")
	{
		return;
	}

	if(password == conpassword)
	{
		document.getElementById("conpassword_msg").innerHTML="Password Matched";	
	}

	else
	{
		var xmlhttp;
		
		if (window.XMLHttpRequest)
		{
		// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		}
		
		else
		{
		// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4)
			{
				document.getElementById("conpassword_msg").innerHTML="Password did not Match";				
			}
		}
		
		xmlhttp.open("GET","check.php?conpass=" + conpassword,true);
		xmlhttp.send();

	}
}

