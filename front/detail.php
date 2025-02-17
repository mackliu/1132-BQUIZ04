<?php 
$row=$Item->find($_GET['id']);

?>
<h2 class="ct"><?=$row['name'];?></h2>
<style>
    .item{
        display: flex;
        margin: 3px auto;
        width:85%;
    }
    .item div{
        padding:5px;
        border:1px solid white;
    }
    .item>div:nth-child(1){
        width:40%;
    }
    .item>div:nth-child(2){
        width:60%;
    }
</style>
<div class='item'>
    <div class='pp'>
        <a href="?do=detail&id=<?=$row['id'];?>">
            <img src="./img/<?=$row['img'];?>" style="width:200px;height:160px">
        </a>
    </div>
    <div>
        <div class='pp'>分類:<?=$Type->find($row['big'])['name'] . ">". $Type->find($row['mid'])['name'];?></div>
        <div class='pp'>編號:<?=$row['no'];?></div>
        <div class='pp'>價錢:<?=$row['price'];?></div>
        <div class='pp'>詳細說明:<?=nl2br($row['intro']);?></div>
        <div class='pp'>庫存量:<?=$row['stock'];?></div>
    </div>
</div>
<div class="tt ct">
    <input type="number" name="qt" id="qt" value='1'>
    <img src="./icon/0402.jpg" alt="" onclick="buy()">
</div>

<script>
    function buy(){
        let qt=$("#qt").val();
        location.href=`?do=buycart&id=<?=$_GET['id'];?>&qt=${qt}`;
    }
</script>