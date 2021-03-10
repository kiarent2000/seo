<?php 
class  InsertArticleBody
{
	public $conn;
	public $article_body;
	public $article_id;
	public $article_image;
	public $origin;
	public $body;
	
	public function __construct($article_body, $conn, $article_id,  $article_image, $origin, $body)
	{
		$this->conn=$conn; 
		$this->article_body=mysqli_real_escape_string($this->conn, $article_body); 
		$this->article_id=$article_id; 
		$this->article_image=$article_image; 
		$this->origin=$origin;
		$this->body=$body;
	}
	
	public function insert()
	{
			$sql = 'UPDATE  '.$this->origin.'_articles SET   '.$this->body.' = "'.$this->article_body.'",   image = "'.$this->article_image.'", data_modified="'.date('c').'" WHERE id= '.$this->article_id;
			mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
			return "Добавлена новая статья<br>";					
	}
}