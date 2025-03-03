<?php

use App\Controllers\AuthController;
use App\Controllers\UserController;
use App\Middlewares\AuthMiddleware;

function sendCorsHeaders() {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
}

$router = new \Bramus\Router\Router();

$router->before('GET|POST|PUT|DELETE', '/.*', function () {
    sendCorsHeaders();
});

sendCorsHeaders();

$router->post('/login', function() {
    $controller = new AuthController();
    $controller->login($_REQUEST);
});

$router->before('GET|POST|PUT|DELETE', '/users', function() {
    $middleware = new AuthMiddleware();
    $middleware->handle($_REQUEST, function($request) {});
});

$router->get('/users', function() {
    $controller = new UserController();
    $controller->index(); 
});

$router->get('/users/(\d+)', function($id) {
    $controller = new UserController();
    $controller->show($id); 
});

$router->post('/users', function() {
    $controller = new UserController();
    $controller->store(); 
});

$router->put('/users/(\d+)', function($id) {
    $controller = new UserController();
    $controller->update($id); 
});

$router->delete('/users/(\d+)', function($id) {
    $controller = new UserController();
    $controller->destroy($id); 
});

$router->run();
