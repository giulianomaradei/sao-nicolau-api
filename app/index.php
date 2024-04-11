<?php

$uri = $_SERVER['REQUEST_URI'];

$router = require './Routes.php';
$router->dispatch($uri);
    