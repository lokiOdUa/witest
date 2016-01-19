	function add_phone(title, price, vcode, descr)
	{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function()
		{
	    	if (xhttp.readyState == 4 && xhttp.status == 200)
	    	{
	    		node_clear("add_phone_status");
	    		var response = xhttp.responseText;
	     		var state = JSON.parse(response);
	     		if( state.state == "200" )
	     		{
	     			document.getElementById("add_phone_status").innerHTML = 
	     				"Succesfully created phone '" + title + "', new database id: " + state.id;
	     		}
	     		else
	     		{
	     			document.getElementById("add_phone_status").innerHTML = 
	     				"Cannot create object '" + title + "'. Backend said the following:<br/>" + state.message;
	     		}
			}
		};
		xhttp.open("POST", "/create_phone.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(	"title=" + title +
					"&price=" + price +
					"&vcode=" + vcode +
					"&descr=" + descr );
	}
