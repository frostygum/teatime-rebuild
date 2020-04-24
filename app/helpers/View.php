<?php

abstract class View {

  public static function view_page( $view, $data = [] ) {
    foreach ($data as $key => $value) {
      $$key = $value;
    }

    require_once VIEW_PATH . 'pages/' . $view . '.php';
  }

  public static function view_template( $template ) {
    require_once VIEW_PATH . 'templates/' . $template . '.php';
  }

}