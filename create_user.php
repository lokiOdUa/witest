<?
require_once("./app/bootstrap.php");

$site->check_referer();
$u2a = new Model_user();
if ($u2a->check_form())
{
	echo json_encode($u2a->create());
}
else
{
	echo json_encode(array ('status' => '400') );
}
?>