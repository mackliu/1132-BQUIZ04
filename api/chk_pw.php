<?php include_once "db.php";

$chk=$Mem->count($_GET);
/* dd($_GET);
dd($chk); */
if($chk){
    echo 1;
    $_SESSION['login']=$_GET['acc'];
}else{
    echo 0;
}

