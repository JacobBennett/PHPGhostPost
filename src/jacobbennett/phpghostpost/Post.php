<?php namespace JacobBennett\PhpGhostPost;

use \SimpleXMLElement;
use \DateTime;

/**
* Post Class
*
* DTO for a Ghost Post
*/
class Post
{
	private $xml;
	public $title;

	protected $full_description;
	public $description;

	public $image;
	public $link;

	private $created_date;
	public $date;
	
	function __construct(SimpleXMLElement $xml_object)
	{
		$this->xml = $xml_object;

		$this->setTitle();
		$this->setDescription();
		$this->setImage();
		$this->setLink();
		$this->setDate();
	}

	protected function setTitle()
	{
		$this->title = (string) $this->xml->title;
	}

	protected function setDescription()
	{
		$this->full_description = (string) $this->xml->description;
		$this->description = strip_tags($this->full_description);
	}

	public function shortDesc($limit)
	{
		$char_lim_string = substr($this->description, 0, $limit);
		$word_count = count(explode(" ",$char_lim_string));

		$words = explode(" ",$this->description);
	    return implode(" ",array_splice($words,0,$word_count));
	}

	protected function setImage()
	{
		
		preg_match("/<img src=\".*\">/", $this->full_description, $matches);
		preg_match("/\"[^\"]*/", $matches[0], $src);
		$this->image = substr($src[0], 1);
	}

	protected function setLink()
	{
		$this->link = (string) $this->xml->link;
	}

	protected function setDate()
	{
		//Keep original date
		$this->created_date = $this->xml->pubDate;

		// Create a new DateTime object
		$date = DateTime::createFromFormat("l, j M Y H:i:s e", $this->xml->pubDate);

		//set Date in nice format
		$this->date = $date->format('m-d-Y');
	}

	public function date_ago()
	{
		$i = strtotime($this->created_date);

		$m = time()-$i; $o='just now';
		$t = array('year'=>31556926,'month'=>2629744,'week'=>604800,
		'day'=>86400,'hour'=>3600,'minute'=>60,'second'=>1);
		foreach($t as $u=>$s){
		  if($s<=$m){$v=floor($m/$s); $o="$v $u".($v==1?'':'s').' ago'; break;}
		}

		return $o;
	}


}