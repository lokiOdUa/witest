<?
require_once("./app/bootstrap.php");

if ( $user->get_id() > 0 )
{
	$site->javascripts[] = "search";
	$site->template = "search_form";
}

require_once("app/views/main.php");
?>