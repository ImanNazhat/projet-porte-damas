<?php

session_start();

require "vendor/autoload.php";

if(!isset($_SESSION["csrf-token"]))
{
    // Generate a CSRF token
    $tokenManager = new CSRFTokenManager();
    $token = $tokenManager->generateCSRFToken();

    // Store the CSRF token in the session
    $_SESSION["csrf-token"] = $token;
}



$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router();
$router->handleRequest($_GET); 