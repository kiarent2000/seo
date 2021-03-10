<?php 
require_once('../includes/config.php');
require_once('../includes/connect.php');
$origin = "emsi";
$save  = (new UpdateArticle($conn, $_POST['title_ua'], $_POST['body_ua'], $_POST['id'], $_POST['image'], $origin,	$_POST['category'],  $_POST['slug'],  $_POST['published'],  $_POST['status']))->update();
echo $save;
?>