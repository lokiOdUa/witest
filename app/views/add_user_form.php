<h1>Add New User</h1>
<div id="add_user_form">
	<form id="add_user">
		<div>
			<div><b>Login:</b></div>
			<div><input type="text" name="login" onkeyup="search_user(login.value)"></div>
		</div>
		<div>
			<div><b>Password:</b> (twice, please)</div>
			<div><input type="password" name="secret"></div>
			<div><input type="password" name="secret0"></div>
		</div>
		<div>
			<div><b>User Name:</b></div>
			<div><input type="text" name="username"></div>
		</div>
		<div>
			<div><b>User type:</b></div>
			<div>
				<input type="radio" id="usertype-admin" name="usertype" value="admin">&nbsp;<label for="usertype-admin">Admin</label>&nbsp;::&nbsp;
				<input type="radio" id="usertype-regular" name="usertype" value="regular" checked="checked">&nbsp;<label for="usertype-regular">User</label>
			</div>
		</div>
		<div class="hr"><hr></div>
		<div>
			<div><button id="button_add" type="button" onclick="add_user(login.value, secret.value, secret0.value, username.value, usertype.value)">ADD</button></div>
		</div>
	</form>
</div>
	<div id="add_user_status">
		
	</div>
	<div id="add_user_results">
		
	</div>
</body>
</html>
