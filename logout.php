<?php
require_once 'core/init.php';
$user = new User();
$user->logout();
Librerian::getInstance()->logout();

Redirect::to('index.php');
?>