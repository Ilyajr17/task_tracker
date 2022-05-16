<?php

require "db.php";
require "config.php";

class DbManager
{
    public function getTasks()
    {
        global $conn;
        $tasksBd = $conn->query(query: "SELECT * FROM tasks");

        while ($result = mysqli_fetch_array($tasksBd, MYSQLI_ASSOC)) {
            $tasks[] = $result;
        }

        return $tasks;
    }

    public function saveTask($task)
    {
        global $conn;
        if (array_key_exists('id', $task)) {
            $id = $task['id'];
            $textTask = $task['textTask'];
            $completed = $task['completed'];
            $str = "UPDATE tasks SET texttask = '$textTask', completed = '$completed' WHERE id = $id";
            $conn->query(query: $str);
        } else {
            $name = $task['name'];
            $email = $task['email'];
            $textTask = $task['textTask'];
            $conn->query(query: "INSERT INTO tasks (name, email, texttask) VALUES ('$name', '$email', '$textTask')");
        }
    }

    public function getTask($id)
    {
        global $conn;
        $tasksBd = $conn->query(query: "SELECT * FROM tasks WHERE  id = $id");
        while ($result = mysqli_fetch_array($tasksBd, MYSQLI_ASSOC)) {
            $tasks[] = $result;
        }
        return $task = $tasks[0];
    }
}
