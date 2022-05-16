<?php

require 'TaskManager.php';

class ViewController
{
    public function showNewCreateTaskForm()
    {
        $viewNewTask = true;
        $viewEdit = false;
        
        require_once 'task.phtml';
    }

    public function showAllTasks()
    {
        header('Location: tasks.php');
    }

    public function showEditTaskForm($task)
    {
        $viewNewTask = false;
        $viewEdit = true;

        require_once "task.phtml";
    }
}
