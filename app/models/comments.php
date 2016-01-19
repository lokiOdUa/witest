<?
class Model_comments extends Model
{
	private $id = 0;
	private $title;
	private $body;
	private $adddt;
	private $userid;

	function __construct()
	{
		
	}

	function check_form($user)
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
		if( isset($_POST['body']) )
		{
			$this->body=$_POST['body'];
		}
		$this->adddt = date('Y-m-d H:i:s', time());
		$this->userid=$user->id;
		if( !isset($_POST['token']) || ( $_POST['token'] <> $user->csrftoken ) )
		{
			return false;
		}
		return $this->validate();
	}

	function create()
	{
		$retval = array( "state" => 500 );
		$database = new Database;
		$query_s = "INSERT INTO comments SET title='$this->title', body='$this->body', userid='$this->userid';";
		if( $database->execute($query_s) )
		{
			$retval = array( "state" => 200,
							 "id" => $database->get_insert_id() );
		}
		$query->free_result;
		return $retval;
	}

	function get_all()
	{
		$retval = array( "state" => 500 );
		$comments = array();
		$database = new Database;
		$query_s = "SELECT * FROM comments ORDER BY adddt DESC;";
		$query = $database->query($query_s);
		while($row = $query->fetch_object())
		{
			$comments[] = $row;

		}
		$query->free_result;
		if( count($comments) )
		{
			return $comments;
		}
		return $retval;
	}

	function validate()
	{
		if ( !$this->title || !$this->body || !$this->userid )	// TODO add more validation
		{
			return false;
		}
		return true;
	}
}
?>