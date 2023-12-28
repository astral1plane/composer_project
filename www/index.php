<?php
require_once 'vendor/autoload.php';

use Controllers\ComController;
use Controllers\MainController;
use Controllers\UserController;
use MiladRahimi\PhpRouter\Router;


ORM::configure('mysql:host=database;dbname=docker');
ORM::configure('username', 'root');
ORM::configure('password', 'tiger');
session_start();

$router = Router::create();
$router->setupView(__DIR__ . '/views');

$router->get('/', [MainController::class, 'index']);
$router->get('/registration', [MainController::class, 'registration']);
$router->get('/login', [MainController::class, 'login']);
$router->post('/login', [UserController::class, 'login']);
$router->post('/registration', [UserController::class, 'store']);
$router->get('/post/{id}',[MainController::class, 'page']);
$router->post('/post/{id}',[ComController::class, 'store']);
$router->dispatch();





