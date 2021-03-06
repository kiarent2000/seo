<?php
class InsertDescription
{
	private $conn;
	private $product_id;
	private $name;
	private $description;

	
	public function __construct($conn, $product_id, $name, $description)
    {
		$this->conn = $conn;
		$this->product_id = $product_id;
		$this->name = mysqli_real_escape_string($conn, $name);
		$this->description = mysqli_real_escape_string($conn, $description);
			
		$this->sql = 'INSERT INTO oc_product_description SET 	product_id="'.$this->product_id.'", name="'.$this->name.'", description="'.$this->description.'", meta_title="'.$this->name.'",   language_id ="1"';
		
		$this->sql_check = 'SELECT product_id FROM  oc_product_description WHERE product_id="'.$this->product_id.'"';
		
	}
	
	
	public function insert() {
	 		
		$result = mysqli_query($this->conn, $this->sql_check) or die (mysqli_error($this->conn));
			$row = mysqli_fetch_array($result);
			if(@$row['product_id'])
			{
				return "Описание продукта с таким ID уже есть в базе";
			}
			if(mysqli_query($this->conn, $this->sql) or die (mysqli_error($this->conn)))
			{
			return "Описание добавлено<br>";
			}
	
}
}
