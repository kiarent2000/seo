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



span
{
		font-size: 1.6rem;
}


</style>
</head>
<div style="padding-bottom: 3rem;"  class="container">  
<?php 
require_once('../includes/config.php');
require_once('../includes/connect.php');
$origin = "emsi";
$start_url = 'http://emsi.com.ua/';




?>
<form action="save_new.php" method="POST" id="myForm">
<h1 style="text-align: center; margin-top: 1rem;">Добавление новой статьи в категорию  <?php
	$sql = 'SELECT category_ua FROM '.$origin.'_categories WHERE id = '.$_GET['id'];
	$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
	$row=mysqli_fetch_array($result);
	echo $row['category_ua'];
	?> </h1>





<br>
<p> <input type="text" name="title_ua" size="20"  value=""></p>
	<br>
	
<p> <textarea rows="30" name="body_ua" cols="20"  ></textarea></p>
	
<p> Категория:</p><p><select size="1" name="category">
	
	<option value="<?php echo $_GET['id']; ?>" selected>
	
	
	<?php
	$sql = 'SELECT category_ua FROM '.$origin.'_categories WHERE id = '.$_GET['id'];
	$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
	$row=mysqli_fetch_array($result);
	echo $row['category_ua'];
	?>
	
	</option>
	
	
	<?php
	$sql = 'SELECT id, category_ua, slug FROM '.$origin.'_categories';
	$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
	while($row=mysqli_fetch_array($result))
	{
		echo '<option value="'.$row['id'].'" >'.$row['category_ua'].'</option>';
	}
	?>
	
	
	
	</select>	</p>	
	

<p> <input type="submit"  size="20"  value="Добавить"></p>

	



</form>



</div>


