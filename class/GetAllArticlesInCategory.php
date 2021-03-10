<?php 
class  GetAllArticlesInCategory
{
	public $start_category_url;
	public $muster__category_url;
	public $total_pages;
	public $category_id;
	
	public function __construct($category_id, $start_category_url, $muster__category_url, $total_pages)
	{
		$this->start_category_url=$start_category_url; 
		$this->muster__category_url=$muster__category_url; 
		$this->total_pages=$total_pages; 
		$this->category_id=$category_id; 
	}
	
	public function get()
	{
		$categories[] = array('category_url' => $this->start_category_url, 'category_id' => $this->category_id);
		for($i = 2; $i<$this->total_pages; $i++)
		{
		$pattern = "/(55555)/U";
		$replacement = $i;
		$category=preg_replace($pattern, $replacement, $this->muster__category_url);
		
		$categories[] = array('category_url' => $category, 'category_id' => $this->category_id);
		
		}
		return $categories;
	}
}