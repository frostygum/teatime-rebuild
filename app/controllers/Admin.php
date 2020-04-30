<?php

require_once HELPER_PATH . 'Db.php';
require_once MODEL_PATH . 'User.php';

class Admin extends Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function index()
    {
        $page = $this::create_page('admin', 'test');
        $page->test = 6;
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

        return json_encode($result);
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

        return json_encode($result);
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

        return json_encode($result);
    }

    public function get_all_user()
    {
        $query = '
            SELECT
                Pengguna.nama_pengguna,
                Pengguna.tipe,
            FROM
                Pengguna
        ';

        $queryResult = $this->db->executeSelectQuery($query);
        $result = [];
        foreach ($queryResult as $key => $value) {
            $result[] = new User($value['id'], $value['nama_pengguna'], $value['tipe'], $value['username'], $value['password']);
        }
    }
}
