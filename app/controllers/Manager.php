<?php

class Manager extends Controller
{
    public function index()
    {
        $page = $this::create_page('manager', 'index');
        $page->test = 'hai';
        $page->render();
    }
}
