<?
class Controller_login extends Controller
{
	private $ogin = "";
	private $sword = "";

	function main()
	{
	}

	/*
	 * If we do have seems-to-be-correct credentials in $_POST data, then initialize variables with these values and return true
	 * Otherwise return false
	 */
	function check_credentials()
	{
		if( isset( $_POST["ogin"] ) )
		{
			$this->ogin = $_POST["ogin"];
		}
		if( isset( $_POST["sword"] ) )
		{
			$this->sword = $_POST["sword"];
		}

		if( strlen($this->ogin) >= 4 && strlen($this->sword) >= 6 )
		{
			return true;
		}
		return false;
	}

	function do_login($user)
	{
		$database = new Database();
		/*
		* This is vulnerable to SQL injection
		* To avoid, we should check login and password before using
		*/
		$query_s = "SELECT id AS userid FROM users WHERE login='$this->ogin' AND password='" . md5($this->sword) . "';";
		$query = $database->query($query_s);
		if($row = $query->fetch_object())
		{
			$time = time();
			$sid = md5( $user->id . "::" . microtime() );
			$token = md5( microtime() . "||" . $user->id );
			$query_s = "INSERT INTO sessions SET sid='" . $sid . "', uid=" . $row->userid . ", csrftoken='" . $token . "', expires='" . $user->get_session_expire_time() . "';";
			$database->execute($query_s);
			setcookie("sid", $sid);
			$database->execute("DELETE FROM sessions WHERE expires<NOW();");	// TODO move functionality into cron before production, requires server setup
			$query->free_result();
			return true;
		}
		else
		{
			$query->free_result();
		}
		return false;
	}

	function do_logout($user)
	{
		if ( $user->check_logged_in() )
		{
			setcookie("redir", NULL);
			setcookie("sid", NULL);
			$database = new Database();
			$database->execute("DELETE FROM sessions WHERE sid='" . $_COOKIE['sid'] . "';");
		}
		header( 'Location: /login.php' ); 
		exit();
	}
}
?>