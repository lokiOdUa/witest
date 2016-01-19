<?
class Controller_result extends Controller
{
	public $pricefrom=0;
	public $priceto=0;
	public $vcode=0;
	public $descr="";
	public $datatype="html";
	public $query_s;

	function main()
	{
	}

	function check_form()
	{
		if( isset($_POST['pricefrom']) )
		{
			$this->pricefrom=intval($_POST['pricefrom']);
		}
		if( isset($_POST['priceto']) )
		{
			$this->priceto=intval($_POST['priceto']);
		}
		if( isset($_POST['vcode']) )
		{
			$this->vcode=intval($_POST['vcode']);
		}
		if( isset($_POST['descr']) )
		{
			/*
			 * Search by descr is vulnerable to SQL Injections
			 */
			$this->descr=$_POST['descr'];
		}
		if( isset($_POST['datatype']) && $_POST['datatype']=="json" )
		{
			$this->datatype="json";
		}
	}

	function do_search()
	{
		$database = new Database();
		$result = array();
		$query = $database->query($this->query_s);
		while($row = $query->fetch_object())
		{
			$result[] = array (	'id' => $row->id,
								'price' => $row->price,
								'title' => $row->title,
								'descr' => $row->descr,
								'vcode' => $row->vcode
				);
		}
		$query->free_result();
		return $result;
	}

	function prepare_query()
	{
		$this->query_s = "SELECT * FROM phones WHERE hidden=0";
		if( $this->pricefrom>0 )
		{
			$this->query_s .= " AND price>=" . $this->pricefrom;
		}
		if( $this->priceto>0 )
		{
			$this->query_s .= " AND price<=" . $this->priceto;
		}
		if( $this->vcode>0 )
		{
			$this->query_s .= " AND vcode=" . $this->vcode;
		}
		if( $this->descr<>"" )
		{
			$this->query_s .= " AND (title LIKE '%$this->descr%' OR descr LIKE '%$this->descr%')";
		}
		$this->query_s .= " ORDER BY RAND();";
	}
}
?>