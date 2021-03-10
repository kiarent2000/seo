<html dir=ltr lang=ua>
<head>
<meta charset=UTF-8 />
</head>
<?php 
require_once('../includes/config.php');
require_once('../includes/connect.php');

$origin = "emsi";
$body = "body_ua";
$existing_images = scandir('images');
$source_link = 'http://emsi.com.ua/images/';

$articles = (new GetAllNewArticles($conn, $body , $origin))->getArticlesToClean();
foreach($articles as $article)
	{
		$article_images = (new Cleaner($article['body']))->getImages();
	    
		if(!empty($article_images))
		{
		foreach($article_images as $article_image)
		{
			$article_image = basename($article_image);
			if(!in_array($article_image, $existing_images))
			{
					$source = $source_link.$article_image;
					$destination = 'images/'.$article_image;
					if (!copy($source, $destination)) 
					{
						echo "не удалось скопировать $article_image...\n";
					}
			}
		}
		}
	}