<html dir=ltr lang=ua>
<head>
<meta charset=UTF-8 />
</head>
<?php 
require_once('../includes/config.php');
require_once('../includes/connect.php');

$body = "body_ua";
$title = "title_ua";
$origin = "emsi";
$muster_body = '/(<div class=\"catItemBody\">)(.*)(<h4>Схожі статті:<\/h4>)/Ums';
$muster_img = '/(og:image)(.*)(>)/Ums';

$articles = (new GetAllNewArticles($conn, $body , $origin))->get();

$articles_bodies=array();
foreach($articles as $article)
	{
		$articles_bodies = array_merge($articles_bodies, (new GetArticleContent($article['id'], $article['origin_url'], $muster_body, $muster_img))->get());
	}

foreach($articles_bodies as $articles_body)
{
	$insert = (new InsertArticleBody($articles_body['article_body'], $conn,  $articles_body['article_id'], '', $origin, $body))->insert();
	echo $insert;
}
