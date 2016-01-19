<?
require_once("./app/bootstrap.php");
if ( $user->get_id() > 0 )
{
	$site->javascripts[] = "add_user";
	$site->template = "add_user_form";
}
require_once("app/views/main.php");
?>
