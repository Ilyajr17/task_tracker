<?php

require 'ViewController.php';

session_start();

if (isset($_GET['newTask'])) {
    $viewController = new ViewController();
    $viewController->showNewCreateTaskForm();

    return;
}

if (isset($_POST['saveTask'])) {

    $taskManager = new TaskManager();
    $task = $taskManager->createTaskByRequest($_POST);
    $taskManager->save($task);

    $viewController = new ViewController();
    $viewController->showAllTasks();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $taskManager = new TaskManager();
    $id = $_GET['id'];
    $task = $taskManager->getTask($id);

    $viewController = new ViewController();
    $viewController->showEditTaskForm($task);
} 




//получение данных из модели базы данных и отправка данных на вью