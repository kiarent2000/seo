<?php
class InsertNewItems
{
	private $conn;
	private $id_vitoks;
	private $vendor_code;
	private $price;
	private $image;
	private $available;

	
	public function __construct($conn, $id_vitoks, $vendor_code, $price, $image, $available)
    {
		$this->conn = $conn;
		$this->id_vitoks = $id_vitoks;
		$this->vendor_code = $vendor_code;
		$this->price = $price;
		$this->image = 'catalog/'.basename($image);
		$this->available = $available;
		
		$this->sql = 'INSERT INTO oc_product SET 	model="'.$this->vendor_code.'", sku="'.$this->id_vitoks.'", price="'.$this->price.'", image="'.$this->image.'",   quantity="1000" , shipping = 1, status=1,  stock_status_id="'.$this->available.'"';
		
	}
	
	public function getLastId($id_vitoks)
	{
		$sql = 'SELECT product_id from oc_product where sku = "'.$id_vitoks.'"';
		$result = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
		$row = mysqli_fetch_array($result);
		$product_id = $row['product_id'];
		return $product_id;
	}
	
	
	public function insert() {
	 		
		if(mysqli_query($this->conn, $this->sql) or die (mysqli_error($this->conn)))
		{
			
			$product_id = $this->getLastId($this->id_vitoks);
			
			return $product_id;
		}
		
		
		
}
}
