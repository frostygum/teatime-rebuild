<?php

require_once HELPER_PATH . 'Db.php';
require_once MODEL_PATH . 'User.php';
require_once MODEL_PATH . 'Menu.php';
require_once MODEL_PATH . 'Toping.php';

class Admin extends Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = new DB();
        $this->user = new User;
    }

    public function index()
    {
        $auth = $this::auth_helper();
        $user = $auth->get_auth();

        // if($user) {
        //     if (true) {
        //         $this::set_user($user);
        //         return $this->page_admin();
        //     }           
        //     else {
        //         echo 'wrong auth';
        //         $auth->logout();
        //     }         
        // }
        // else {
        //     $this::set_redirect_url();
        //     header('location: ./login');
        // }
        
        return $this->page_user();
    }

    public function page_admin() {
        if(isset($_GET['page'])) {
            switch($_GET['page']) {
                case 'user':
                    $this->page_user();
                break;
                case 'menu':
                    $this->page_menu();
                case 'toping' :
                    $this->page_topping();
                default:
                    $this->page_user();
                break;
            }
        }
        else {
            header('location: ./admin?page=user');
        }
    }

    public function page_user()
    {
        $page = $this::create_page('admin', 'userPage');
        $page->all_user = $this->get_all_user();
        $page->render();
    }

    public function page_menu()
    {
        $page = $this::create_page('admin', 'menuPage');
        $page->all_menu = $this->get_all_menu();
        $page->render();
    }

    public function page_topping()
    {
        $page = $this::create_page('admin', 'toppingPage');
        $page->all_topping = $this->get_all_topping();
        $page->render();
    }

    public function update_user()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $result = [];

        if (isset($post) && isset($post['id'])) {
            $id = $post['id'];
            $name = null;
            $username = null;
            $password = null;

            if (isset($post['name'])) {
                $name = $post['name'];
            }
            if (isset($post['username'])) {
                $username = $post['username'];
            }
            if (isset($post['password'])) {
                $password = $post['password'];
            }

            $user = new User();
            $user->update_user($id, $username, $name, $password);

            if ($user->get_error() == null) {
                $result['code'] = 200;
                $result['text'] = 'Success';
            } else {
                $result['code'] = 200;
                $result['text'] = $user->get_error();
            }
        } else {
            $result['code'] = 200;
            $result['text'] = 'invalid or missing params';
        }

        echo json_encode($result);
    }

    public function insert_user()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $result = [];

        if (isset($post) && isset($post['name']) && isset($post['username']) && isset($post['tipe']) && isset($post['password'])) {
            $name = $post['name'];
            $username = $post['username'];
            $tipe = $post['tipe'];
            $password = $post['password'];


            $user = new User();
            $user->create_user($name, $username, $tipe, $password);

            if ($user->get_error() == null) {
                $result['code'] = 200;
                $result['text'] = 'Success';
            } else {
                $result['code'] = 200;
                $result['text'] = $user->get_error();
            }
        } else {
            $result['code'] = 200;
            $result['text'] = 'invalid or missing params';
        }

        echo json_encode($result);
    }

    public function delete_user()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $result = [];

        if (isset($post) && isset($post['username']) && isset($post['id'])) {
            $username = $post['username'];
            $id = $post['id'];

            $user = new User();
            $user->delete_user($id, $username);

            if ($user->get_error() == null) {
                $result['code'] = 200;
                $result['text'] = 'Success';
            } else {
                $result['code'] = 200;
                $result['text'] = $user->get_error();
            }
        } else {
            $result['code'] = 200;
            $result['text'] = 'invalid or missing params';
        }

        echo json_encode($result);
    }

    // public function get_a_user($username) {
    //     $query = '
    //     '
    // }

    public function get_all_user()
    {
        $query = '
            SELECT
                id,
                nama_pengguna,
                tipe,
                username
            FROM
                Pengguna
        ';

        $queryResult = $this->db->executeSelectQuery($query);
        $result = [];
        foreach ($queryResult as $key => $value) {
            $result[] = new User($value['id'], $value['nama_pengguna'], $value['tipe'], $value['username']);
        }

        return $result;
    }

    public function get_all_menu()
    {
        $query = '
            SELECT
                id,
                nama_minuman,
                harga_regular,
                harga_large
            FROM
                Menu
        ';

        $queryResult = $this->db->executeSelectQuery($query);
        $result = [];
        foreach ($queryResult as $key => $value) {
            $result[] = new Menu($value['id'], $value['nama_minuman'], $value['harga_regular'], $value['harga_large']);
        }

        return $result;
    }

    public function get_all_topping()
    {
        $query = '
            SELECT
                id,
                nama_toping,
                harga_toping
            FROM
                Toping
        ';

        $queryResult = $this->db->executeSelectQuery($query);
        $result = [];
        foreach ($queryResult as $key => $value) {
            $result[] = new Toping($value['id'], $value['nama_toping'], $value['harga_toping']);
        }

        return $result;
    }
}
