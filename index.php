<?php

require 'vendor/autoload.php';
require 'core/bootstrap.php';
$uri = Request::uri();
if(!strpos($uri,'.js') && !strpos($uri,'.css')){
    Router::load('routes.php')
    ->direct($uri, Request::method());
}
