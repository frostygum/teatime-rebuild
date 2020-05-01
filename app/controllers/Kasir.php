<?php

require_once MODEL_PATH . 'User.php';

class Kasir extends Controller
{
    public function index()
    {
        $auth = $this::auth_helper();
        $user = $auth->get_auth();

        if ($user) {
            if (strtolower($user['tipe']) == 'kasir') {
                $page = $this::create_page('kasir', 'index');
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
    }
}
