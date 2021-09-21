<?php

namespace Model;
require_once "AsyncMysqlReader.php";

use Amp\Loop;
use Amp\Mysql\ConnectionConfig;
use function Amp\call;
use function Amp\Mysql\pool;
use function Amp\Promise\all;



class AsyncClient
{
    private array $pools= array();
    public function addConnection(string $db, string $host ="127.0.0.1",string $username = "root", string $password=""){
        $config = ConnectionConfig::fromString("host=$host user=$username password=$password db=$db");
        array_push($this->pools, pool($config) ) ;
    }


    /**
     * @param string $query
     *   query parameters should be annotated by `:` in prefix.
     *   for example id parameter is annotated by `:id` inside the query text
     * @param array $params
     *   associative array parameter annotation (key) => desired value
     *   for example ['id'=> 1234]
     */
    public function fetch (string $query, array $params) {
        $result = [];
        $this->runQuery($query, $params, $result);
        return array_merge($result);
    }

    private function runQuery(string $query, array $params, array &$result){


        Loop::run(function() use ($query, $params, &$result){
            $promises = array();
            foreach ($this->pools as $index => $pool) {
                array_push($promises, call(function () use ($pool, $query, $index) {
                    return AsyncMysqlReader::Query($pool, $query, $index);
                }));
            }
            $result =  yield all($promises);
        });

    }

}