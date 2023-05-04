<?php

require __DIR__.'/vendor/autoload.php'; 

use Kreait\Firebase\Factory;

$factory = (new Factory)
    ->withServiceAccount('dict-occ-min-certgen-firebase-adminsdk-chc4f-1d6e73de33.json')
    ->withDatabaseUri('https://dict-occ-min-certgen-default-rtdb.asia-southeast1.firebasedatabase.app/');

    $database = $factory->createDatabase();
?>