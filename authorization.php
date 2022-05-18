<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $login = '';
    $pass = '';
    require_once 'authorization.phtml';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['login'] === 'admin' && $_POST['password'] === '123') { //todo: логин и пароль пернести в конфиг
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
