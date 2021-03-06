<?php
class GetAllImages
{
	private $conn;
	
	public function __construct($conn)
    {
		$this->sql = 'SELECT image from base';
		$this->conn = $conn;
	}
	
	public function get() {
	 		$result = mysqli_query($this->conn, $this->sql) or die (mysqli_error($this->conn));
			while($row = mysqli_fetch_array($result))
			{
						
				$images[]= $row['image'];
			}
		
		return $images;
}
}
