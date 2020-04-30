<?php

require_once MODEL_PATH . 'User.php';

class Login extends controller
{
    public function page_login() {
        $page = $this::create_page('login', 'index');

        if(isset($_POST['username']) && isset($_POST['password'])) {
            $isAuthenticated = $this::Auth()->authenticate($_POST['username'], $_POST['password']);
            if($isAuthenticated) {
                $this->redirect();
            }
            else {
                $page->error = $this::Auth()->get_error();
            }
        }
        
        $page->render();
    }
    
    private function redirect() {
        if(isset($_SESSION['redirect_location'])) {
            $page = rtrim($_SESSION['redirect_location'], '/');
            $page = ltrim($page, '/');
            $page = explode('/', $page);
            $page_before = $page[count($page) - 1];
            $page_base = $page[0];
            
            switch(strtolower($page_before)) {
                case 'admin':
                    header('location: ' . $_SESSION['redirect_location']);
                break;
                case 'kasir':
                    header('location: ' . $_SESSION['redirect_location']);
                break;
                case 'manager':
                    header('location: ' . $_SESSION['redirect_location']);
                break;
                default:
                    header('location: /' . $page_base);
                break;
            }
        }
        else {
            header('location: /' . $_SERVER['REDIRECT_URI']);
        }
    }
}
