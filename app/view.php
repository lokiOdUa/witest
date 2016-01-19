<?
class View
{
	function render_comments($results, $datatype)
	{
		require("app/models/user.php");
		foreach ($results as $result)
		{
			include "app/views/comments_single.php";
		}
	}

	function render_login()
	{
		$this->render_header();
		include 'app/views/'.$template_view;
		$this->render_footer();
	}

	function render_result($results, $datatype)
	{
		if( $datatype == "json" )
		{
			echo json_encode(array ( 'data' => $results ) );
		}
		else
		{
			foreach ($results as $result)
			{
				include "app/views/result_single.php";
			}
		}
	}
}
?>