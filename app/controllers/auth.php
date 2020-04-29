<?php

require_once MODEL_PATH . 'User.php';

class Auth extends Controller
{
    public function loginPage()
    {
        $page = $this::create_page('login', 'index');
        $page->render();
    }

    public function authenticate()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $username = $post['username'];
        $password = $post['password'];
        $result = [];

        if (isset($username) && isset($password)) {
            $user = new User($username, $password);

            if($user->get_error() == null) {
                $result['id'] = $user->get_id();
                $result['username'] = $user->get_username();
                $result['tipe'] = $user->get_id();
            }
            else {
                $result['code'] = 200;
                $result['text'] = $user->get_error();
            }

            return json_encode($result);
        }
    }
}
