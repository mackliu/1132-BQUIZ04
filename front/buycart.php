<?php
if(!isset($_SESSION['cart'])){
    $_SESSION['cart']=[];
}

if(!empty($_GET['id'])){
    $_SESSION['cart'][$_GET['id']]=$_GET['qt'];
}

if(!isset($_SESSION['Mem'])){
 to("index.php?do=login");
}

?>
<h2 class="ct"><?=$_SESSION['Mem'];?>的購物車</h2>