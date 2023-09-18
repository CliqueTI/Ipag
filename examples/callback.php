<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include __DIR__."/../vendor/autoload.php";

use CliqueTI\Ipag\Ipag;

$callback = Ipag::callback('API_KEY',file_get_contents('php://input'))->process();
var_dump($callback);