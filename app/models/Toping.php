<?php

class Toping extends Model
{
    protected $id;
    protected $nama;
    protected $harga;

    public function __construct($id = null, $nama = null, $harga = null)
    {
        $this->id = $id;
        $this->nama = $nama;
        $this->harga = $harga;
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