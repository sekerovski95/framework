<?php

$config = require 'config.php';
$pdo = Connection::make($config['database']);
$repository = new Repository($pdo);

$encryptionHandler = new EncryptionHandler();
$primeYearService = new PrimeYearService($repository, $encryptionHandler);

