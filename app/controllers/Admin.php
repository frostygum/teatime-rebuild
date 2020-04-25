<?php

class Admin extends Controller
{
    public function index()
    {
        $page = $this::create_page('admin', 'test');
        $page->test = 6;
        $page->render();
    }
}