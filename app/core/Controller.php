<?php

require_once HELPER_PATH . 'view.php';

abstract class Controller {

  protected function view( $view, $data = [] ) {
    View::view_template('header');
    View::view_page($view, $data);
    View::view_template('footer');
  }
  
}