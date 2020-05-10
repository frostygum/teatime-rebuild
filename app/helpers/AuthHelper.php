<?php

class AuthHelper
{
    protected $error = null;

    public function logout()
    {
        $this->remove_auth();
    }

    public function get_error()
    {
        return $this->error;
    }

    public function get_auth()
    {
        if (isset($_SESSION['login_session'])) {
            return $_SESSION['login_session'];
        }

        return false;
    }

    private function remove_auth()
    {
        unset($_SESSION['login_session']);
        session_destroy();
    }

    public function setAuth($username, $id, $tipe)
    {
        $_SESSION['login_session'] = [
            'username' => $username,
            'id' => $id,
            'tipe' => $tipe
        ];
    }

    public function set_last_login($id) {
        if (isset($id)) {
            date_default_timezone_set("Asia/Jakarta");

            $date = date("Y-m-d");

            $user = new User;
            $res = $user->update_user($id, null, null, null, $date);

            if ($res) {
               return true;
            } else {
                $this->error = $user->get_error();
                return false;
            }

            $this->error = 'id missing';
            return false;
        }
    }

    public function change_password($id, $new_password) {
        if (isset($id) && isset($new_password)) {
            date_default_timezone_set("Asia/Jakarta");

            $date = date("Y-m-d");

            $user = new User;
            $res = $user->update_user($id, null, null, $new_password, $date);

            if ($res) {
               return true;
            } else {
                $this->error = $user->get_error();
                return false;
            }

            $this->error = 'user or password missing arguments';
            return false;
        }
    }

    public function authenticate($username, $password)
    {
        if (isset($username) && isset($password)) {
            $result = [];

            $user = new User;
            $res = $user->read_user($username, $password);

            if ($res) {
                $result['id'] = $user->get_id();
                $result['username'] = $user->get_username();
                $result['tipe'] = $user->get_tipe();
                $result['last_login'] = $user->get_last_login();

                // $this->setAuth($result['username'], $result['id'], $result['tipe']);

                return $result;
            } else {
                $this->error = $user->get_error();
                return false;
            }

            $this->error = 'user or password missing arguments';
            return false;
        }
    }
}
