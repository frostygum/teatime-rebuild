<?php

class Login extends Controller {
    public function index() {
        $page = $this::create_page('login', 'index');
        $page->render(); 
    }

    public function login() {

    }
}