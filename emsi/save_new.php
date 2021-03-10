<?php 
require_once('../includes/config.php');
require_once('../includes/connect.php');
require_once('../class/Slug.php');
$origin = "emsi";
$source = "emsi.com.ua";
$language = "ua";

if(empty($_POST['title_ua']))
{
	echo "Пустой заголовок! Добавление статьи невозможно<br>";
	exit;
}


$slug =  url_slug($_POST['title_ua'], array('transliterate' => true));

$insert = (new InsertNewArticle($_POST['category'], $conn, $origin, $source, $_POST['title_ua'], $_POST['body_ua'], $slug, $language))->insert();

if(empty($insert))
{
	echo "Ошибка добавления статьи!!";
}
else
{
	echo '<h2 style="text-align: center" ><a href="edit.php?id='.$insert.'">Добавлена новая статья '.$insert.'</a></h2>';
}






?>