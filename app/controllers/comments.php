<?
class Controller_comments extends Controller
{
	function do_search()
	{
		$database = new Database();
		$result = array();
		$query = $database->query("SELECT * FROM comments ORDER BY adddt DESC LIMIT 0,10;");
		while($row = $query->fetch_object())
		{
			$result[] = array (	'id' => $row->id,
								'title' => $row->title,
								'body' => $row->body,
								'adddt' => $row->adddt,
								'userid' => $row->userid
				);
		}
		$query->free_result();
		return $result;
	}
}
?>