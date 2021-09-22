# async-client
This project provide a facilator class to run a query on mulitple database asynchronously. It is based on [Amphp](https://amphp.org) and its [mysql client](https://github.com/amphp/mysql).

## Building Blocks
1. **AsyncClient:**
This class is responsible for run orchestrate the queries on each database and aggregate the results set to create the final result.

2. **AsyncMysqlReader:**
this class run the query on the given database and return the result as array to its client class.

## Usage Sample:
```
require "vendor/autoload.php";
require_once "Model/AsyncDummy.php";
require_once "Model/AsyncClient.php";
use Amp\Loop;
use Model\AsyncClient;

$async_client  = new AsyncClient();
$async_client->addConnection("temp","127.0.0.1", "root", "123456");
$async_client->addConnection("temp1","127.0.0.1", "root", "123456");

$t =  $async_client->fetch("select * from Person",[]);
```


