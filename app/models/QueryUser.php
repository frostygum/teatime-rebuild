<?php

require_once MODEL_PATH . 'User.php';
class QueryUser extends Model
{
    protected $db;
    protected $error = null;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function get_all_user() {
        $query = '
            SELECT
                id, nama_pengguna, username, tipe, password, last_login
            FROM
                Pengguna
        ';

        $queryResult = $this->db->executeSelectQuery($query);
        $result = [];
        foreach ($queryResult as $key => $value) {
            $result[] = new User($value['id'], $value['nama_pengguna'], $value['tipe'], $value['username'], $value['last_login']);
        }

        return $result;
    }

    public function update_user($id, $username = null, $name = null, $role = null, $password = null, $last_login = null)
    {
        $id = $this->db->escapeString($id);
        $name = $this->db->escapeString($name);
        $username = $this->db->escapeString($username);
        $password = $this->db->escapeString($password);

        $query = "
            UPDATE pengguna
            SET
        ";
        if ($username != null) {
            $query .= " username = '$username',";
        }
        if ($name != null) {
            $query .= " nama_pengguna = '$name',";
        }
        if ($role != null) {
            $query .= " tipe = '$role',";
        }
        if ($password != null) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query .= " password = '$hashed_password',";
            $query .= " last_login = NULL,";
        }
        if ($last_login != null) {
            $query .= " last_login = '$last_login',";
        }
        $query = substr($query, 0, -1);
        $query .= " WHERE id = '$id'";

        $query_result = $this->db->executeNonSelectQuery($query);

        if (!$query_result) {
            $this->error = $this->db->get_error();
            return false;
        }

        return true;
    }

    public function delete_user($id, $username)
    {
        $id = $this->db->escapeString($id);
        $username = $this->db->escapeString($username);

        $query = "
            DELETE FROM pengguna
            WHERE id = '$id' AND username = '$username'
        ";

        $query_result = $this->db->executeNonSelectQuery($query);

        if (!$query_result) {
            $this->error = $this->db->get_error();
            return false;
        }

        return true;
    }

    public function create_user($name, $username, $tipe, $password)
    {
        $name = $this->db->escapeString($name);
        $username = $this->db->escapeString($username);
        $tipe = $this->db->escapeString($tipe);
        $password = $this->db->escapeString($password);

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "
            INSERT INTO pengguna (
                nama_pengguna, username, tipe, password
            )
            VALUES (
                '$name', '$username', '$tipe', '$hashed_password'
            )
        ";

        $query_result = $this->db->executeNonSelectQuery($query);

        if (!$query_result) {
            $this->error = $this->db->get_error();
            return false;
        }

        return true;
    }

    public function read_user($username, $password)
    {
        $username = $this->db->escapeString($username);
        $password = $this->db->escapeString($password);

        $query = "
            SELECT
                id, username, tipe, password, last_login
            FROM 
                pengguna
            WHERE   
                username = '$username'
        ";

        $query_result = $this->db->executeSelectQuery($query);

        if ($this->db->get_error() != null) {
            $this->error = $this->db->get_error();
            return false;
        } else {
            if (count($query_result) != 0) {
                if (password_verify($password, $query_result[0]['password'])) {
                    return new User($query_result[0]['id'], $query_result[0]['username'], $query_result[0]['tipe'], $query_result[0]['username'], $query_result[0]['last_login']);
                } else {
                    $this->error = 'user or password incorrect';
                    return false;
                }
            } else {
                $this->error = 'user or password incorrect';
                return false;
            }
        }
    }

    public function get_error() {
        return $this->error;
    }
}