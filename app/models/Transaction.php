<?php

class Transaction extends Model {
    protected $db;
    
    public function __construct() {
        $this->db = new DB();
    }


}