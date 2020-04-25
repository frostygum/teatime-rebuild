<?php

class Test extends Controller
{
    public function index()
    {
        $page = $this::create_page('test', 'test');
        $page->angka = 6;
        $page->render();
    }
}
