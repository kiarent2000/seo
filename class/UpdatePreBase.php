<?php
class UpdatePreBase
{
	private $conn;
	private $id_vitoks;

	public function __construct($conn, $id_vitoks)
    {
		$this->conn = $conn;
		$this->id_vitoks = $id_vitoks;
		$this->sql = 'UPDATE base SET 	new="" WHERE id_vitoks = "'.$this->id_vitoks.'"';
	}
	
	public function update() {
			if(mysqli_query($this->conn, $this->sql) or die (mysqli_error($this->conn)))
			{
				return "Предварительная база обновлена<br>";
			
			}
				return "Неуспешное обновление предварительной базы<br>";
}
}
