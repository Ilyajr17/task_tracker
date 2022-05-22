<?php

require_once "config.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $login = '';
    $pass = '';
    require_once 'authorization.phtml';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['login'] === $adminAuth && $_POST['password'] === $passAuth) { 
        $autp = 'admin';
        $_SESSION['user'] = $autp;
        header('Location: index.php');
    } else {
        $login = $_POST['login'];
        $pass = $_POST['password'];
        $autp = 'noadmin';
        $_SESSION['user'] = $autp;
        require_once 'authorization.phtml';
    }
}
