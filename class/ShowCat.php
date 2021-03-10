<?php 
class  ShowCat
{
	public $conn;
	public $id;
	public $origin;
	public $sort_by;

	public function __construct($conn, $id, $origin, $sort_by)
	{
		$this->conn=$conn; 
		$this->id=$id; 
		$this->origin=$origin; 
		$this->sort_by=$sort_by;
	}
	
	public function get()
	{
		$sql = 'SELECT id, title_ru, title_ua, body_ru, body_ua, published, viewed, slug FROM '.$this->origin.'_articles WHERE (status IS NULL or status = "" ) and  category = '.$this->id.' ORDER BY '.$this->sort_by;
		$result = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
		while($row = mysqli_fetch_array($result))
		{
			$articles[] = array('id' => $row['id'], 'title_ru' => $row['title_ru'], 'title_ua' => $row['title_ua'], 'body_ru' => $row['body_ru'], 'body_ua' => $row['body_ua'], 'published' => $row['published'], 'viewed' => $row['viewed'], 'slug' => $row['slug'] );
		}
		return $articles;
	}
}