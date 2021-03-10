<?php 
class  GetCategoryPage
{
	public $category_url;
	public $category_id;
	public $muster;
	
	public function __construct($category_id, $category_url, $muster)
	{
		$this->category_url=$category_url; 
		$this->category_id=$category_id; 
		$this->muster=$muster; 
	}
	
	public function get()
	{
		$category_page = file_get_contents($this->category_url);
		
		preg_match_all($this->muster, $category_page, $articles, PREG_SET_ORDER);
		foreach ($articles as $article) 
			{
				$article_url = $article[2];
				$article_title = $article[4];
				$result[] = array('article_url'=>$article_url, 'category_id'=>$this->category_id, 'article_title'=>$article_title);
			}	
		return $result;
	}
}