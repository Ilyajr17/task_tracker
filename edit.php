<?php

require_once 'bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
    $tasksBd = $conn->query(query: "SELECT * FROM tasks WHERE  id = $id");
    while ($result = mysqli_fetch_array($tasksBd, MYSQLI_ASSOC)) {
        $tasks[] = $result;
        echo $tasks[0]['completed'];
        print_r($tasks);
    }
    $task = $tasks[0];
} else {

    $id = $_POST['id'];
    $textTask = trim($_POST['textTask']);
    
    if (array_key_exists('completed', $_POST)) {
        $completed = 1;
    } else {
        $completed = 0;
    }
    
    $str = "UPDATE tasks SET texttask = '$textTask', completed = '$completed' WHERE id = $id";

    $conn->query(query: $str);
    header('Location: tasks.php');
}
require_once 'edit.phtml';
