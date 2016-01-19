<h1>Search Phones</h1>
<div id="search_form">
	<form id="search">
		<div>
			<div><b>Price from:</b> e.g. 2000</div>
			<div><input type="text" name="pricefrom"></div>
		</div>
		<div>
			<div><b>Price to:</b> e.g. 10000</div>
			<div><input type="text" name="priceto"></div>
		</div>
		<div>
			<div><b>VCode:</b></div>
			<div><input type="text" name="vcode"></div>
		</div>
		<div>
			<div><b>Text:</b></div>
			<div><input type="text" name="descr"></div>
		</div>
		<div>
			<div><b>Data type:</b></div>
			<div><select name="datatype"><option value="html">HTML</option><option value="json">JSON</option></select></div>
		</div>
		<div class="hr"><hr></div>
		<div>
			<div><button type="button" onclick="do_search(pricefrom.value, priceto.value, vcode.value, descr.value, datatype.value)">SEARCH</button></div>
		</div>
	</form>
</div>
	<div id="search_status">
		
	</div>
	<div id="search_results">
		
	</div>
</body>
</html>
