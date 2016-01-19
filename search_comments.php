<?
require_once("./app/bootstrap.php");

$site->check_referer();
$controller->view->render_comments($controller->do_search(), "html");
?>