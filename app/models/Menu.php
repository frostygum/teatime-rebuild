<?php

class Menu extends Model 
{
    protected $id;
    protected $nama;
    protected $hargaR;
    protected $hargaL;

    public function __construct($id, $nama, $hargaR, $hargaL) {
        $this->id = $id;
        $this->nama = $nama;
        $this->hargaR = $hargaR;
        $this->hargaL = $hargaL;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_nama() 
    {
        return $this->nama;
    }

    public function get_hargaR() 
    {
        return $this->hargaR;
    }

    public function get_hargaL()
    {
        return $this->hargaL;
    }
}
