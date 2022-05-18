<?php

namespace App;

use Core\DbAdapter;

class DbManager
{
    public function getTasks($orderby, $ofset, $itemsPerPage)
    {
        $conn = new DbAdapter();
        $conn->connDb();

        switch ($orderby) {
            case 'name':
                $query = "SELECT * FROM tasks ORDER BY name limit $ofset, $itemsPerPage";
                break;
            case 'email':
                $query = "SELECT * FROM tasks ORDER BY email limit $ofset, $itemsPerPage";
                break;
            case 'status':
                $query = "SELECT * FROM tasks ORDER BY completed DESC limit $ofset, $itemsPerPage";
                break;
            default:
                $query = "SELECT * FROM tasks limit $ofset, $itemsPerPage";
        }

        $tasksBd = $conn->execSql($query);

        while ($result = mysqli_fetch_array($tasksBd, MYSQLI_ASSOC)) {
            $tasks[] = $result;
        }
        return $tasks;
    }

    public function saveTask($task)
    {
        $conn = new DbAdapter();
        $conn->connDb();
        if (array_key_exists('id', $task)) {
            $id = $task['id'];
            $textTask = $task['textTask'];
            $completed = $task['completed'];
            $query = "UPDATE tasks SET texttask = '$textTask', completed = '$completed' WHERE id = $id";
            $conn->execSql($query);
        } else {
            $name = $task['name'];
            $email = $task['email'];
            $textTask = $task['textTask'];
            $query = "INSERT INTO tasks (name, email, texttask) VALUES ('$name', '$email', '$textTask')";
            $conn->execSql($query);
        }
    }

    public function getTask($id)
    {
        $conn = new DbAdapter();
        $conn->connDb();

        $query = "SELECT * FROM tasks WHERE  id = $id";
        $tasksBd = $conn->execSql($query);

        while ($result = mysqli_fetch_array($tasksBd, MYSQLI_ASSOC)) {
            $tasks[] = $result;
        }

        $task = $tasks[0];

        return $task;
    }

    public function getTasksCount()
    {
        $conn = new DbAdapter();
        $conn->connDb();
        $query = "SELECT COUNT(*) FROM tasks";
        $tasksBd = $conn->execSql($query);
        while ($result = mysqli_fetch_array($tasksBd, MYSQLI_ASSOC)) {
            $count[] = $result;
        }
        $count = $count[0]['COUNT(*)'];
        return $count;
    }
}
