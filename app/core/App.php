<?php

require_once HELPER_PATH . 'Router.php';
class App
{
    public function __construct()
    {
        // GET ENDPOINTS
        // HOME PAGE
        Router::get('/', function () {
            $this::call('home')->index();
        });

        Router::get('/about', function () {
            $this::call('home')->about();
        });

        // LOGIN & LOGOUT PAGE
        Router::get('/login', function () {
            $this::call('auth')->page_login();
        });

        Router::post('/login', function () {
            $this::call('auth')->page_login();
        });

        Router::get('/logout', function () {
            $this::call('auth')->page_logout();
        });

        // KASIR PAGE
        Router::get('/kasir', function () {
            $this::call('kasir')->index();
        });

        Router::post('/kasir', function () {
            $this::call('kasir')->index();
        });

        // ADMIN PAGE
        Router::get('/admin', function () {
            $this::call('admin')->index();
        });

        Router::post('/admin', function () {
            $this::call('admin')->index();
        });

        // MANAGER PAGE
        Router::get('/manager', function () {
            $this::call('manager')->index();
        });

        // EXTRA PAGE
        Router::get('/sample', function () {
            $this::call('sample')->index();
        });



        // API ENDPOINTS
        // Router::post('/api/auth', function () {
            // return $this::call('auth')->authenticate();
        // });

        Router::put('/api/user', function () {
            return $this::call('admin')->insert_user();
        });

        Router::delete('/api/user', function () {
            return $this::call('admin')->delete_user();
        });

        Router::patch('/api/user', function () {
            return $this::call('admin')->update_user();
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
