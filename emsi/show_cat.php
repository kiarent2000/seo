<html dir=ltr lang=ua>
<head>
<meta charset=UTF-8 />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<style>
tr
{
border-bottom: 1px grey solid;	
}
td
{
	text-align: center;
	padding-left:  1rem !important;
	padding-right:  1rem !important;
}
a
{
	color: green !important;
}

</style>
<div style="padding-bottom:  3rem !important;"  class="container">  
<?php 
require_once('../includes/config.php');
require_once('../includes/connect.php');
$origin = "emsi";
$start_url = 'http://emsi.com.ua/';


require_once('../includes/config.php');
require_once('../includes/connect.php');
$origin = "emsi";
$sort_by = "body_ua DESC";

$sql = 'SELECT id, category_ua, slug FROM '.$origin.'_categories';

echo '<div style="text-align: center; padding: 1rem;">';

$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
while($row=mysqli_fetch_array($result))
{
	
	echo '<a href="show_cat.php?id='.$row['id'].'&cat_name='.$row['category_ua'].'&origin='.$origin.'&sort_by='.$sort_by.'&slug='.$row['slug'].'">'.$row['category_ua'].'</a> | ';
}


echo '</div>';

 


echo '<h1 style="text-align: center">'.$_GET['cat_name'].'  <a style="cursor:pointer" target="_blank" href="add_article.php?id='.$_GET['id'].'">+</a></h1>';
echo  "<table>";
$articles = (new ShowCat($conn, $_GET['id'], $origin, $_GET['sort_by']))->get();
echo '<tr><td><b>ID</b></td><td><b>Название</b></td><td><b><a  href="show_cat.php?id='.$_GET['id'].'&cat_name='.$_GET['cat_name'].'&origin='.$origin.'&sort_by=body_ua DESC&slug='.$_GET['slug'].'">Статья</a></b></td><td><b><a  href="show_cat.php?id='.$_GET['id'].'&cat_name='.$_GET['cat_name'].'&origin='.$origin.'&sort_by=viewed&slug='.$_GET['slug'].'">Просмотры</a></b></td><td><b><a  href="show_cat.php?id='.$_GET['id'].'&cat_name='.$_GET['cat_name'].'&origin='.$origin.'&sort_by=published DESC&slug='.$_GET['slug'].'">Опубликована</a></b></td><td></td><td><b>Редактрирование</b></td></tr>';
foreach($articles as $article)
	{
		if(!empty($article['body_ua']))
		{
			$body = "есть";
		}
		else
		{
			$body = "";
		}
		if(!empty($article['published']))
		{
			$published = "да";
		}
		else
		{
			$published = "";
		}
		echo '<tr><td>'.$article['id'].'</td><td style="text-align: left"><a href="'.$start_url.$_GET['slug'].'/'.$article['slug'].'.html" target="_blank">'.$article['title_ua'].'</a></td><td>'.$body.'</td><td>'.$article['viewed'].'</td><td style="text-align: center;"
		>'.$published.'</td><td></td><td><a href="edit.php?id='.$article['id'].'" target="_blank">Редактирование</a></td></tr>';
		unset($article['body_ua'], $body, $published);
	}
echo  "</table>";
?>
</div>