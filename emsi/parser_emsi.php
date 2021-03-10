<html dir=ltr lang=ua>
<head>
<meta charset=UTF-8 />
</head>
<?php 
require_once('../includes/config.php');
require_once('../includes/connect.php');
$origin = "emsi";
$source = "emsi.com.ua";
$muster = '/(catItemTitle\"><a href=\")(.*)(\">)(.*)(<\/a>)/Ums';
$title = "title_ua";

#############################Parameters##############################################
$categiries[]=array('start_category_url'=> 'http://emsi.com.ua/rizne.html', 'muster__category_url' => 'http://emsi.com.ua/rizne_page55555.html',  'total_pages' => 603, 'category_id' => 1);
$categiries[]=array('start_category_url'=> 'http://emsi.com.ua/recepti.html', 'muster__category_url' => 'http://emsi.com.ua/recepti_page55555.html',  'total_pages' => 79, 'category_id' => 2);
$categiries[]=array('start_category_url'=> 'http://emsi.com.ua/krasa-ta-zdorov-ja.html', 'muster__category_url' => 'http://emsi.com.ua/krasa-ta-zdorov-ja_page55555.html',  'total_pages' => 478, 'category_id' => 3);
$categiries[]=array('start_category_url'=> 'http://emsi.com.ua/dieti.html', 'muster__category_url' => 'http://emsi.com.ua/dieti_page55555.html',  'total_pages' => 53, 'category_id' => 4);
$categiries[]=array('start_category_url'=> 'http://emsi.com.ua/cikavenke.html', 'muster__category_url' => 'http://emsi.com.ua/cikavenke_page55555.html',  'total_pages' => 516, 'category_id' => 5);
$categiries[]=array('start_category_url'=> 'http://emsi.com.ua/index.html', 'muster__category_url' => 'http://emsi.com.ua/index_page55555.html',  'total_pages' => 48, 'category_id' => 6);

$all_articles_pages=array();
foreach ($categiries as $categiry)
	{
		$all_articles_pages = array_merge($all_articles_pages, (new GetAllArticlesInCategory($categiry['category_id'], $categiry['start_category_url'], $categiry['muster__category_url'], $categiry['total_pages']))->get());
	}

$category_page=array();
foreach($all_articles_pages as $articles_page)
	{	
		$category_page =  array_merge($category_page, (new GetCategoryPage($articles_page['category_id'], $articles_page['category_url'], $muster))->get());
	}

foreach($category_page as $article)
	{	
		$article_url = 'http://emsi.com.ua/'.$article['article_url'];
		$insert = (new InsertArticle($article['category_id'], $conn,  $article_url, $origin, $source, $article['article_title'], $title))->insert();
		echo $insert;
	}
