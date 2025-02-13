<?php include_once "db.php";
$Mem->save($_POST);

if(isset($_POST['id'])){
    to("../back.php?do=mem");
}