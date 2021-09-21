<?php
require "vendor/autoload.php";
require_once "Model/AsyncDummy.php";
require_once "Model/AsyncClient.php";
use Amp\Loop;
use Model\AsyncClient;
$result = 0;
Loop::run(function (){
    $start = microtime(true);
    $async_client  = new AsyncClient();
    $async_client->addConnection("mydb");
    $async_client->addConnection("yourdb");
    $async_client->addConnection("theirdb");

    //$t = yield Amp\call( function() use($async_client){ return $async_client->fetch("query",[]);});
    $t =  $async_client->fetch("query",[]);
    $end = microtime(true);
    echo "execution time ".($end - $start);

    var_dump($t);

});

/*Loop::run(function (){
    $start = microtime(true);
    $dummyClient = new Model\AsyncDummy();
    $promises = array();
    for($i = 1 ;  $i <4; $i++){
        array_push($promises ,Amp\call(function() use($dummyClient,$i){
            echo "calling DoSomething $i".PHP_EOL;
            return $dummyClient->DoSomething($i);
        }));
    }
    $res = yield \Amp\Promise\all($promises);
    //->onResolve(function ($err, $res) use($start){
      //  echo "result" .PHP_EOL;
      //  var_dump($err);
      //  var_dump($res);
      //  $end = microtime(true);
      //  echo "execution time ".($end - $start);
     //   return $res;
    //});
    var_dump($res);

});*/

/*$fn1 = function(){
    echo "bega". PHP_EOL;
    return 5;
};
$fn2 = function(){
    echo "bega1". PHP_EOL;
    return 5;
};
$start = microtime(true);
Loop::Run(function () use($fn1, $fn2){
   Loop::delay(2000, $fn1);
   Loop::delay(1000, $fn2);
});
$end = microtime(true);
echo "execution time ".($end - $start);
echo "run finished". PHP_EOL;*/