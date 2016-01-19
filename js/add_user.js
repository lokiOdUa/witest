	function add_user(ogin, pwd, pwd0, username, usertype)
	{
		if ( check_login(ogin) && check_password(pwd, pwd0) )
		{
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function()
			{
		    	if (xhttp.readyState == 4 && xhttp.status == 200)
		    	{
		    		node_clear("add_user_status");
		    		var response = xhttp.responseText;
		    		document.getElementById("add_user_status").innerHTML = response;
		     		var state = JSON.parse(response);
		     		if( state.state == "200" )
		     		{
		     			document.getElementById("add_user_status").innerHTML = 
		     				"User '" + ogin + "' succesfully added, new user id: " + state.id;
		     		}
		     		else
		     		{
		     			document.getElementById("add_user_status").innerHTML = 
		     				"Cannot create user '" + ogin + "'. Please see application error log for details";
		     		}
				}
			};
			xhttp.open("POST", "/create_user.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send(	"login=" + ogin +
						"&password=" + pwd +
						"&username=" + username +
						"&usertype=" + usertype );
		}

	}
	function check_login(ogin)
	{
		var oginlen = 4;
		if ( ogin.length < oginlen )
		{
			document.getElementById("add_user_status").innerHTML = "Login should be " + oginlen + " symbols or more";
			return false;
		}
		return true;
	}
	function check_password(pwd, pwd0)
	{
		var pwdlen = 6;
		if ( pwd != pwd0 )
		{
			document.getElementById("add_user_status").innerHTML = "Passwords should match";
			return false;
		}
		if ( pwd.length < pwdlen )
		{
			document.getElementById("add_user_status").innerHTML = "Password should be " + pwdlen + " symbols or more";
			return false;
		}
		return true;
	}
	function search_user(ogin)
	{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function()
		{
	    	if (xhttp.readyState == 4 && xhttp.status == 200)
	    	{
	    		var response = xhttp.responseText;
	     		var amount = JSON.parse(response);
	     		if( amount.amount == 0 )
	     		{
	     			document.getElementById("button_add").removeAttribute("disabled");
	     		}
	     		else
	     		{
	     			document.getElementById("add_user_status").innerHTML = 
	     				"User '" + ogin + "' already exists";
	     			document.getElementById("button_add").setAttribute("disabled","disabled");
	     		}
			}
		};
		xhttp.open("POST", "/search_user.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(	"ogin=" + ogin );
	}
