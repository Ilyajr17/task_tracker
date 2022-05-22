<?php

namespace App;

class ViewController
{
    public function showCreateTaskForm()
    {
        // $viewNewTask = true;
        // // $viewEdit = false;
         $swithView = true;

        require_once 'task.phtml';
    }

    public function showAllTasks($taskList, $isAdmin)
    {
        $editAllow = $isAdmin ? true : false;
  
        $preDisabled = $taskList->prePage <= 0 ? true : false;
     
        $nextDisabled = $taskList->tasksCount < $taskList->ofset + $taskList->itemsPerPage ? true : false;
    
        require_once "tasks.phtml";
    }

    public function showEditTaskForm($task)
    {
        $swithView = false;
        // $viewNewTask = false;
        // $viewEdit = true;

        require_once "task.phtml";
    }
}
