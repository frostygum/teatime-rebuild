<?php

require_once HELPER_PATH . 'Router.php';
class App
{
    public function __construct()
    {
        // GET ENDPOINTS
        Router::get('/', function () {
            $this::call('home')->index();
        });

        Router::get('/login', function () {
            $this::call('auth')->loginPage();
        });

        Router::get('/kasir', function () {
            $this::call('kasir')->index();
        });

        Router::get('/admin', function () {
            $this::call('admin')->index();
        });

        Router::get('/manager', function () {
            $this::call('manager')->index();
        });

        Router::get('/sample', function () {
            $this::call('sample')->index();
        });



        // API ENDPOINTS
        Router::post('/api/auth', function () {
            return $this::call('auth')->authenticate();
        });



        // Router::get('/error', function () {
        //     echo 'error';
        // });

        // Router::set_err_page(function () {
        //     header('location: ./error');
        // });

        Router::run();
    }

    public static function call(string $controller_name)
    {
        require_once CONTROLLER_PATH . $controller_name . '.php';
        return new $controller_name;
    }
}