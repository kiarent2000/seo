<?php
class CheckNewItems
{
	private $conn;
	private $id_vitoks;
	
	public function __construct($conn, $id_vitoks)
    {
		$this->conn = $conn;
		$this->id_vitoks = $id_vitoks;
		$this->sql = 'SELECT product_id from oc_product where sku = "'.$this->id_vitoks.'"';
	}
	
	public function check() {
	 		$result = mysqli_query($this->conn, $this->sql) or die (mysqli_error($this->conn));
			$row = mysqli_fetch_array($result);
			if($row)
			{
				return false;
			}
			else
			{
				return true;
			}
		
		
}
}
