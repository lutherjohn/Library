<?php
require_once 'system/init.php';

$user = new User();
$user->logout();

Redirect::to('index.php');
