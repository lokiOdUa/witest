<h1>Add New Phone</h1>
<div id="add_phone_form">
	<form id="add_phone">
		<div>
			<div><b>Title:</b></div>
			<div><input type="text" name="phtitle"></div>
		</div>
		<div>
			<div><b>Price:</b></div>
			<div><input type="text" name="price"></div>
		</div>
		<div>
			<div><b>VCode:</b></div>
			<div><input type="text" name="vcode"></div>
		</div>
		<div>
			<div><b>Decription:</b></div>
			<div><textarea name="descr" rows="10" cols="60"></textarea></div>
		</div>
		<div class="hr"><hr></div>
		<div>
			<div><button id="button_add" type="button" onclick="add_phone(phtitle.value, price.value, vcode.value, descr.value)">ADD</button></div>
		</div>
	</form>
</div>
	<div id="add_phone_status">
		
	</div>
	<div id="add_phone_results">
		
	</div>
</body>
</html>