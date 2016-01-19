<?
class Model_phone extends Model
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
		if( isset($_POST['title']) )
		{
			if( strlen( $_POST['title'] )>80 )
			{
				$this->title=substr($_POST['title'], 0, 80) . "...";
			}
			else
			{
				$this->title=$_POST['title'];	
			}
		}
		if( isset($_POST['price']) )
		{
			$this->price=md5($_POST['price']);
		}
		if( isset($_POST['descr']) )
		{
			$this->descr=$_POST['descr'];
		}
		if( isset($_POST['vcode']) )
		{
			$this->vcode=$_POST['vcode'];
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
			$query_s = "INSERT INTO phones SET price='$this->price', title='$this->title', descr='$this->descr', vcode=$this->vcode;";
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

	function validate()
	{
		if ( !$this->title || !$this->price || !$this->vcode )	// TODO add more login/password validation
		{
			return false;
		}
		if ( intval($this->price) <= 0 || intval($this->vcode) <= 0 )
		{
			return false;
		}
		return true;
	}
}
?>