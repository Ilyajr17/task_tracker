<?php

namespace App;

use App\DbManager;
use App\TaskList;

class TaskListManager
{
  public function createTaskList($sortListTask, $currentPage)
  {
    $nextPage = $currentPage + 1;
    $prePage = $currentPage - 1;

    $itemsPerPage = 10;

    $ofset = ($currentPage * $itemsPerPage) - $itemsPerPage;

    $dbManager = new DbManager();
    $tasksCount = $dbManager->getTasksCount();
    $tasks = $dbManager->getTasks($sortListTask, $ofset, $itemsPerPage);

    return new TaskList($sortListTask, $prePage, $nextPage, $tasks, $tasksCount, $ofset, $itemsPerPage);
  }
}
