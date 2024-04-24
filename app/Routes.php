<?php

include 'Router.php';
include 'Controllers/AuthController.php';
include 'Controllers/MedicController.php';

$router = new Router();

$router->addRoute('/auth/login', AuthController::class, 'login');
$router->addRoute('/auth/register', AuthController::class, 'register');

$router->addRoute('/medic/specialties', MedicController::class, 'existingSpecialties');
$router->addRoute('/medic/filterBySpecialty', MedicController::class, 'filterBySpecialty');

$router->addRoute('/medic/availableHoursByDate', MedicController::class, 'availableHoursByDate');

return $router;