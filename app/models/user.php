<?
class Model_user extends Model
{
	private $id = 0;
	private $login;
	private $password;
	private $username;
	private $is_admin;

	function __construct()
	{
		
	}

	function check_form()
	{
		if( isset($_POST['login']) )
		{
			$this->login=$_POST['login'];
		}
		if( isset($_POST['password']) )
		{
			$this->password=md5($_POST['password']);
		}
		if( isset($_POST['username']) )
		{
			$this->username=$_POST['username'];
		}
		if( isset($_POST['usertype']) )
		{
			$this->is_admin = $_POST['usertype'] == "admin" ? 1 : 0 ;
		}
		return $this->validate();
	}

	function create()
	{
		$retval = array( "state" => 500 );
		$database = new Database;
		$query_s = "SELECT * FROM users WHERE login='$this->login'";
		$query = $database->query($query_s);
		if($row = $query->fetch_object())
		{
			// TODO add some status info here
		}
		else
		{
			$query_s = "INSERT INTO users SET login='$this->login', password='$this->password', username='$this->username', is_admin=$this->is_admin;";
			// TODO add some logging here before production
			if( $database->execute($query_s) )
			{
				$retval = array( "state" => 200,
								 "id" => $database->get_insert_id() );
			}
		}
		$query->free_result;
		return $retval;
	}

	function get_id()
	{
		return $this->id;
	}
	function get_username()
	{
		return $this->username;
	}

	function load($userid)
	{
		$database = new Database;
		$query_s = "SELECT * FROM users WHERE id=$userid";
		$query = $database->query($query_s);
		if($row = $query->fetch_object())
		{
			$this->id = $row->id;
			$this->login = $row->login;
			$this->password = $row->password;
			$this->username = $row->username;
			$this->is_admin = $row->is_admin;
			return true;
		}
		$query->free_result;
		return false;
	}

	function validate()
	{
		if ( !$this->login || !$this->password )	// TODO add more validation
		{
			return false;
		}
		return true;
	}
}
?>