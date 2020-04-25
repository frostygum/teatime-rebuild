<?php

class Sample extends Controller
{
    public function index()
    {
        $page = $this::create_page('sample', 'index');
        $page->render();
    }
}
