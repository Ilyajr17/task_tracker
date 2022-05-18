<?php

namespace App;

class ViewController
{
    public function showCreateTaskForm()
    {
        $viewNewTask = true;
        $viewEdit = false;

        require_once 'task.phtml';
    }

    public function showAllTasks($taskList, $isAdmin)
    {
        if ($isAdmin) {
            $editAllow = true;
        } else {
            $editAllow = false;
        }

        if ($taskList->prePage <= 0) {
            $preDisabled = true;
        } else {
            $preDisabled = false;
        }

        if ($taskList->tasksCount < $taskList->ofset + $taskList->itemsPerPage) {
            $nextDisabled = true;
        } else {
            $nextDisabled = false;
        }

        require_once "tasks.phtml";
    }

    public function showEditTaskForm($task)
    {
        $viewNewTask = false;
        $viewEdit = true;

        require_once "task.phtml";
    }
}
