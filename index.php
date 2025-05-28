<?php

// Debugging setup
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verify the request URI
echo "<pre>Debug Info:\n";
echo "REQUEST_URI: " . ($_SERVER['REQUEST_URI'] ?? 'NULL') . "\n";
echo "SCRIPT_NAME: " . ($_SERVER['SCRIPT_NAME'] ?? 'NULL') . "\n";
echo "Working Directory: " . __DIR__ . "\n";
echo "</pre>";

// 1. Load dependencies - MUST BE FIRST
require __DIR__.'/vendor/autoload.php';

require_once(__DIR__.'/helper/functions.php');

// 2. Define constants
define('ROOT_PATH', __DIR__);

// 3. Database setup
use Illuminate\Database\Capsule\Manager as Capsule;

$config = require __DIR__.'/config/database.php';
$capsule = new Capsule;
$capsule->addConnection($config);
$capsule->setAsGlobal();
$capsule->bootEloquent();

// 4. Routing setup
use App\Route;
use App\Controller\FrontController;

$route = new Route();

try {
    // Define routes
    $route->addRoute("GET", "/webexercise/", [FrontController::class, 'home']);
    $route->addRoute("GET", "/webexercise/about", [FrontController::class, 'about']);
    $route->addRoute("GET", "/webexercise/infs", [FrontController::class, 'infs']);
    $route->addRoute("GET", "/webexercise/", [FrontController::class, 'home']);
    $route->addRoute("GET", "/webexercise/404", [FrontController::class, 'notFound']);
    
    // Handle the request
    $route->dispatch();

} catch (Throwable $e) {
    // Error handling
    error_log('Error in index.php: ' . $e->getMessage());
    http_response_code(500);
    
    // Show simple error page
    if (file_exists(__DIR__.'/views/errors/500.php')) {
        require __DIR__.'/views/errors/500.php';
    } else {
        echo "<h1>500 Error</h1>";
        echo "<p>Something went wrong. Please try again later.</p>";
        
        // Development mode - show details
        define('ENVIRONMENT', getenv('APP_ENV') ?: 'production');
        if (ENVIRONMENT === 'development') {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
        }
    }
}