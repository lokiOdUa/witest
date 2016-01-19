<?
require_once("./app/bootstrap.php");

$site->check_referer();
$controller->check_form();
$controller->prepare_query();
$controller->view->render_result($controller->do_search(), $controller->datatype);
?>