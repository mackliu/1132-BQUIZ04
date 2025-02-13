<?php include_once "db.php";
$table=$_POST['table'];
$$table->del($_POST['id']);