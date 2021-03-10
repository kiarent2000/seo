<html dir=ltr lang=ua>
<head>
<meta charset=UTF-8 />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<style>
input, textarea, select
{
	min-width: 100%;
	padding: 1rem;
}

#button
{
	position: fixed;
	right: 0;
	top: 45%;
	max-width: 150px;
	min-width: 150px;
	padding: 2rem 1rem;
	background-color: green;
	border-radius: 5px 0 0 5px ;
	border: 1px grey solid;
	color: white;
	text-align: center;
	cursor: pointer;
}




#message
{
	position: fixed;
	right: 0;
	top: 35%;
	color: green;
	padding: 2rem;
}

span
{
		font-size: 1.6rem;
}

#image_template
{
	cursor: copy;
}

</style>
</head>
<div style="padding-bottom: 3rem;"  class="container">  
<?php 
require_once('../includes/config.php');
require_once('../includes/connect.php');
$origin = "emsi";
$start_url = 'http://emsi.com.ua/';


$article = (new GetArticle($conn, $_GET['id'], $origin))->get();



if(empty($article['viewed']))
{
	$article['viewed'] = "0";
}


?>
<form action="save.php" method="POST" id="myForm">
<h1 style="text-align: center; margin-top: 1rem;">Просмотр статьи <?php echo $_GET['id']; ?><span> (просмотры: <?php echo $article['viewed']; ?>)</span> 
</h1>


<?php echo $article['body_ua']; ?>
	



</div>

