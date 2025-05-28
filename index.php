<?php
// Basic constants and autoloading (unchanged)
define('ROOT_PATH', __DIR__);
require __DIR__.'/vendor/autoload.php';
require_once(__DIR__.'/helper/functions.php');

// Database setup (unchanged)
use Illuminate\Database\Capsule\Manager as Capsule;
$config = require __DIR__.'/config/database.php';
$capsule = new Capsule;
$capsule->addConnection($config);
$capsule->setAsGlobal();
$capsule->bootEloquent();

// Routing (unchanged structure, just added error handling)
use App\Route;
use App\Controller\FrontController;

$route = new Route();

try {
    // Your original routes (unchanged)
    $route->addRoute("GET","/webexercise/",[FrontController::class, 'home']);
    $route->addRoute("GET",'/webexercise/about',[FrontController::class, 'about']);
    $route->addRoute("GET",'/webexercise/infs',[FrontController::class, 'infs']);
    
    $route->dispatch();
} catch (Throwable $e) {
    // Minimal error handling just to prevent white screens
    error_log('Error in index.php: ' . $e->getMessage());
    http_response_code(500);
    echo "Something went wrong. Please try again later.";
}