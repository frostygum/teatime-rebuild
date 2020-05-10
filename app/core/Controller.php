<?php

require_once HELPER_PATH . 'View.php';
require_once HELPER_PATH . 'AuthHelper.php';

class Controller
{
    public static function create_page($folder = '', $page = 'index')
    {
        $page = new View($folder, $page);
        $page->title = $folder;
        return $page;
    }

    public static function auth_helper() {
        return new AuthHelper;
    }

    public static function set_redirect_url() {
        $_SESSION['redirect_location'] = $_SERVER['REQUEST_URI'];
    }

    public static function get_user() {
        return $_SESSION['login_session'];
    }
}
