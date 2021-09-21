<?php

namespace Model;
use Amp\Delayed;
use Amp\Loop;
use Amp\Success;
use function Amp\delay;

require_once "vendor/autoload.php";
class AsyncDummy
{
    public function DoSomething(int $value):\Generator
    {
        echo "DoSomething($value)".PHP_EOL;
        $rand = rand(1, 3);
        yield new Delayed(1000*$rand);
        echo "delayed for $rand sec".PHP_EOL;
        return $value *2;
    }

}