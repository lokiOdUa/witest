<?
require_once("./app/bootstrap.php");

if( $controller->check_credentials() )
{
//	echo "Doing login";
	$controller->do_login($user);
	header( 'Location: /login.php' );
	exit();
}

if ( $user->get_id() > 0 )
{
	if( isset( $_COOKIE['redir'] ) && ( strlen($_COOKIE['redir']) > 0 ) )	// TODO move functionality to $user->check_redir
	{
		/*
		* This is vulnerable to unvalidated redirect by changing cookie value to be redirected somewhere outside.
		* To avoid this, we can
		*  - 1. use only URI and check if it does not begin with single '/' character
		*  - 2. use whitelist/regexp to check URL before to redirect
		*  - 3. use array of fixed amount of redirects and store key under session data
		*/
		setcookie('redir', NULL);
		header( 'Location: /' . $_COOKIE['redir'] ); 
		exit();
	}
}
$site->template = "login_main";
require_once("app/views/main.php");
?>