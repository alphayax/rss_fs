# alphayax/rss_fs

This composer library allow you to generate RSS stream form a file system folder.

## Setup

```bash
composer require alphayax/rss_fs
```

## Exemple

```php
require_once '../vendor/autoload.php';

$directory = new \alphayax\rssfs\model\Directory( $directoryToServe);
$directory->setAccessUrl( $urlToAccessDirectory);
$directory->setTitle( $titleOfTheRssFeed);
$directory->setDescription( $descriptionOfTheRssFeed);
$directory->setLanguage( $language);

$a = new \alphayax\rssfs\controller\Page( $directory, true);
$a->display();
```
