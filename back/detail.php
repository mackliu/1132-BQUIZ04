<?php $row=$Order->find($_GET['id']);?>
<h2 class="ct">
    訂單編號 
    <span style='color:red'><?=$row['no'];?></span>
    的詳細資料
</h2>
<?php 

?>
<table class="all" style="margin-bottom:0px">
    <tr>
        <td class="tt ct">登入帳號</td>
        <td class="pp"><?=$row['acc'];?></td>
    </tr>
    <tr>
        <td class="tt ct">姓名</td>
        <td class="pp"><?=$row['name'];?></td>
    </tr>
    <tr>
        <td class="tt ct">電子信箱</td>
        <td class="pp"><?=$row['email'];?></td>
    </tr>
    <tr>
        <td class="tt ct">聯絡地址</td>
        <td class="pp"><?=$row['addr'];?></td>
    </tr>
    <tr>
        <td class="tt ct">聯絡電話</td>
        <td class="pp"><?=$row['tel'];?></td>
    </tr>
</table>
<table class="all" style="margin-top:0">
    <tr class="tt ct">
        <td>商品名稱</td>
        <td>編號</td>
        <td>數量</td>
        <td>單價</td>
        <td>小計</td>
    </tr>
    <?php
    
    $cart=unserialize($row['cart']);
    foreach($cart as $id => $qt):
        $item=$Item->find($id);
    ?>
    <tr class="pp">
        <td ><?=$item['name'];?></td>
        <td class="ct"><?=$item['no'];?></td>
        <td class="ct"><?=$qt;?></td>
        <td class="ct"><?=$item['price'];?></td>
        <td class="ct"><?=$item['price']*$qt;?></td>
    </tr>
    <?php
    endforeach;
    ?>
</table>
<div class="all tt ct" style="padding:5px;margin-top:0">總價:<?=$row['total'];?></div>
<div class="ct">
    <button onclick="location.href='?do=order'">返回</button>
</div>