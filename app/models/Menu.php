<?php

class Menu extends Model 
{
    protected $id;
    protected $name;
    protected $priceR;
    protected $priceL;

    public function __construct($id, $name, $priceR, $priceL) {
        $this->id = $id;
        $this->name = $name;
        $this->priceR = $priceR;
        $this->priceL = $priceL;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_name() 
    {
        return $this->name;
    }

    public function get_priceR() 
    {
        return $this->priceR;
    }

    public function get_priceL()
    {
        return $this->priceL;
    }
}
