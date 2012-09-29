<?php
define('ROOT', __DIR__);

spl_autoload_register(function ($class) {
    require_once ROOT . '/class/' . $class . '.php';
});
?>
