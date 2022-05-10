<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $login = '';
    $pass = '';
    require_once 'authorization.phtml';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['login'] === 'admin' && $_POST['password'] === '123') {
        $autp = 'admin';
        $_SESSION['user'] = $autp;
        header('Location: tasks.php');
    } else {
        $login = $_POST['login'];
        $pass = $_POST['password'];
        $autp = 'noadmin';
        $_SESSION['user'] = $autp;
        require_once 'authorization.phtml';
    }
}
