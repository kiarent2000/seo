<?php
class InsertLayout
{
	private $conn;
	private $product_id;

	public function __construct($conn, $product_id)
    {
		$this->conn = $conn;
		$this->product_id = $product_id;
		$this->sql = 'INSERT INTO oc_product_to_layout SET 	product_id="'.$this->product_id.'", store_id = 0';
		$this->sql_check = 'SELECT product_id FROM  oc_product_to_layout WHERE product_id="'.$this->product_id.'"';
		
	}
	
	
	public function insert() {
	 		
		$result = mysqli_query($this->conn, $this->sql_check) or die (mysqli_error($this->conn));
			$row = mysqli_fetch_array($result);
			if(@$row['product_id'])
			{
				return "Продукт  с этим лейаутом уже есть в базе";
			}
			if(mysqli_query($this->conn, $this->sql) or die (mysqli_error($this->conn)))
			{
			return "Layout добавлен<br>";
			}
	
}
}
