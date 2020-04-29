<?php

class Router
{
    private static $request;
    private static $routes = [];
    private static $pageNotFound = null;
    private static $methodNotAllowed = null;

    public static function get($uri, $function)
    {
        self::$routes[$uri . 'GET'] = ['method' => 'GET', 'function' => $function];
    }

    public static function post($uri, $function)
    {
        self::$routes[$uri . 'POST'] = ['method' => 'POST', 'function' => $function];
    }

    public static function put($uri, $function)
    {
        self::$routes[$uri . 'PUT'] = ['method' => 'PUT', 'function' => $function];
    }

    public static function delete($uri, $function)
    {
        self::$routes[$uri . 'DELETE'] = ['method' => 'DELETE', 'function' => $function];
    }

    public static function patch($uri, $function)
    {
        self::$routes[$uri . 'PATCH'] = ['method' => 'PATCH', 'function' => $function];
    }

    public static function set_err_page($function)
    {
        self::$pageNotFound = $function;
    }

    public static function set_err_method($function)
    {
        self::$methodNotAllowed = $function;
    }

    public static function run()
    {
        self::$request = self::parseURL() . $_SERVER["REQUEST_METHOD"];

        if (self::hasRoute(self::$request)) {
            if ($_SERVER["REQUEST_METHOD"] == self::$routes[self::$request]['method']) {
                echo call_user_func(self::$routes[self::$request]['function']);
            } else {
                if (self::$methodNotAllowed != null) {
                    call_user_func(self::$methodNotAllowed);
                } else {
                    echo 'ERROR : Method Not Allowed';
                }
            }
        } else {
            if (self::$pageNotFound != null) {
                call_user_func(self::$pageNotFound);
            } else {
                echo 'ERROR : Page Not Found';
            }
        }
    }

    private static function hasRoute($uri)
    {
        return array_key_exists($uri, self::$routes);
    }

    private static function parseURL()
    {
        if (isset($_SERVER['REQUEST_URI'])) {
            $url = rtrim($_SERVER['REQUEST_URI'], '/');
            $base_url = explode('/', ltrim($url, '/'));
            $base_url = $base_url[0];
            $url = str_replace('/' . $base_url, '', $url);

            if ($url == '') {
                $url = '/';
            }

            return $url;
        }
    }
}
