<?php

class GetArticleContent
{
	public $article_id;
	public $article_url;
	public $muster_body;
	public $muster_img;
	
		public function __construct($article_id, $article_url, $muster_body,  $muster_img)
	{
		$this->article_id=$article_id; 
		$this->article_url=$article_url; 
		$this->muster_body=$muster_body; 
		$this->muster_img=$muster_img; 
	}
	
	private function get_page()
	{
		return file_get_contents($this->article_url);
	}
	
	public function get()
	{
		$file = $this->get_page();
		
		preg_match_all($this->muster_body, $file, $article_bodies, PREG_SET_ORDER);
		foreach ($article_bodies as $article_bodie) 
			{
				$article_body=$article_bodie[2];
			}	
		
		preg_match_all($this->muster_img, $file, $article_imgs, PREG_SET_ORDER);
		foreach ($article_imgs as $article_imge) 
			{
			 $article_img=$article_imge[2];
			}	
		$result[] = array('article_body'=>$article_body, 'article_id'=>$this->article_id,  'article_image'=>@$article_img);
		return $result;
	}
}