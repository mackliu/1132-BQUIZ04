<?php include_once "db.php";

$table=$_GET['table'];

unset($_SESSION[$table]);

to("../index.php");