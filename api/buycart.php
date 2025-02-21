<?php include_once "db.php";
if(!empty($_POST)){
    $_SESSION['cart'][$_POST['id']]=$_POST['qt'];
}

if(isset($_SESSION['cart'])){
    echo count($_SESSION['cart']);
}else{
    echo 0;
}
?>