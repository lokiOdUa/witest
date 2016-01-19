<?
require_once("./app/bootstrap.php");

$site->check_referer();
$phone = new Model_phone();
if ($phone->check_form())
{
	echo json_encode($phone->create());
}
else
{
	echo json_encode(array ('status' => '400',
							'message' => 'Cannot validate entered data. Please check your input and try again') );
}
?>