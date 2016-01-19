<?
class Controller_user extends Controller
{
	public $ogin = "";
	public $datatype="html";

	function check_form_search()
	{
		if( isset($_POST['ogin']) )
		{
			/*
			 * Search by descr is vulnerable to SQL Injections
			 */
			$this->ogin=$_POST['ogin'];
			return true;
		}
		return false;
	}

	function do_search_string()
	{
		$output = array('amount' => '0');
		$database = new Database();
		$query_s = "SELECT COUNT(id) AS amount FROM users WHERE login LIKE '" . $this->ogin . "'";
		$query = $database->query($query_s);
		if($row = $query->fetch_object())
		{
			$output = array('amount' => $row->amount);
		}
		$query->free_result();	
		return $output;
	}
}
?>