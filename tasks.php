<?php

session_start();

require_once 'bd.php';

$currentPage = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
$itemsPerPage = 10;
$ofset = ($currentPage * $itemsPerPage) - $itemsPerPage;
$tasksBd = $conn->query(query: "SELECT * FROM tasks limit $ofset, $itemsPerPage");

$nextPage = $currentPage + 1;

$prePage = $currentPage - 1;

if ($prePage <= 0) {
  $preDisabled = true;
} else {
  $preDisabled = false;
}

$editAllowed = false;
if (array_key_exists('user', $_SESSION)) {

  if ($_SESSION['user'] === 'admin') {
    $editAllowed = true;
  }
}

if (isset($_GET['sortingEmail'])) {
  $_SESSION['sort'] = 'email';
}

if (isset($_GET['sortingName'])) {
  $_SESSION['sort'] = 'name';
}


if (isset($_GET['sortingStatus'])) {
  $_SESSION['sort'] = 'status';
}


if (array_key_exists('sort', $_SESSION)) {
  if ($_SESSION['sort'] === 'email') {
    $tasksBd = $conn->query(query: "SELECT * FROM tasks ORDER BY email limit $ofset, $itemsPerPage");
  }
}
if (array_key_exists('sort', $_SESSION)) {
  if ($_SESSION['sort'] === 'name') {
    $tasksBd = $conn->query(query: "SELECT * FROM tasks ORDER BY name limit $ofset, $itemsPerPage");
  }
}
if (array_key_exists('sort', $_SESSION)) {
  if ($_SESSION['sort'] === 'status') {
    $tasksBd = $conn->query(query: "SELECT * FROM tasks ORDER BY completed DESC limit $ofset, $itemsPerPage");
  }
}
while ($result = mysqli_fetch_array($tasksBd, MYSQLI_ASSOC)) {
  $tasks[] = $result;
}

foreach ($tasks as $index => $task) {
  if ($task['completed'] == 1) {
    $tasks[$index]['completed'] = 'отредактировано администратором';
  } else {
    $tasks[$index]['completed'] = '';
  }
}

$countBd = $conn->query(query: "SELECT COUNT(*) FROM tasks");
while ($result = mysqli_fetch_array($countBd, MYSQLI_ASSOC)) {
  $count[] = $result;
}
$count = $count[0]['COUNT(*)'];

if ($count < $ofset + $itemsPerPage) {
  $nextDisabled = true;
} else {
  $nextDisabled = false;
}



require_once 'tasks.phtml';
