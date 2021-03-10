<?php 
class  InsertArticle
{
	public $conn;
	public $category_id;
	public $article_url;
	public $origin;
	public $source;
	public $article_title;
	public $title;
	
	public function __construct($category_id, $conn, $article_url, $origin, $source, $article_title, $title)
	{
		$this->conn=$conn; 
		$this->category_id=$category_id; 
		$this->article_url=$article_url; 
		$this->origin=$origin; 
		$this->source=$source; 
		$this->article_title=mysqli_real_escape_string($this->conn, $article_title);  
		$this->title=$title;
	}
	
	private function insert_article()
	{
			
			$path_parts = pathinfo($this->article_url);
			$sql = 'INSERT INTO  '.$this->origin.'_articles SET   category = "'.$this->category_id.'",  source = "'.$this->source.'",  origin_url = "'.$this->article_url.'",  slug = "'.$path_parts['filename'].'", data_added="'.date('c').'" , '.$this->title.' = "'.$this->article_title.'"';
			mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
			return "Добавлена новая статья<br>";
	}
	
	public function insert()
	{
			$sql = 'SELECT id FROM '.$this->origin.'_articles WHERE origin_url = "'.$this->article_url.'"';
			$result = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
			$row = mysqli_fetch_array($result);
			if($row)
			{
				return "Статья уже есть в базе<br>";
			}
			else
			{
				return $this->insert_article();
			}
	}
	
	

	
}