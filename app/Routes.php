<?php

include 'Router.php';
include 'Controllers/AuthController.php';

$router = new Router();

$router->addRoute('/auth/login', AuthController::class, 'login');
$router->addRoute('/auth/register', AuthController::class, 'register');


return $router;