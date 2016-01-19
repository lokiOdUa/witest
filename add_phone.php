<?
require_once("app/bootstrap.php");
if ( $user->get_id() > 0 )
{
	$site->javascripts[] = "add_phone";
	$site->template = "add_phone_form";
}
require_once("app/views/main.php");
?>
