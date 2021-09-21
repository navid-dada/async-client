<?php

namespace Model;

use Amp\Delayed;

class AsyncMysqlReader
{
    public static function  Query($pool, $query, $params) : \Generator{
        $rand = rand(1,3);
        yield new Delayed($rand * 1000);
        echo "$params delayed $rand sec".PHP_EOL;
        return array(
            ["name"=>"navid_{$params}", "family"=>"shokri_{$params}"],
            ["name"=>"behrad_{$params}", "family"=>"shokrio_{$params}"],
            ["name"=>"reyhane_{$params}", "family"=>"mahdavi_{$params}"]
        );
    }
}