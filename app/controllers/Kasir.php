<?php

class Kasir extends Controller
{
    public function index()
    {
        $page = $this::create_page('kasir', 'index');
        $page->render();
    }
}
