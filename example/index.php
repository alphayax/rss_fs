<?php
require_once '../vendor/autoload.php';

$directory = new \alphayax\rssfs\model\Directory( __DIR__ . '/../test/data');
$directory->setAccessUrl( 'http://localhost:8088');
$directory->setTitle('Inea');
$directory->setDescription('Incoming files');
$directory->setLanguage('fr-FR');


$a = new \alphayax\rssfs\controller\Page( $directory, true);
$a->display();

