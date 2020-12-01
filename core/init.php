<?php
session_start();
$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => 'localhost',
        'username' => 'root',  
        'password' => '',
        'db' => 'lms'
    ),
    'remember' => array(
        'coockie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'session' => array(
        'session_name' => 'user'
    ),
    'book' => array(
        'selected_book' => 'book_id'
    )
);

spl_autoload_register(function($className){
    require_once 'classes/'.$className.'.php';
});
$books = Database::getInstance()->query("SELECT * FROM books")->results();
require_once 'functions/sanitize.php';
?>

