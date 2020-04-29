<?php

require_once HELPER_PATH . 'View.php';

class Controller
{
    public static function create_page($folder = '', $page = 'index')
    {
        $page = new View($folder, $page);
        $page->title = $folder;
        return $page;
    }
}
