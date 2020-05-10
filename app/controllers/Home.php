<?php

class Home extends Controller
{
    public function index()
    {
        $page = $this::create_page('home', 'index');
        $page->render();
    }

    public function about()
    {
        $page = $this::create_page('home', 'about');
        $page->render();
    }
}
