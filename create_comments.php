<?
require_once("./app/bootstrap.php");

$site->check_referer();
$comment = new Model_comments();
if ($comment->check_form($user))
{
	echo json_encode($comment->create());
}
else
{
	echo json_encode(array ('status' => '400',
							'message' => 'Cannot validate entered data. Please check your input and try again') );
}
?>