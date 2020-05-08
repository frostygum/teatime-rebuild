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
        $auth = $this::auth_helper();
        $user = $auth->get_auth();

        if($user) {
            if (true) {
                $this::set_user($user);
                return $this->page_index();
            }           
            else {
                echo 'wrong auth';
                $auth->logout();
            }         
        }
        else {
            $this::set_redirect_url();
            header('location: ./login');
        }
        
    }

    public function page_index() {
        $page = $this::create_page('manager', 'index');

        $page->user_information = $this::get_user();
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
