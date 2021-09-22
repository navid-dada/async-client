<?php
require "vendor/autoload.php";
require_once "Model/AsyncDummy.php";
require_once "Model/AsyncClient.php";
use Amp\Loop;
use Model\AsyncClient;
$result = 0;


$start = microtime(true);
$async_client  = new AsyncClient();
$async_client->addConnection("temp","127.0.0.1", "root", "123456");
$async_client->addConnection("temp1","127.0.0.1", "root", "123456");

//$t = yield Amp\call( function() use($async_client){ return $async_client->fetch("query",[]);});
$t =  $async_client->fetch("select * from Person",[]);
$end = microtime(true);
echo "execution time ".($end - $start);

var_dump($t);
