<?php

declare(strict_types=1);

/**
 * Created by response.
 * Date: 2020/7/15
 * Time: 15:21
 * Author Walker <heywalklerman@gmail.com>
 */
require '../vendor/autoload.php';
$respone = new \Walker\Response\Response();
var_dump($respone->success(['name' => 'test']));