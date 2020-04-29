<?php

class User extends Model
{
    protected $db;
    protected $id = null;
    protected $tipe = null;
    protected $username = null;
    protected $error = null;

    public function __construct($username, $password)
    {
        $this->db = new DB;

        $query_result = $this->db->executeSelectQuery("
            SELECT
                id, username, tipe, password
            FROM 
                pengguna
            WHERE   
                username = '$username'
        ");

        if ($this->db->get_error() != null) {
            $this->error = $this->db->get_error();
        } else {
            if (password_verify($password, $query_result[0]['password'])) {
                $this->id = $query_result[0]['id'];
                $this->username = $query_result[0]['username'];
                $this->tipe = $query_result[0]['tipe'];
            } else {
                $this->error = 'UnAuthorize';
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
