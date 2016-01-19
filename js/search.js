	function do_search(pricefrom, priceto, vcode, descr, datatype) {
		error_text = "";
		document.getElementById("search_results").innerHTML = "";
		document.getElementById("search_status").innerHTML = "";

		if( parseInt(pricefrom)>parseInt(priceto) )
		{
			error_text = error_text + "<div><b>Price from:</b> should be less than <b>Price to:</b></div>";
		}

		if(!error_text || !error_text.length)
		{
			node_clear("search_status");
			document.getElementById("search_status").innerHTML = "<h1>Searching...</h1>";
			var xhttp = new XMLHttpRequest();
			if(datatype == "json")
			{
				var phones = new Array;
				// Здесь мы получаем с бэкэнда массив данных о товарах и JS для рендеринга
				xhttp.onreadystatechange = function()
				{
			    	if (xhttp.readyState == 4 && xhttp.status == 200)
			    	{
			    		var sres = "";
			    		node_clear("search_status");
			    		node_clear("search_results");
//			     		document.getElementById("search_results").innerHTML = xhttp.responseText;
			     		phones = JSON.parse( xhttp.responseText );
			     		for (var c=0; c<phones.data.length; c++)
			     		{
			     			phone = phones.data[c];
			     			sres += "<div id=\"phone_" + phone.id + "\">"
			     			sres += "<div><b>Title:</b> " + phone.title + "</div>"
			     			sres += "<div><b>Price:</b> " + phone.price + "</div>"
			     			sres += "<div><b>Description:</b><br/>" + phone.descr + "</div>"
			     			sres += "<div><b>VCode:</b> " + phone.vcode + "</div>"
			     			sres += "<div class=\"hr\"><hr></div>"
			     			sres += "</div>"
			     		}
			     		document.getElementById("search_results").innerHTML = sres;
					}
				};
			}
			else
			{
				xhttp.onreadystatechange = function()
				{
			    	if (xhttp.readyState == 4 && xhttp.status == 200)
			    	{
			    		node_clear("search_status");
			    		node_clear("search_results");
			     		document.getElementById("search_results").innerHTML = xhttp.responseText;
					}
				};
			}
			xhttp.open("POST", "/search_result.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send(	"pricefrom=" + pricefrom + 
						"&priceto=" + priceto +
						"&vcode=" + vcode +
						"&descr=" + descr +
						"&datatype=" + datatype);
		}
		else
		{
			document.getElementById("search_status").innerHTML = error_text;
		}
	}
