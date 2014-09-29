<?php namespace JacobBennett\PhpGhostPost;

use JacobBennett\PhpGhostPost\Post;

/**
* Post Creator
*
* Loads an XML documents from a Ghost RSS feed
* Loops through the item values, and returns
* Post objects
* 
*/
class PostCreator
{
	/**
	 * URI of the Ghost RSS feed (i.e. http://yourblog.ghost.io/rss)
	 * @var string
	 */
	private $xml_feed;

	/**
	 * Accepts the URI of the Ghost RSS feed as a parameter and sets it as a property
	 * @param string $xml_feed
	 */
	function __construct($xml_feed)
	{
		$this->xml_feed = $xml_feed;
	}

	/**
	 * Retrieves XML URI as a simpleXML object, then loops through the XML data
	 * to create a Post Object for each item
	 * 
	 * @return array
	 */
	public function getPosts()
	{
		if($xml = simplexml_load_file($this->xml_feed))
		{ 
			// loop through each item returned and create a new Post object
			foreach ($xml->channel->item as $post) {
				$posts[] = new Post($post);
			}

		}

		return $posts;
	}
}