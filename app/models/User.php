<?php

class User extends Model
{
    protected $db;
    protected $id = null;
    protected $tipe = null;
    protected $username = null;
    protected $error = null;

    public function __construct()
    {
        $this->db = new DB;
    }

    public function update_user($id, $username = null, $name = null, $password = null)
    {
        $id = $this->db->escapeString($id);
        $name = $this->db->escapeString($name);
        $username = $this->db->escapeString($username);
        $password = $this->db->escapeString($password);

        $query = "
            UPDATE pengguna
            SET
        ";
        if($username != null) {
            $query .= " username = '$username',";
        }
        if($name != null) {
            $query .= " nama_pengguna = '$name',";
        }
        if($password != null) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query .= " password = '$hashed_password',";
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
                id, username, tipe, password
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
                    $this->id = $query_result[0]['id'];
                    $this->username = $query_result[0]['username'];
                    $this->tipe = $query_result[0]['tipe'];
                    return true;
                } else {
                    $this->error = 'unauthorize';
                    return false;
                }
            } else {
                $this->error = 'user not found';
                return false;
            }
        }
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_username()
    {
        return $this->username;
    }

    public function get_tipe()
    {
        return $this->tipe;
    }

    public function get_error()
    {
        return $this->error;
    }
}
