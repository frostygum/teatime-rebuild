<?php

class Menu extends Model 
{
    // protected $db;
    protected $id;
    protected $name;
    protected $priceR;
    protected $priceL;

    public function __construct($id = null, $name = null, $priceR = null, $priceL = null) {
        $this->id = $id;
        $this->name = $name;
        $this->priceR = $priceR;
        $this->priceL = $priceL;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_nama() 
    {
        return $this->nama;
    }

    public function get_priceR() 
    {
        return $this->priceR;
    }

    public function get_priceL()
    {
        return $this->priceL;
    }

    public function get_error()
    {
        return $this->error;
    }

}
