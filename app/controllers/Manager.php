<?php

class Manager extends Controller
{
    protected $db;
    
    public function __construct()
    {
        $this->db = new DB();
    }

    public function index()
    {
        $page = $this::create_page('manager', 'index');
        $page->test = 'hai';
        $page->render();
    }

    public function get_all_topping()
    {


    }
}
