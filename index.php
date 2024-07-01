<?php

session_start();

// Include Composer's autoloader
require "vendor/autoload.php";


// Check if the CSRF token does not exist in the session
if(!isset($_SESSION["csrf-token"]))
{
    // Generate a CSRF token
    $tokenManager = new CSRFTokenManager();
    $token = $tokenManager->generateCSRFToken();

    // Store the CSRF token in the session
    $_SESSION["csrf-token"] = $token;
}


// Load environment variables from the .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Create an instance of the Router object
$router = new Router();

// Handle the request based on the data received in $_GET
$router->handleRequest($_GET); 

