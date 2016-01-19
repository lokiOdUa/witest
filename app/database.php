<?
require_once 'conf/_dbconfig.php';

class Query
{
	public $result;
	public $connection;

	function __construct($connection, $result)
	{
		$this->connection = $connection;
		$this->result = $result;
	}

	function free_result()
	{
		if(is_resource($this->result))
		{
			mysqli_free_result($this->result);
		}
	}

	function num_rows()
	{
		return mysqli_num_rows($this->result);
	}

	function fetch_row()
	{
		return mysqli_fetch_row($this->result);
	}

	function fetch_object()
	{
		return mysqli_fetch_object($this->result);
	}
}

class Database
{
	public $SQL_server = "";
	public $SQL_user = "";
	public $SQL_pass = "";
	public $SQL_database = "";
	public $connection = -1;

	function __construct()
	{
		$dbconfig = new DBConfig;
		$this->SQL_server = $dbconfig->SQL_server;
		$this->SQL_user = $dbconfig->SQL_user;
		$this->SQL_pass = $dbconfig->SQL_pass;
		$this->SQL_database = $dbconfig->SQL_database;
		$this->connect();
	}

	function connect()
	{
		if($this->connection==-1)
		{
			$this->connection = mysqli_connect( $this->SQL_server, $this->SQL_user, $this->SQL_pass, $this->SQL_database )
				or die ("Could not connect :" . mysqli_error());
		}
		mysqli_query ($this->connection, "SET CHARACTER SET utf8");
	}

	function execute($query_string)
	{
		$this->connect();
		$query_result = mysqli_query( $this->connection, $query_string )
			or die("Invalid query :'".$query_string."' ".mysqli_error($this->connection));
		return mysqli_affected_rows( $this->connection );
	}

	function get_insert_id()
	{
		return mysqli_insert_id($this->connection);
	}

	function query($query_string)
	{
		$this->connect();
		$query_result = mysqli_query( $this->connection, $query_string )
			or die("Invalid query :'".$query_string."' ".mysqli_error($this->connection));
		return new Query($this->connection, $query_result);
	}
}
?>