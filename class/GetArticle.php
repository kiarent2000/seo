<?php 
class  GetArticle
{
	public $conn;
	public $id;
	public $origin;

	public function __construct($conn, $id, $origin)
	{
		$this->conn=$conn; 
		$this->id=$id; 
		$this->origin=$origin; 
	}
	
	public function get()
	{
		$sql = 'SELECT * FROM '.$this->origin.'_articles WHERE id = '.$this->id;
		$result = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
		$row = mysqli_fetch_array($result);
		$article = array('title_ru' => $row['title_ru'], 'title_ua' => $row['title_ua'] , 'body_ru' => $row['body_ru'], 'body_ua' => $row['body_ua'], 'category' => $row['category'], 'status' => $row['status'], 'slug' => $row['slug'], 'image' => $row['image'], 'published' => $row['published'], 'viewed' => $row['viewed']);
		return $article;
	}
}