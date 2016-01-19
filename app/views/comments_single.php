<?
	$msg_user = new Model_user;
	$msg_user->load( $result['userid'] );
?>
	<div id="comment_<?= $result['id'];?>">
		<div><b><?= $result['title']; ?></b></div>
		<div><?= $result['body']; ?></div>
		<div><b>Author:</b> <?= $msg_user->get_username(); ?></div>
		<div><b>Date:</b> <?= $result['adddt']; ?></div>
		<div class="hr"><hr></div>
	</div>
