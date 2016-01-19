<?
header("Content-Type: text/html; charset=utf-8");
require_once 'app/model.php';
require_once 'app/view.php';
require_once 'app/controller.php';
require_once 'app/database.php';
require_once 'app/user.php';

session_start();

// Global variables
$controller = "";
$site = "";
$user = "";

class Site 
{
	public $route = "";
	public $location = "";
	public $template = "";
	public $data = array();
	public $admin_required = false;

	public $javascript = array();
	public $title = "";

	function __construct()
	{
		global $controller;

		$pieces = explode('/', $_SERVER['REQUEST_URI']);
		$pieces2 = explode('.', $pieces[1]);
		$this->location = $pieces2[0];
		if( strpos($pieces2[0], "_") )
		{
			// this is to process routes like add_user, delete_phone etc
			$pieces3 = explode('_', $pieces2[0]);
			$this->route = $pieces3[1];
			if( $pieces2[0] == "add_user" )
			{
				$this->admin_required = true;
			}
		}
		else
		{
			$this->route = $pieces2[0];
		}
		if($this->route == "logout")
		{
			$this->route = "login";
		}

		$model_name = 'Model_' . $this->route;
		$model_filename = "app/models/" . strtolower($this->route) . ".php";
		if (file_exists($model_filename))
		{
			include($model_filename);
		}
		else
		{
			echo "Cannot find file " . $model_filename;
		}

		$controllername = 'Controller_' . $this->route;
		$controllerfilename = "app/controllers/" . strtolower($this->route) . ".php";
		if (file_exists($controllerfilename))
		{
		//	echo "Including " . $controllerfilename;
			include($controllerfilename);
		}
		else
		{
			echo "Cannot find file " . $controllerfilename;
		}

		$controller = new $controllername;
		if( method_exists($controllername, "main") )
		{
			$controller->route = $this->route;
		//	echo " ||| calling " . $controllername . "->main() ||| ";
			$controller->main();
		}
		else
		{
			echo "Cannot find main() method inside of class " . $controllername;
		}
	}

	function check_referer()
	{
		$pieces = explode("/", $_SERVER["HTTP_REFERER"]);
		$referer = $pieces[2];
		$host = $_SERVER["HTTP_HOST"];
		if( $host <> $referer )
		{
			$this->redirect_500();
		}
		return true;
	}

	function get_admin_required()
	{
		return $this->admin_required;
	}

	function get_location()
	{
		return $this->location;
	}

	function get_route()
	{
		return $this->route;
	}

	function redirect_403()
	{
		$error_message = "403 Forbidden";
		header('HTTP/1.1 ' . $error_message, true, 403);
		include("views/error.php");
		exit(0);
	}

	function redirect_404()
	{
		$error_message = "404 Not Found";
		header('HTTP/1.1 ' . $error_message, true, 404);
		include("views/error.php");
		exit(0);
	}

	function redirect_500()
	{
		$error_message = "500 Forbidden";
		header('HTTP/1.1 ' . $error_message, true, 500);
		include("views/error.php");
		exit(0);
	}

	function redirect_login()
	{
		header('Location: /login.php');
		exit(0);
	}
}

$site = new Site;
$user = new User;

if( $user->get_id()==0 )
{
	if ( isset( $_REQUEST['token'] ) && $site->get_route() == "comments" )
	{

	}
	elseif ( $user->get_id()==0 && $site->get_route() <> "login" && $site->get_route() <> "logout" )
	{
		setcookie('redir', $site->get_location() . '.php');
		$site->redirect_login();
	}
}

if ( $site->get_admin_required() && !$user->get_is_admin() )
{
	$site->redirect_403();
}
?>