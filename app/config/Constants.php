<?php 

define("DS", DIRECTORY_SEPARATOR);
define("ROOT", getcwd() . DS);
define("APP_PATH", ROOT . 'app' . DS);
define("PUBLIC_PATH", ROOT . "public" . DS);

define("HELPER_PATH", APP_PATH . "helpers" . DS);
define("CONFIG_PATH", APP_PATH . "config" . DS);
define("CONTROLLER_PATH", APP_PATH . "controllers" . DS);
define("CORE_PATH", APP_PATH . "core" . DS);
define("MODEL_PATH", APP_PATH . "models" . DS);
define("VIEW_PATH", APP_PATH . "views" . DS);