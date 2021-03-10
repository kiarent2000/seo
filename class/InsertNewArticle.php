<?php 
class  InsertNewArticle
{
	public $conn;
	public $category_id;
	public $origin;
	public $source;
	public $article_title;
	public $article_body;
	public $slug;
	public $language;
	
	public function __construct($category_id, $conn, $origin, $source, $article_title, $article_body, $slug, $language)
	{
		$this->conn=$conn; 
		$this->category_id=$category_id; 
		$this->origin=$origin; 
		$this->source=$source; 
		$this->article_title=mysqli_real_escape_string($this->conn, $article_title);  
		$this->article_body=mysqli_real_escape_string($this->conn, $article_body);  
		$this->slug=$slug;
		$this->language=$language;
	}
	
	
	public function insert()
	{
			
			$sql = 'INSERT INTO  '.$this->origin.'_articles SET   category = "'.$this->category_id.'",  source = "'.$this->source.'",  title_'.$this->language.' = "'.$this->article_title.'",  body_'.$this->language.' = "'.$this->article_body.'", slug = "'.$this->slug.'", data_added="'.date('c').'" ';
			if(mysqli_query($this->conn, $sql))
			{
				return mysqli_insert_id($this->conn);
			}
			else
			{
				return false;
			}
			
	}
	
}
	
