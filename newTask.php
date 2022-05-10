<?php

session_start();
require 'bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $textTask = trim($_POST['textTask']);

  $conn->query(query: "INSERT INTO tasks (name, email, texttask) VALUES ('$name', '$email', '$textTask')");
}

header('Location: tasks.php');
