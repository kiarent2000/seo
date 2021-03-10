<?php 
class  UpdateArticle
{
	public $conn;
	public $article_title;
	public $article_body;
	public $article_id;
	public $article_image;
	public $origin;
	public $category;
	public $slug;
	public $published;
	public $status;
	
	public function __construct($conn, $article_title, $article_body, $article_id, $article_image, $origin,	$category, $slug, $published, $status)
	{
		$this->conn=$conn; 
		$this->article_title=mysqli_real_escape_string($this->conn, $article_title); 
		$this->article_body=mysqli_real_escape_string($this->conn, $article_body); 
		$this->article_id=$article_id; 
		$this->article_image=$article_image; 
		$this->origin=$origin;
		$this->category=$category; 
		$this->slug=$slug; 
		$this->published=$published;
		$this->status=$status;
	}
	
	public function update()
	{
			$sql = 'UPDATE  '.$this->origin.'_articles SET  status = "'.$this->status.'", published = "'.$this->published.'",  title_ua = "'.$this->article_title.'",    body_ua = "'.$this->article_body.'"  ,    category = "'.$this->category.'", image = "'.$this->article_image.'",  slug = "'.$this->slug.'", data_modified="'.date('c').'" WHERE id= '.$this->article_id;
			if(mysqli_query($this->conn, $sql))
			{
				return "Статья сохранена";	
			}
			else
			{
				return "Ошибка сохранения";	
			}
	}
}