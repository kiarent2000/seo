<?php
class GetNewItems
{
	private $conn;

	
	public function __construct($conn)
    {
		$this->sql = 'SELECT b.parent_id, b.category_id, a.id_vitoks, a.vendor_code, a.category, a.price, a.marge, a.available, a.name, a.description, a.image from base a, categories b where a.new = 1 and a.category = b.category_name';
		$this->conn = $conn;
	}
	
	public function get() {
	 		$item=array();
			$result = mysqli_query($this->conn, $this->sql) or die (mysqli_error($this->conn));
			while($row = mysqli_fetch_array($result))
			{
				
				if($row['available']=="Есть в наличии")
					$available = 7;
				else
				{
					$available = 5;
				}
				
				$item[]=array('id_vitoks' => $row['id_vitoks'], 'vendor_code' => $row['vendor_code'], 'category' => $row['category_id'] , 'parent_id' => $row['parent_id'], 'price' => (int)$row['price']*$row['marge'],  'available' => $available, 'name' => $row['name'], 'description' => $row['description'], 'image' => $row['image']);
			}
		
		return $item;
}
}
