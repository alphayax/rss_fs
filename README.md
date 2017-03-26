
# alphayax/rss_fs

[![Latest Stable Version](https://poser.pugx.org/alphayax/rss_fs/v/stable)](https://packagist.org/packages/alphayax/rss_fs)
[![Latest Unstable Version](https://poser.pugx.org/alphayax/rss_fs/v/unstable)](https://packagist.org/packages/alphayax/rss_fs)
[![Codacy Badge](https://api.codacy.com/project/badge/Coverage/b37b6f9b18354476bac9a18849de1f95)](https://www.codacy.com/app/alphayax/rss_fs?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=alphayax/rss_fs&amp;utm_campaign=Badge_Coverage)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/b37b6f9b18354476bac9a18849de1f95)](https://www.codacy.com/app/alphayax/rss_fs?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=alphayax/rss_fs&amp;utm_campaign=Badge_Grade)

[![pakagist](https://img.shields.io/packagist/v/alphayax/rss_fs.svg)](https://packagist.org/packages/alphayax/rss_fs)
[![Total Downloads](https://poser.pugx.org/alphayax/rss_fs/downloads)](https://packagist.org/packages/alphayax/rss_fs)
[![License](https://poser.pugx.org/alphayax/rss_fs/license)](https://packagist.org/packages/alphayax/rss_fs)

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
