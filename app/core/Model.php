<?php

require_once HELPER_PATH . 'Db.php';

class Model {
    public static function print_error($error)
    {
        if ($this->show_errors) {
            die($error);
        }
    }
}