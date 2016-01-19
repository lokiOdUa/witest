	var xhttp = new XMLHttpRequest();
	function add_comment(mtitle, body, token)
	{
		xhttp.onreadystatechange = function()
		{
	    	if (xhttp.readyState == 4 && xhttp.status == 200)
	    	{
	    		var response = xhttp.responseText;
	     		var state = JSON.parse(response);
	     		if( state.state == "200" )
	     		{
	     			node_clear("all_comments");
	     			document.getElementById("add_comment_status").innerHTML = 
	     				"Succesfully added comment '" + mtitle + "', new database id: " + state.id;
	     			display_comments();
	     		}
	     		else
	     		{
	     			document.getElementById("add_comment_status").innerHTML = 
	     				"Cannot create object '" + mtitle + "'. Backend said the following:<br/>" + state.message;
	     		}
			}
		};
		xhttp.open("POST", "/create_comments.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(	"title=" + mtitle +
					"&body=" + body +
					"&token=" + token );
	}
	function display_comments()
	{
		xhttp.onreadystatechange = function()
		{
	    	if (xhttp.readyState == 4 && xhttp.status == 200)
	    	{
	    		var response = xhttp.responseText;
	    		document.getElementById("all_comments").innerHTML = response;
			}
		};
		xhttp.open("GET", "/search_comments.php", true);
		xhttp.send();
	}
