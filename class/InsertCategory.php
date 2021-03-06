<?php
class InsertCategory
{
	private $conn;
	private $product_id;
	private $category;
	private $parent_id;

	public function __construct($conn, $product_id, $category, $parent_id)
    {
		$this->conn = $conn;
		$this->product_id = $product_id;
		$this->category = $category;
		$this->parent_id = $parent_id;
			
		$this->sql = 'INSERT INTO oc_product_to_category SET 	product_id="'.$this->product_id.'", category_id="'.$this->category.'", main_category="'.$this->parent_id.'"';
		
		$this->sql_check = 'SELECT product_id FROM  oc_product_to_category WHERE product_id="'.$this->product_id.'"';
		
	}
	
	
	public function insert() {
	 		
		$result = mysqli_query($this->conn, $this->sql_check) or die (mysqli_error($this->conn));
			$row = mysqli_fetch_array($result);
			if(@$row['product_id'])
			{
				return "Продукт с такой категорией уже есть в базе";
			}
			if(mysqli_query($this->conn, $this->sql) or die (mysqli_error($this->conn)))
			{
			return "Категория добавлена добавлено<br>";
			}
	
}
}
