<!DOCTYPE HTML PUBLIC  "-//W3C//DTD HTML 4.01//EN" "www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<title><?= $site->title; ?></title>
	<link rel="stylesheet" href="/css/main.css" type="text/css" />
	<?
	if( count( $site->javascripts ) )
	{
		?><script src="/js/main.js"  type="text/javascript"></script>
<?
		foreach($site->javascripts AS $js)
		{
		?><script src="/js/<?= $js; ?>.js"  type="text/javascript"></script>
<?
		}
	}
	?>
</head>

<body>
<div id="mainleft">
<?
include("main_menu.php");
if( $user->id )
{
	include("hello.php");
	include("logout_form.php");
}
else
{
	include("login_form.php");
}
?>
</div>
<div id="mainright">
<?
if ( $site->template )
{
	include( "app/views/" . $site->template . ".php" );
}
?>
</div>
</body>
</html>
