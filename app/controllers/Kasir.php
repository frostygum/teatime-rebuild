<?php

require_once MODEL_PATH . 'User.php';

class Kasir extends Controller
{
    public function index()
    {
        $auth = $this::Auth()->get_auth();
        if($auth) {
            if(strtolower($auth['tipe']) == 'kasir') {
                $page = $this::create_page('kasir', 'index');
                $page->user_information = $this::Auth()->get_auth();
                $page->render();
            }
            else {
                echo 'wrong auth';
                $this::Auth()->logout();
            }
        }
        else {
            $this::set_redirect_url();
            header('location: ./login');
        }
    }
}
