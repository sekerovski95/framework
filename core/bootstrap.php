<?php

App::bind('config', $config = require 'config.php');


App::bind('database', new Repository(
    Connection::make(App::get('config')['database'])
));

App::bind('encriptionHandler', new EncryptionHandler());
App::bind('service', new PrimeYearService(App::get('database'), App::get('encriptionHandler')));
