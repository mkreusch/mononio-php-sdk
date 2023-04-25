<?php

require_once __DIR__.'/../vendor/autoload.php';

require_once __DIR__.'/../src/Structs/AbstractStruct.php';
require_once __DIR__.'/../src/Clients/AbstractClient.php';
foreach(glob(__DIR__.'/../src/*/*.php') as $file){
    require_once $file;
}

