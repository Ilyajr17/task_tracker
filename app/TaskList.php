<?php

namespace App;

class TaskList
{
    public $sortListTask;
    public $isEditAllow = false;
    public $prePage;
    public $nextPage;
    public $tasks;
    public $tasksCount;
    public $ofset;
    public $itemsPerPage;

    public function __construct($sortListTask, $prePage, $nextPage, $tasks, $tasksCount, $ofset, $itemsPerPage)
    {
        $this->sortListTask = $sortListTask;
        $this->prePage = $prePage;
        $this->nextPage = $nextPage;
        $this->tasks = $tasks;
        $this->tasksCount = $tasksCount;
        $this->ofset = $ofset;
        $this->itemsPerPage = $itemsPerPage;
    }
}