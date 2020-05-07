<?php

require_once MODEL_PATH . 'User.php';
require_once MODEL_PATH . 'Toping.php';
class Manager extends Controller
{
    protected $db;
    
    public function __construct()
    {
        $this->db = new DB();
    }

    public function index()
    {
        //$page->test = 'hai';
        
        
        $page = $this::create_page('manager', 'index');
        $page->render();
        
    }
    
    /*public function index()
    {
        //$page->test = 'hai';
        
        $auth = $this::auth_helper();
        $user = $auth->get_auth();

        if ($user) {
            if (strtolower($user['tipe']) == 'manager') {
                $page = $this::create_page('manager', 'index');
                $page->user_information = $user;
                $page->render();
            } else {
                echo 'wrong auth';
                $auth->logout();
            }
        } else {
            $this::set_redirect_url();
            header('location: ./login');
        }
    }*/

    

    
}
