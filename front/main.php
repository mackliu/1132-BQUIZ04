<?php
$nav='';
$typeId=$_GET['type']??0;
if($typeId==0){
    $nav="全部商品";
}else{
    $type=$Type->find($typeId);
    if($type['big_id']==0){
        $nav=$type['name'];
    }else{
        $big=$Type->find($type['big_id']);
        $nav=$big['name'] ." > ". $type['name'];
    }
    
}
?>
<h2><?=$nav;?></h2>
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
<?php 
if($typeId==0){
    $rows=$Item->all();
}else if($type['big_id']==0){
    $rows=$Item->all(['big'=>$typeId]);
}else{
    $rows=$Item->all(['mid'=>$typeId]);
}
?>
<?php
foreach($rows as $row):
?>
    <div class='item'>
    <div class='pp'>
        <a href="?do=detail&id=<?=$row['id'];?>">
            <img src="./img/<?=$row['img'];?>" style="width:200px;height:160px">
        </a>
    </div>
    <div>
        <div class='tt ct'>
            <?=$row['name'];?>
            
        </div>
        <div class='pp'>
            價錢:<?=$row['price'];?>
            <img src="./icon/0402.jpg" style="float:right">
        </div>
        <div class='pp'>規格:<?=$row['spec'];?></div>
        <div class='pp'>簡介:<?=mb_substr($row['intro'],0,20);?>...</div>
    </div>
</div>
<?php
endforeach;
?>
