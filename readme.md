# PHPGhostPost
### Pull Ghost blog post info from Ghost RSS XML Feed

This library will read an RSS feed from your Ghost blog and return friendly Post objects that you can use to display information about your posts on a PHP page.

## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `jacobbennett/ghostxml`.

```
"require": {
	"jacobbennett/ghostxml": "dev-master"
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

That’s all. You should now be able to use the GhostXML Library.


## Usage

```php
use jacobbennett\phpghostpost\PostCreator;

// Set RSS feed URL
$feedUrl = 'http://youblog.ghost.io/rss/';

$PostCreator = new PostCreator($feedUrl);
$posts = $PostCreator->getPosts();

```