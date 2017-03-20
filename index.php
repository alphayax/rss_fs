<?php
require_once 'vendor/autoload.php';


header('Content-Type: text/xml; charset=utf-8', true);


$directory = new \alphayax\rssfs\model\Directory( __DIR__);
$directory->setAccessUrl( 'https://inea.alphayax.com:8083');
$directory->setTitle('Inea');
$directory->setDescription('Incoming files');
$directory->setLanguage('fr-FR');


$a = new \alphayax\rssfs\controller\Page( $directory);

echo $a->getXML()->asXML(); //output XML

