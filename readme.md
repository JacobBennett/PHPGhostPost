# PHPGhostPost
### Pull Ghost blog post info from Ghost RSS XML Feed

This library will read an RSS feed from your Ghost blog and return friendly Post objects that you can use to display information about your posts on a PHP page.

## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `jacobbennett/ghostxml`.

```
"require": {
	"jacobbennett/phpghostpost": "dev-master"
}
```

Next, update Composer from the Terminal:

```
composer update
```

Finally make sure to place a `use` statement at the top of your `PHP` file that will be using the library.

```
use jacobbennett\phpghostpost\PostCreator;
```

That’s all. You should now be able to use the PHPGhostPost Library.


## Usage


```php
use jacobbennett\phpghostpost\PostCreator;

// Set RSS feed URL
$feedUrl = 'http://youblog.ghost.io/rss/';

// Instantiate a new Post Creator
$PostCreator = new PostCreator($feedUrl);

// Grab and parse the RSS feed into an array of Post objects
$posts = $PostCreator->getPosts();

// Loop through posts and call properties or methods on each
// To display desired information
foreach($posts as $post){
	echo "<h1>" . $post->title . "</h1><br/>";
	echo "Published " . $post->date_ago();
}

```

## Post Object methods and properties

Once you have your array of `Post` objects returned, here are the methods and properties you can call on each.

### Properties
* `title` - Title of the post
* `description` - Text of post (stripped of html tags)
* `image` - URI of first image in post
* `link` - Permalink to the post
* 'date' - Timestamp of publish date

### Methods
* `shortDesc($limit)` - Return description limited by character count, rounded to end of a word
* `date_ago` - Return human readable time-ago string