<?php

namespace Model;


class AsyncMysqlReader
{
    public static function  Query($pool, $query, $params) : \Generator{
        $statement = yield $pool->prepare($query);

        $result = [];
        $queryResult = yield $statement->execute($params);
        while (yield $queryResult->advance()) {
            array_push( $result,$queryResult->getCurrent());
        }

        return $result ;
    }
}