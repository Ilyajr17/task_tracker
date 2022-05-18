<?php

namespace Core;

class DbAdapter
{
    protected $servername = 'localhost';
    protected $username = 'root';
    protected $password = 'root';
    protected $db = 'bdtask';
    protected $connect;

    function connDb()
    {

        $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->db);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $this->connect = $conn;
    }

    function execSql($sql)
    {

        $result = mysqli_query($this->connect, $sql);
        return $result;
    }
}
