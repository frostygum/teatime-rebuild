<?php

class Home extends Controller
{
    public function index()
    {
        $db = new db;
        $page = $this::create_page('home', 'index');

        $page->data = $db->executeSelectQuery('
            SELECT * FROM BOOK
        ');
        $page->render();
    }
}
