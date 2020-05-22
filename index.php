<?php

require_once ('vendor/autoload.php');


use Blog\Router;


session_start();

$router = new Router();

$router->route();



