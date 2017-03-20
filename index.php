<?php
require_once 'vendor/autoload.php';


header('Content-Type: text/xml; charset=utf-8', true); //set document header content type to be XML

$a = new \alphayax\rssfs\Item( __DIR__, 'https://inea.alphayax.com:8083');

echo $a->d()->asXML(); //output XML

//var_dump( $_SERVER);
