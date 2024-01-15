<?php

class jRoute
{
    private $routes = [];
    private $dirMappings = [];
    private $urlPrefix = null;
    private $debugMode = false;

    private function OutputError($msg)
    {
        echo "<br /><b>jRoute</b>: <code>" . $msg . "</code><br />";
    }

    public function __construct($urlPrefix = null, $debugMode = false)
    {
        $this->urlPrefix = $urlPrefix;
        $this->debugMode = $debugMode;
    }

    // Method for adding a new route
    public function Route(array $methods, string $pattern, $callback, $requiredRole = null)
    {
        foreach ($methods as $method) {
            $this->routes[strtoupper($method)][$pattern] = ['callback' => $callback, 'role' => $requiredRole];
        }
    }    

    // Method for passing a route to a file if it exists
    public function PassRoute(string $baseUrl, string $dir, $requiredRole = null)
    {
        $this->Route(['get'], $baseUrl . '{path}', function($path) use ($dir) {
            $file = __DIR__ . $dir . $path;
            if (file_exists($file)) {
                return readfile($file);
            } else {
                $_GET['error_uri'] = 'GET ' . $baseUrl . $path;
                require dirname(__FILE__) . '/errorPages/404.php';
                return;
            }
        }, $requiredRole);
    }    

    // Method for adding a directory mapping
    public function AddDir(string $webPath, string $rootDir, $requiredRole = null)
    {
        if (!($rootDir = realpath($rootDir))) {
            $this->OutputError("Directory does not exist: " . $rootDir);
            return;
        }
    
        $this->dirMappings[] = ['webPath' => $webPath, 'rootDir' => $rootDir, 'role' => $requiredRole];
    }

    // Main method for dispatching the incoming request to the correct route
    public function Dispatch(string $method, string $uri)
    {
        @session_start();

        // Convert to uppercase for comparison
        $method = strtoupper($method);
        if (!isset($this->routes[$method])) return 'Method not supported.';

        // Strip off the prefix if it exists
        if ($this->urlPrefix != null) $uri = substr($uri, strlen($this->urlPrefix));

        if ($this->debugMode) $this->OutputError($method . ' ' . $uri);

        // Iterate over routes
        foreach ($this->routes[$method] as $route => $routeInfo)
        {
            // Build the route pattern
            $routePattern = '#^' . preg_replace('/\{([^}]+)\}/', '([^/]+)', $route) . '$#';
            if (preg_match($routePattern, $uri, $matches))
            {
                // Remove the full match from the matches
                array_shift($matches);

                // Check if user has required role
                if ($routeInfo['role'] !== null && (!isset($_SESSION['role']) || $_SESSION['role'] !== $routeInfo['role'])) {
                    $_GET['error_uri'] = $method . ' ' . $uri;
                    require dirname(__FILE__) . '/errorPages/403.php';
                    return;
                }

                // If the callback is callable, call it
                if (is_callable($routeInfo['callback'])) return call_user_func_array($routeInfo['callback'], $matches);

                // If the callback is a string, require the file
                elseif (is_string($routeInfo['callback'])) {
                    preg_match_all('/\{([^}]+)\}/', $route, $paramNames);
                    $paramNames = $paramNames[1];
                    $params = array_combine($paramNames, $matches);
                    $_GET = array_merge($_GET, $params);
                    require $routeInfo['callback'];
                    return;
                }
            }
        }

        // If route was not found, check directory mappings
        foreach ($this->dirMappings as $mapping) {
            if (strpos($uri, $mapping['webPath']) === 0) {
                // Check if user has required role
                if ($mapping['role'] !== null && (!isset($_SESSION['role']) || $_SESSION['role'] !== $mapping['role'])) {
                    $_GET['error_uri'] = $method . ' ' . $uri;
                    require dirname(__FILE__) . '/errorPages/403.php';
                    return;
                }

                // Check if file exists and is not a directory
                $filePath = $mapping['rootDir'] . substr($uri, strlen($mapping['webPath']));
                if (file_exists($filePath) && !is_dir($filePath)) return readfile($filePath);
            }
        }

        // If route or file was not found, require 404 page
        $_GET['error_uri'] = $method . ' ' . $uri;
        require dirname(__FILE__) . '/errorPages/404.php';
    }
}

?>