<?php include_once "db.php";

$table=$_GET['table'];

unset($_GET['table']);
$chk=$$table->count($_GET);
/* dd($_GET);
dd($chk); */
if($chk){
    echo 1;
    $_SESSION[$table]=$_GET['acc'];
}else{
    echo 0;
}

