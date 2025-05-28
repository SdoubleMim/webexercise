<?php
namespace App;

class Route
{
    private $routes = [];
    
    public function addRoute(string $method = "GET", string $path = "/", $handler = null): void
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'handler' => $handler
        ];
    }
    
    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        foreach ($this->routes as $route) {
            if ($this->matchRoute($route, $method, $uri)) {
                $this->callHandler($route['handler']);
                return;
            }
        }
        
        $this->handleNotFound();
    }
    
    protected function matchRoute(array $route, string $method, string $uri): bool
    {
        return $route['method'] === $method && $route['path'] === $uri;
    }
    
    protected function callHandler($handler): void
    {
        if (is_array($handler)) {
            [$class, $method] = $handler;
            call_user_func([new $class(), $method]);
        } elseif (is_callable($handler)) {
            call_user_func($handler);
        }
    }
    
    protected function handleNotFound(): void
    {
        http_response_code(404);
        echo "404 Not Found";
    }
}