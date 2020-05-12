<?php

require_once MODEL_PATH . 'User.php';
require_once MODEL_PATH . 'QueryUser.php';

class Auth extends controller
{
    private function store_auth($data) {
        $_SESSION['auth'] = $data;
    }

    private function get_auth() {
        if(isset($_SESSION['auth'])) {
            return $_SESSION['auth'];
        }
        else {
            return false;
        }
    }

    private function remove_auth() {
        unset($_SESSION['auth']);
    }
    
    public function page_login()
    {
        $page = $this::create_page('login', 'index');

        if (isset($_POST['username']) && isset($_POST['password'])) {
            $auth = $this::auth_helper();
            $isAuthenticated = $auth->authenticate($_POST['username'], $_POST['password']);
            if ($isAuthenticated) {
                if(strtolower($isAuthenticated['tipe']) == 'kasir' && $isAuthenticated['last_login'] == null) {
                    $this->store_auth($isAuthenticated);
                    $page = $this::create_page('login', 'firstTimeChangePass');
                }
                else {
                    $auth->set_last_login($isAuthenticated['id']);
                    $auth->setAuth($isAuthenticated['username'], $isAuthenticated['id'], $isAuthenticated['tipe']);
                    $this->redirect($isAuthenticated['tipe']);
                }
            } else {
                $page->error = $auth->get_error();
            }
        }

        if($this->get_auth() != null) {
            $page = $this::create_page('login', 'firstTimeChangePass');
        }

        if (isset($_POST['new_password']) && isset($_POST['retype_new_password'])) {
            if($_POST['new_password'] == $_POST['retype_new_password']) {
                $authenticated_user = $this->get_auth();
                $auth = $this::auth_helper();
                $isPasswordChanged = $auth->change_password($authenticated_user['id'], $_POST['new_password']);

                if ($isPasswordChanged) {
                    $auth->setAuth($authenticated_user['username'], $authenticated_user['id'], $authenticated_user['tipe']);
                    $this->remove_auth();
                    $this->redirect($authenticated_user['tipe']);
                } else {
                    $page->error = $auth->get_error();
                }
            }
            else {
                $page->error = 'new password not match';
            }
        }

        $page->render();
    }

    public function page_logout()
    {
        $this::auth_helper()->logout();
        $this->redirect();
    }
}
