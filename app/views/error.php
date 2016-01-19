<!DOCTYPE HTML PUBLIC  "-//W3C//DTD HTML 4.01//EN" "www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<title>Site Error</title>
	<link rel="stylesheet" href="/css/main.css" type="text/css" />
</head>

<body>
<div id="mainleft">
<?
include("main_menu.php");
?>
</div>
<div id="mainright">
<h1>Site Error</h1>
<div>
<?= $error_message; ?>
</div>
</div>
</body>
</html>
