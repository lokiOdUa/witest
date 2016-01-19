<?
class User
{
	public $id = 0;
	public $seid = 0;	// named seid(int) to avoid collisions with sid(string)
	public $is_admin = 0;
	public $login = "";
	public $username = "";
	public $csrftoken = "";
	private $database;

	function __construct()
	{
		$userdata = "";
 		$this->database = new Database();
		if( isset($_COOKIE['sid']) && preg_match('/^[0-9a-f]{32}$/i', $_COOKIE['sid'] ) )
		{
			$userdata = $this->continue_session($_COOKIE['sid']);
		}
		return $userdata;
	}

	/*
	* This is example of method vulnerable to SQL injection
	* To avoid, we should match cookie value before usage
	* Here we use MD5 hashes as sids, so the following code can help:
	* if ( preg_match('/^[0-9a-f]{32}$/i', $_COOKIE['sid'] ) )
	*/
	function check_logged_in()
	{
		$userid = false;
		if( !isset( $_COOKIE['sid'] ) )
		{
			return false;
		}
		else
		{
			$query_s = "SELECT id, csrftoken FROM sessions WHERE sid='" . $_COOKIE['sid'] . "'";
			$query = $this->database->query($query_s);
			if($row = $query->fetch_object())
			{
				$userid = $row->id;
				$this->seid = $row->id;
				$this->csrftoken = $row->csrftoken;
//				echo " ||| Got token from check_logged_in: $this->csrftoken ||| ";
				$this->database->execute("UPDATE sessions SET expires='" . $this->get_session_expire_time() . "' WHERE sid='" . $_COOKIE['sid'] . "';");
			}
			else
			{
				setcookie("sid", NULL);
			}
			$query->free_result();
		}
		return $userid;
	}

	function check_csrftoken( $token, $remove )
	{
		$sid = false;
		$query_s = "SELECT sid FROM sessions WHERE csrftoken='$token';";
		$query = $this->database->query($query_s);
		if($row = $query->fetch_object())
		{
			$sid = $row->sid;
			if( $remove )
			{
				$this->database->execute("UPDATE sessions SET csrftoken='' WHERE sid='$sid';");
				$this->csrftoken = "";	
			}
		}
		$query->free_result();
		return $sid;
	}

	function continue_session( $sid )
	{
		$userdata = "";
		if( $sid )
		{
			$query_s = "SELECT id, uid, csrftoken FROM sessions WHERE sid='" . $sid . "';";
			$query = $this->database->query($query_s);
			if($row = $query->fetch_object())
			{
				$this->seid = $row->id;
				$this->csrftoken = $row->csrftoken;
//				echo " ||| Got token from continue_session: $this->csrftoken ||| ";
				if( $row->uid )
				{
					$this->id = $row->uid;
					$query_s = "SELECT is_admin, login, username FROM users WHERE id=" . $row->uid . ";";
					$query0 = $this->database->query($query_s);
					if($row0 = $query0->fetch_object())
					{
						$this->is_admin = $row0->is_admin;
						$this->login = $row0->login;
						$this->username = $row0->username;
						$userdata = array(
								'id' => $row->id,
								'is_admin' => $row0->is_admin,
								'login' => $row0->login,
								'username' => $row0->username
							);
					}
					$query0->free_result();
				}
			}
			$query->free_result();
		}

		return $userdata;
	}

	function get_id()
	{
		return $this->id;
	}

	function generate_csrftoken()
	{
		$token = md5( microtime() . "||" . $this->userid );
		$this->csrftoken = $token;
		$this->database->execute("UPDATE sessions SET csrftoken='$token' WHERE id='$this->seid';");
	}

	function get_is_admin()
	{
		return $this->is_admin;
	}

	function get_session_expire_time()
	{
		return date( 'Y-m-d H:i:s', time() + 3600 );
	}
}
?>