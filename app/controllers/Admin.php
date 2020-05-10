<?php

require MODEL_PATH . 'QueryUser.php';
require MODEL_PATH . 'QueryMenu.php';
require MODEL_PATH . 'QueryToping.php';

class Admin extends Controller
{
    public function index()
    {
        $auth = $this::auth_helper();
        $user = $auth->get_auth();

        if ($user) {
            if (strtolower($user['tipe']) == 'admin') {
                return $this->page_admin();
            } else {
                echo 'wrong auth';
                echo var_dump($user);
                $auth->logout();
            }
        } else {
            $this::set_redirect_url();
            header('location: ./login');
        }
    }

    public function page_admin()
    {
        if (!isset($_GET['page'])) {
            header('location: ./admin?page=user');
        }

        switch ($_GET['page']) {
            case 'user':
                $this->page_user();
                break;
            case 'menu':
                $this->page_menu();
                break;
            case 'toping':
                $this->page_topping();
                break;
            default:
                $this->page_user();
                break;
        }
    }

    public function page_user()
    {
        $page = $this::create_page('admin', 'userPage');
        $page->user_information = $this->get_user();

        if (isset($_POST['command'])) {
            switch ($_POST['command']) {
                case 'add-user':
                    $res = $this->add_user();
                    if ($res == 'berhasil') {
                        $page->status = $res;
                    }
                    else {
                        $page->error = $res;
                    }
                break;
                case 'edit-user':
                    $res = $this->edit_user();
                    if($res == 'berhasil') {
                        $page->status = $res;
                    }
                    else {
                        $page->error = $res;
                    }
                break;
                case 'delete-user':
                    $res = $this->delete_user();
                    if($res == 'berhasil') {
                        $page->status = $res;
                    }
                    else {
                        $page->error = $res;
                    }
                break;
            }
        }

        $q_user = new QueryUser;
        $all_user = $q_user->get_all_user();

        $page->all_user = $all_user;
        $page->render();
    }

    public function page_menu()
    {
        $page = $this::create_page('admin', 'menuPage');
        $page->user_information = $this->get_user();

        if (isset($_POST['command'])) {
            switch ($_POST['command']) {
                case 'add-menu':
                    $res = $this->add_menu();
                    if ($res == 'berhasil') {
                        $page->status = $res;
                    }
                    else {
                        $page->error = $res;
                    }
                break;
                case 'edit-menu':
                    $res = $this->edit_menu();
                    if($res == 'berhasil') {
                        $page->status = $res;
                    }
                    else {
                        $page->error = $res;
                    }
                break;
                case 'delete-menu':
                    $res = $this->delete_menu();
                    if($res == 'berhasil') {
                        $page->status = $res;
                    }
                    else {
                        $page->error = $res;
                    }
                break;
            }
        }

        require_once MODEL_PATH . 'QueryMenu.php';
        $q_menu = new QueryMenu();

        $page->all_menu = $q_menu->get_all_menu();
        $page->render();
    }

    public function page_topping()
    {
        $page = $this::create_page('admin', 'toppingPage');
        $page->user_information = $this->get_user();

        if (isset($_POST['command'])) {
            switch ($_POST['command']) {
                case 'add-topping':
                    $res = $this->add_topping();
                    if ($res == 'berhasil') {
                        $page->status = $res;
                    }
                    else {
                        $page->error = $res;
                    }
                break;
                case 'edit-topping':
                    $res = $this->edit_topping();
                    if($res == 'berhasil') {
                        $page->status = $res;
                    }
                    else {
                        $page->error = $res;
                    }
                break;
                case 'delete-topping':
                    $res = $this->delete_topping();
                    if($res == 'berhasil') {
                        $page->status = $res;
                    }
                    else {
                        $page->error = $res;
                    }
                break;
            }
        }

        require_once MODEL_PATH . 'QueryToping.php';
        $q_topping = new QueryToping();

        $page->all_topping = $q_topping->get_all_topping();
        $page->render();
    }

    private function add_user()
    {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $role = $_POST['role'];
        $password = $_POST['password'];

        if (!empty($name) && !empty($username) && !empty($role) && !empty($password)) {
            $q_user = new QueryUser;
            $q_user->create_user($name, $username, $role, $password);
            if (!$q_user) {
                return $q_user->get_error();
            }
            return 'berhasil';
        } else {
            return 'missing params';
        }
    }

    private function edit_user() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $role = $_POST['role'];
        $password = $_POST['password'];

        if (!empty($id)) {
            if(empty($name)) {
                $name = null;
            }
            if(empty($username)) {
                $username = null;
            }
            if(empty($role)) {
                $role = null;
            }
            if(empty($password)) {
                $password = null;
            }

            $q_user = new QueryUser;
            $q_user->update_user($id, $username, $name, $role, $password);

            if (!$q_user) {
                return $q_user->get_error();
            }

            return 'berhasil';
        } else {
            return 'missing id';
        }
    }

    private function delete_user() {
        $id = $_POST['id'];
        $username = $_POST['username'];
        if(!empty($id) && !empty($username)) {
            $q_user = new QueryUser;
            $q_user->delete_user($id, $username);

            if (!$q_user) {
                return $q_user->get_error();
            }

            return 'berhasil';
        }
        else {
            return 'missing params';
        }
    }

    private function add_menu()
    {
        $name = $_POST['name'];
        $price_r = $_POST['harga_r'];
        $price_l = $_POST['harga_l'];

        if (!empty($price_r) && !empty($price_l) && !empty($name)) {
            $q_menu = new QueryMenu;
            $q_menu->create_menu($name, $price_r, $price_l);
            if (!$q_menu) {
                return $q_menu->get_error();
            }
            return 'berhasil';
        } else {
            return 'missing params';
        }
    }

    private function edit_menu() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price_r = $_POST['harga_r'];
        $price_l = $_POST['harga_l'];

        if (!empty($id)) {
            if(empty($name)) {
                $name = null;
            }
            if(empty($price_r)) {
                $price_r = null;
            }
            if(empty($price_l)) {
                $price_l = null;
            }
            $q_menu = new QueryMenu;
            $q_menu->update_menu($id, $name, $price_r, $price_l);
            if (!$q_menu) {
                return $q_menu->get_error();
            }
            return 'berhasil';
        } else {
            return 'missing params';
        }
    }

    private function delete_menu() {
        $id = $_POST['id'];
        if(!empty($id)) {
            $q_menu = new QueryMenu;
            $q_menu->delete_menu($id);
            if (!$q_menu) {
                return $q_menu->get_error();
            }

            return 'berhasil';
        }
        else {
            return 'missing params';
        }
    }

    private function add_topping()
    {
        $name = $_POST['name'];
        $price = $_POST['harga'];

        if (!empty($price) && !empty($name)) {
            $q_topping = new QueryToping;
            $q_topping->create_toping($name, $price);
            if (!$q_topping) {
                return $q_topping->get_error();
            }
            return 'berhasil';
        } else {
            return 'missing params';
        }
    }

    private function edit_topping() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['harga'];

        if (!empty($id)) {
            if(empty($name)) {
                $name = null;
            }
            if(empty($price)) {
                $price = null;
            }

            $q_topping = new QueryToping;
            $q_topping->update_toping($id, $name, $price);
            if (!$q_topping) {
                return $q_topping->get_error();
            }
            return 'berhasil';
        } else {
            return 'missing params';
        }
    }

    private function delete_topping() {
        $id = $_POST['id'];

        if (!empty($id)) {
            $q_topping = new QueryToping;
            $q_topping->delete_toping($id);
            if (!$q_topping) {
                return $q_topping->get_error();
            }
            return 'berhasil';
        } else {
            return 'missing params';
        }
    }
}
