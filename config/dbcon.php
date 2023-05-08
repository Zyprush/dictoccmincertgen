<?php

require __DIR__.'/../vendor/autoload.php'; 

use Kreait\Firebase\Factory;
use Kreait\Firebase\Contract\Auth;

$factory = (new Factory)
    ->withServiceAccount('../certgen-c2fc5-firebase-adminsdk-dqhkh-622b182ab1.json')
    ->withDatabaseUri('https://certgen-c2fc5-default-rtdb.firebaseio.com/');

    $database = $factory->createDatabase();

    $auth = $factory->createAuth();
?>