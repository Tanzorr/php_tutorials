<?php include ("includes/init.php");?>
<?php if (!$session->is_signed_in()) {redirect('login.php');};?>
<?php
if(empty($_GET['id'])) {
    redirect("photo_comments.php");
}
$comment = Comment::find_by_id($_GET['id']);
if ($comment) {
    $comment->delete();
    redirect("photo_comments.php?id={$comment->photo_id}");
}else {
    redirect("photo_comments.php?id={$comment->photo_id}");
}

