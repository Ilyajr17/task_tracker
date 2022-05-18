<?php

namespace Router;

require 'vendor/autoload.php';

use App\TaskListManager;
use App\TaskManager;
use App\ViewController;

session_start();

if (isset($_GET['newTask'])) {
    $viewController = new ViewController();
    $viewController->showCreateTaskForm();

    return;
}

if (isset($_POST['saveTask'])) {

    $taskManager = new TaskManager();
    $task = $taskManager->createTaskByRequest($_POST);
    $taskManager->save($task);

    header('Location: index.php');
}

if (isset($_GET['id'])) {
    $taskManager = new TaskManager();
    $id = $_GET['id'];
    $task = $taskManager->getTask($id);

    $viewController = new ViewController();
    $viewController->showEditTaskForm($task);

    return;
}

if (isset($_GET['exit'])) {
    $_SESSION = [];
    session_destroy();

    header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $currentPage = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;

    $isAdmin = false;
    if (array_key_exists('user', $_SESSION)) {
        if ($_SESSION['user'] === 'admin') {
            $isAdmin = true;
        }
    }

    $sortListTask = '';
    if (isset($_GET['sortby'])) {
        $sortListTask = $_GET['sortby'];
    }

    $taskListManager = new TaskListManager();
    $taskList = $taskListManager->createTaskList($sortListTask, $currentPage);

    $viewController = new ViewController();
    $viewController->showAllTasks($taskList, $isAdmin);
}
