<?php

namespace App;

use App\DbManager;

class TaskManager
{
    public function createTaskByRequest($request)
    {
        if (array_key_exists('completed', $request)) {
            $completed = 1;
        } else {
            $completed = 0;
        }
        $task = $request;
        $task['completed'] = $completed;

        return $task;
    }

    public function save($task)
    {
        $dbManager = new DbManager();
        $dbManager->saveTask($task);
    }

    public function getTask($id)
    {
        $dbManager = new DbManager();

        return $dbManager->getTask($id);
    } 
}
