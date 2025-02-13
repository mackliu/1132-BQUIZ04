<?php include_once "db.php";


$_POST['pr']=serialize($_POST['pr']);
$Admin->save($_POST);


to("../back.php?do=admin");