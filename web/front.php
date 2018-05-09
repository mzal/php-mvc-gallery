<?php
require_once '../vendor/autoload.php';
require_once '../Router.php';
require_once '../DB.php';

DB::get_db();
session_start();

$router = new Router;

$router->error("ErrorController::_404");
$router->get("/", "GalleryController::display");
$router->get("/post", "PostController::display");
$router->get("/post/new", "PostController::new");
$router->get("/post/error", "PostController::post_error");
$router->post("/post/submit", "PostController::submit");
$router->get("/register", "UserController::register_form");
$router->post("/register/submit", "UserController::register");
$router->get("/register/result", "UserController::register_result");
$router->get("/login", "UserController::login_form");
$router->post("/login/submit", "UserController::login");
$router->get("/login/success", "UserController::login_result");
$router->get("/logout", "UserController::logout");
$router->post("/save", "GalleryController::save");
$router->get("/personal", "GalleryController::personal_display");
$router->post("/delete", "GalleryController::delete");

$view = $router->dispatch();
$view->render();
