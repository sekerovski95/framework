<?php

$router->get('', 'DatesController@index');
$router->post('dates', 'DatesController@dates');
$router->get('table', 'DatesController@table');

    