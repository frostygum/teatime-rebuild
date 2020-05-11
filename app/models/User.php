<?php

class User extends Model
{
    protected $id;
    protected $nama;
    protected $tipe;
    protected $username;
    protected $last_login;
    protected $profile_path;

    public function __construct($id, $nama, $tipe, $username, $last_login, $profile_path)
    {
        $this->id = $id;
        $this->nama = $nama;
        $this->tipe = $tipe;
        $this->username = $username;
        $this->last_login = $last_login;
        $this->profile_path = $profile_path;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_nama() 
    {
        return $this->nama;
    }

    public function get_tipe() 
    {
        return $this->tipe;
    }

    public function get_username()
    {
        return $this->username;
    }

    public function get_last_login() {
        return $this->last_login;
    }

    public function get_profile_path() {
        return $this->profile_path;
    }
}
