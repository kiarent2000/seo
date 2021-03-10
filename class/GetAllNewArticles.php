<?php 
class  GetAllNewArticles
{
	public $conn;
	public $body;
	public $origin;

	public function __construct($conn, $body, $origin)
	{
		$this->conn=$conn; 
		$this->body=$body; 
		$this->origin=$origin; 
	}
	
	public function get()
	{
		$sql = 'SELECT id, origin_url FROM '.$this->origin.'_articles WHERE '.$this->body.' IS NULL ';
		$result = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
		while($row = mysqli_fetch_array($result))
		{
			$articles[] = array('id' => $row['id'], 'origin_url' => $row['origin_url'] );
		}
		return $articles;
	}
	
	
		public function getArticlesToClean()
	{
		$sql = 'SELECT id, '.$this->body.' FROM '.$this->origin.'_articles WHERE '.$this->body.' IS NOT NULL ';
		$result = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
		while($row = mysqli_fetch_array($result))
		{
			$articles[] = array('id' => $row['id'], 'body' => $row[$this->body] );
		}
		return $articles;
	}
	
}