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

//print_r($article);
//$article = array('title_ru' => $row['title_ru'], 'title_ua' => $row['title_ua'] , 'body_ru' => $row['body_ru'], 'body_ua' => $row['body_ua'], 'category' => $row['category'], 'status' => $row['status'], 'slug' => $row['slug'], 'image' => $row['image'], 'published' => $row['published'], 'viewed' => $row['viewed']);


if(empty($article['viewed']))
{
	$article['viewed'] = "0";
}
?>
<form action="save.php" method="POST" id="myForm">
<h1 style="text-align: center; margin-top: 1rem;">Редактирование статьи <?php echo $_GET['id']; ?><span> (просмотры: <?php echo $article['viewed']; ?>)</span> 
<a href="view.php?id=<?php echo $_GET['id']; ?>" target="_blank" ><img style="max-width: 50px;" src="img/eye.jpg"></a></h1>




	<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
<br>
<p> <input type="text" name="title_ua" size="20"  value="<?php echo $article['title_ua']; ?>"></p>
	<br>
	
<p>	<input id="image_template" style="max-width: 95% !important; min-width: 95% !important;" type="text"   name="image_template" value='<img style="width: 100%" src="images/<?php echo $article['slug']; ?>_.jpg" alt="<?php echo $article['title_ua']; ?>" title="<?php echo $article['title_ua']; ?>">'><img onclick="copytext()"  src="img/save.jpg" style="cursor: copy; max-width: 50px"></p>
	
	
	
	<div style="display: inline-block; min-width: 50px; min-height: 50px; border: 1px grey solid; border-radius: 5px; text-align: center; padding-top:  10px !important; margin-bottom:  10px !important; cursor: pointer;" id="tagP" class="" onclick="copyP()"> P </div>
	
	
	<div style="display: inline-block; min-width: 50px; min-height: 50px; border: 1px grey solid; border-radius: 5px; text-align: center; padding-top:  10px !important; margin-bottom:  10px !important; cursor: pointer;" id="tagP" class="" onclick="copyH1()"> H1 </div>
	
	<div style="display: inline-block; min-width: 50px; min-height: 50px; border: 1px grey solid; border-radius: 5px; text-align: center; padding-top:  10px !important; margin-bottom:  10px !important; cursor: pointer;" id="tagP" class="" onclick="copyH2()"> H2 </div>
	
	<div style="display: inline-block; min-width: 50px; min-height: 50px; border: 1px grey solid; border-radius: 5px; text-align: center; padding-top:  10px !important; margin-bottom:  10px !important; cursor: pointer;" id="tagP" class="" onclick="copyH3()"> H3 </div>
	
	<div style="display: inline-block; min-width: 50px; min-height: 50px; border: 1px grey solid; border-radius: 5px; text-align: center; padding-top:  10px !important; margin-bottom:  10px !important; cursor: pointer;" id="tagP" class="" onclick="copyList()"> L </div>
	
	<div style="display: inline-block; min-width: 50px; min-height: 50px; border: 1px grey solid; border-radius: 5px; text-align: center; padding-top:  10px !important; margin-bottom:  10px !important; cursor: pointer;" id="tagP" class="" onclick="copyblockquote()"> BL </div>
	
<p> <textarea rows="30" name="body_ua" cols="20"  ><?php echo $article['body_ua']; ?></textarea></p>
	
<p>Slug:</p><p> <input type="text" name="slug" size="20"  value="<?php echo $article['slug']; ?>"></p>	

<p>Изображение:  images/<?php echo $article['slug']; ?>.jpg

</p><p> <input type="text" name="image" size="20"  value="<?php echo $article['image']; ?>"></p>	
	

<p> Категория:</p><p><select size="1" name="category">
	
	<option value="<?php echo $article['category']; ?>" selected>
	
	
	<?php
	$sql = 'SELECT category_ua FROM '.$origin.'_categories WHERE id = '.$article['category'];
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
	
<p>	
<select size="1" name="published"> 

<?php
if($article['published']==1)
{
	$published = "Опубликована";
}
else
{
	$published = "Не опубликована";
}
?>


<option value="<?php echo $article['published']; ?>" selected><?php echo $published; ?>	</option>
<option value="1" >Опубликована</option>
<option value="" >Не опубликована</option>
</select>
	</p>	

<p>	
<select size="1" name="status"> 
<option value="" selected>Статья в базе</option>
<option value="1" >Статья удалена</option>

</select>
	</p>	

<br>

	<div  id="button">Сохранить</div>
	
	<div  id="message"></div>




</form>



</div>



<script>

function formSend()
{
// 1. Создаём новый XMLHttpRequest-объект
let xhr = new XMLHttpRequest();

url = 'save.php';

let formData = new FormData(document.forms.myForm);


xhr.open('POST', url);


xhr.send(formData);

function closeMessage()
{
	let succes = document.getElementById('message');
    succes.innerHTML = ''; 
}

xhr.onload = function() {
  if (xhr.status != 200) { // анализируем HTTP-статус ответа, если статус не 200, то произошла ошибка
    alert(`Ошибка ${xhr.status}: ${xhr.statusText}`); // Например, 404: Not Found
  } else { // если всё прошло гладко, выводим результат
  let succes = document.getElementById('message');
    succes.innerHTML = xhr.response; // response -- это ответ сервера
	setTimeout(closeMessage, 2000);
  }
};


xhr.onerror = function() {
	let error = document.getElementById('message');
    error.innerHTML = "Запрос не удался";	
};
}






let send = document.getElementById('button');
send.addEventListener('click', formSend);


let image_template = document.getElementById('image_template');


function copytext()
{
navigator.clipboard.writeText(image_template.value);
}


function copyP()
{
let p = '<p></p>';
navigator.clipboard.writeText(p);
}

function copyList()
{
let p = '<ul><li></li><li></li><li></li></ul>';

navigator.clipboard.writeText(p);
}

function copyblockquote()
{
let p = '<blockquote></blockquote>';
navigator.clipboard.writeText(p);
}

function copyH1()
{
let p = '<h1 style="" class=""></h1>';
navigator.clipboard.writeText(p);
}

function copyH2()
{
let p = '<h2 style="" class=""></h2>';
navigator.clipboard.writeText(p);
}

function copyH3()
{
let p = '<h3 style="" class=""></h3>';
navigator.clipboard.writeText(p);
}
</script>