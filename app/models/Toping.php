<?php

class Toping extends Model
{
    protected $db;
    protected $id;
    protected $nama;
    protected $harga;
    protected $error = null;

    public function __construct($id = null, $nama=null, $harga=null)
    {
        $this->db = new DB();
        $this->id = $id;
        $this->nama = $nama;
        $this->harga = $harga;
    }

    public function get_all_topping()
    {
        $query = "
            SELECT id, nama_toping, harga_toping
            FROM Toping
        ";
        $query_result = $this->db->executeSelectQuery($query);
        $result = [];
        foreach ($query_result as $key => $value){
            $result[]= new  Toping($value['id'], $value['nama_toping'], $value['harga_toping']);
        }
        return $result;
    }

    public function update_toping($id, $name = null, $harga = null)
    {
        $id = $this->db->escapeString($id);
        $name = $this->db->escapeString($name);
        $harga = $this->db->escapeString($harga);
        
        $query = "
            UPDATE Toping
            SET
        ";
        
        if ($name != null) {
            $query .= " nama_toping = '$name',";
        }
        if ($harga != null) {
            $query .= " harga_toping = '$harga',";
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

    public function delete_toping($id, $nama)
    {
        $id = $this->db->escapeString($id);
        $nama = $this->db->escapeString($nama);

        $query = "
            DELETE FROM toping
            WHERE id = '$id' AND nama_toping = '$nama'
        ";

        $query_result = $this->db->executeNonSelectQuery($query);

        if (!$query_result) {
            $this->error = $this->db->get_error();
            return false;
        }

        return true;
    }

    public function create_toping($name, $harga)
    {
        $name = $this->db->escapeString($name);
        $harga = $this->db->escapeString($harga);
        

        $query = "
            INSERT INTO toping (
                nama_toping, harga_toping
            )
            VALUES (
                '$name', '$harga'
            )
        ";

        $query_result = $this->db->executeNonSelectQuery($query);

        if (!$query_result) {
            $this->error = $this->db->get_error();
            return false;
        }

        return true;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_nama()
    {
        return $this->nama;
    }

    public function get_harga()
    {
        return $this->harga;
    }



}