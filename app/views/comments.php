<?
require_once 'app/models/user.php';
?>
<?
if( $user->id )
{
?>
<h1>Add Comment</h1>
<div id="add_comment_form">
	<form id="add_comment" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
		<div>
			<div><b>Title:</b></div>
			<div><input type="text" name="mtitle"></div>
		</div>
		<div>
			<div><b>Message Body:</b></div>
			<div><textarea name="body" rows="6" cols="90"></textarea></div>
		</div>
		<div class="hr"><hr></div>
		<div>
			<div><button id="button_add" type="button" onclick="add_comment(mtitle.value, body.value, token.value)">ADD</button></div>
			<!--<div><button id="button_display" type="button" onclick="display_comments()">DISPLAY</button></div>-->
			<div><button id="button_clear" type="reset">CLEAR</button></div>
		</div>
		<input type="hidden" name="token" value="<?= $user->csrftoken; ?>">
	</form>
</div>
<div id="add_comment_status">
	
</div>
<div id="add_comment_results">
	
</div>
<?	
}
?>
<div><h1>Comments</h1></div>
<div id="all_comments">

</div>
<script>
window.onload = function() {
  display_comments();
};
</script>