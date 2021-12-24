<?php
define('ROOT_DIR', __DIR__);

/**
 * BASE_URL: địa chỉ website
 */
define('BASE_URL', 'http://127.0.0.1:81/simple-project-be');

include_once ROOT_DIR . '/config/config.php';

spl_autoload_register(function ($className) {
    if (file_exists(ROOT_DIR . '/src/models/' . $className . '.php')) {
        include_once ROOT_DIR . '/src/models/' . $className . '.php';
    } else {
        include_once ROOT_DIR . '/src/controllers/' . $className . '.php';
    }
});

if (array_key_exists('REDIRECT_URL', $_SERVER)) {
    $temp = explode("/", $_SERVER['REDIRECT_URL']);
    array_splice($temp, 0, 2);
    define("URL", $temp);
} else {
    define("URL", []);
};

include_once './src/route.php';
