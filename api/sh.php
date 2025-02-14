<?php include_once "db.php";

$row=$Item->find($_POST['id']);

switch($_POST['type']){
    case 1:
        $row['sh']=1;
    break;
    case 2:
        $row['sh']=0;
    break;
}

$Item->save($row);