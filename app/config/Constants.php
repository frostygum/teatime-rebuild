<?php 

$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];

if(isset($_SERVER['REQUEST_URI'])) {
    $url = ltrim($_SERVER['REQUEST_URI'], '/');
    $url = rtrim($url, '/');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    $url = explode('/', $url);
    $url = $url[0];
}

define("DS", DIRECTORY_SEPARATOR);
define("ROOT", getcwd() . DS);
define("APP_PATH", ROOT . 'app' . DS);
define("PUBLIC_PATH", $link . '/'. $url . '/' . 'public/');

define("HELPER_PATH", APP_PATH . "helpers" . DS);
define("CONFIG_PATH", APP_PATH . "config" . DS);
define("CONTROLLER_PATH", APP_PATH . "controllers" . DS);
define("CORE_PATH", APP_PATH . "core" . DS);
define("MODEL_PATH", APP_PATH . "models" . DS);
define("VIEW_PATH", APP_PATH . "views" . DS);

define("CSS_PATH", PUBLIC_PATH . "css" . DS);
define("JS_PATH", PUBLIC_PATH . "js" . DS);
define("IMG_PATH", PUBLIC_PATH . "img" . DS);
define("FONT_PATH", PUBLIC_PATH . "font" . DS);