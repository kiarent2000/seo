<?php 
class  Cleaner
{
	public $body;

	public function __construct($body)
	{
		$this->body=$body; 
	}
	
	public function cleanScript()
	{
		$pattern = "/(<script)(.*)(<\/script>)/Ums";
		$replacement = '';
		return preg_replace($pattern, $replacement, $this->body);
	}
	
	public function cleanDiv()
	{
		$pattern = "/(<div)(.*)(<\/div>)/Ums";
		$replacement = '';
		return preg_replace($pattern, $replacement, $this->body);
	}
	
	public function cleanSpan()
	{
		$pattern = "/(<span)(.*)(<\/span>)/Ums";
		$replacement = '';
		return preg_replace($pattern, $replacement, $this->body);
	}
	
	public function getImages()
	{
		preg_match_all('/(<img)(.*)(src=\")(.*)(\")/Ums', $this->body, $article_images, PREG_SET_ORDER);
		foreach ($article_images as $article_image) 
			{
				$images[] = $article_image[4];
			}	
		if(!empty($images))
		{
			return $images;
		}
	}
}