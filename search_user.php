<?
require_once("./app/bootstrap.php");

$site->check_referer();
if ($controller->check_form_search())
{
	echo json_encode($controller->do_search_string());
}
?>