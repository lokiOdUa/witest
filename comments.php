<?
require_once("./app/bootstrap.php");

$comment = new Model_comments();

if( $user->id )
{
	if( isset( $_REQUEST['action'] ) )
	{
		if( $_REQUEST['action'] == "add" )
		{
			if( $comment->check_form( $user ) )
			{
				$comment->create();
			}
			else
			{
				echo "Message validation error";
			}
		}
	}
}
if( isset( $_REQUEST['token'] ) && preg_match('/^[0-9a-f]{32}$/i', $_REQUEST['token'] ) )
{
	$token = $_REQUEST['token'];
	$user->continue_session( $user->check_csrftoken( $token, true ) );
}

$site->data = $comment->get_all();
$site->template = "comments";
if ( $user->get_id() > 0 )
{
	$site->javascripts[] = "comments";
}

require_once("app/views/main.php");
?>