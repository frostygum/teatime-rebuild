<?php

class Kasir extends Controller{

  public function index(){
    $this->view('kasir/index', [
      'title' => 'test',
    ]);
  }
  
}
