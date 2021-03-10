<html dir=ltr lang=ua>
<head>
<meta charset=UTF-8 />
</head>
<?php 
require_once('../includes/config.php');
require_once('../includes/connect.php');

$origin = "emsi";
$body = "body_ua";

$articles = (new GetAllNewArticles($conn, $body , $origin))->getArticlesToClean();

foreach($articles as $article)
	{
		$article_body = (new Cleaner($article['body']))->cleanScript();
		$article_body = trim((new Cleaner($article_body))->cleanDiv());
		$article_body = (new Cleaner($article_body))->cleanSpan();
		
		$insert = (new InsertArticleBody($article_body, $conn,  $article['id'], '', $origin, $body))->insert();
	    echo $insert;
	}
	
	
	
	
	