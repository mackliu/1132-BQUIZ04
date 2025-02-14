<?php include_once "db.php";

if(isset($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$_FILES['img']['name']);
    $_POST['img']=$_FILES['img']['name'];
}

if(!isset($_POST['id'])){
    $_POST['sh']=1;
    $_POST['no']=rand(100000,999999);
}

$Item->save($_POST);

to("../back.php?do=th");