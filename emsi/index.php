<html dir=ltr lang=ua>
<head>
<meta charset=UTF-8 />
</head>
<?php 
require_once('includes/config.php');
require_once('includes/connect.php');

$items = (new GetNewItems($conn))->get();

foreach($items as $item)
{
	$id_vitoks = $item['id_vitoks'];
	$vendor_code = $item['vendor_code'];
	$category = $item['category'];
	$price = $item['price'];
	$available = $item['available'];
	$name = $item['name'];
	$description = $item['description'];
	$image = $item['image'];
	$parent_id = $item['parent_id'];
	
	//echo "$id_vitoks	$vendor_code 	$category 	$price 		$available 	$name 	$description 	$image <br>";
	
	$checkNew = (new CheckNewItems($conn, $id_vitoks))->check();
	
	if($checkNew)
	{
		echo "Добавление нового продукта<br>";
		$insert = (new InsertNewItems($conn, $id_vitoks, $vendor_code, $price, $image, $available))->insert(); //добавление нового продукта в базу
		echo "Товар $insert добавлен <br>";
		$insert_description = (new InsertDescription($conn, $insert, $name, $description))->insert(); //добавление описания
		echo $insert_description;
		$insert_category = (new InsertCategory($conn, $insert, $category, $parent_id))->insert(); //добавление категории
		echo $insert_category;
		$insert_store = (new InsertStore($conn, $insert))->insert(); //добавление магазина
		echo $insert_store;
		$insert_layout = (new InsertLayout($conn, $insert))->insert(); //добавление layout
		echo $insert_layout;
		$update_pre_base = (new UpdatePreBase($conn, $id_vitoks))->update(); //обновление предварительной базы
		echo $update_pre_base;
	}
	else
	{
		echo "Продукт $id_vitoks уже ест в базе<br>";
	}
}




$images = (new GetAllImages($conn))->get();

foreach($images as $image)
{
	$base_image =  'cristals.com.ua/www/image/catalog/'.basename($image);
	
	if (in_array($base_image, $contents_photo))
	{
		//echo "Картинка $base_image уже есть в базе<br>";
	}
	else
	{
		echo "Новая картинка $image<br>";
		$upload = ftp_put($conn_id, $base_image , $image, FTP_BINARY);
	}
	
	
}