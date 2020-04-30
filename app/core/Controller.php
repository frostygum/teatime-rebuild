<?php

require_once HELPER_PATH . 'View.php';
require_once HELPER_PATH . 'Auth.php';

class Controller
{
    public static function create_page($folder = '', $page = 'index')
    {
        $page = new View($folder, $page);
        $page->title = $folder;
        return $page;
    }

    public static function auth() {
        return new Auth;
    }

    public static function set_redirect_url() {
        $_SESSION['redirect_location'] = $_SERVER['REQUEST_URI'];
    }
}
