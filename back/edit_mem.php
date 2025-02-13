<?php 
$row=$Mem->find($_GET['id']);
?>
<h2 class="ct">編輯會員資料</h2>
<!-- form:post>table.all>tr*6>td.tt.ct+td.pp>input:text -->
<form action="./api/reg.php" method="post">
<table class="all">
    <tr>
        <td class="tt ct">帳號</td>
        <td class="pp"><?=$row['acc'];?></td>
    </tr>
    <tr>
        <td class="tt ct">密碼</td>
        <td class="pp"><?=str_repeat("*",strlen($row['pw']));?></td>
    </tr>
    <tr>
        <td class="tt ct">姓名</td>
        <td class="pp"><input type="text" name="name" id="name" value="<?=$row['name'];?>"></td>
    </tr>
    <tr>
        <td class="tt ct">電子信箱</td>
        <td class="pp"><input type="text" name="email" id="email" value="<?=$row['email'];?>"></td>
    </tr>
    <tr>
        <td class="tt ct">地址</td>
        <td class="pp"><input type="text" name="addr" id="addr" value="<?=$row['addr'];?>"></td>
    </tr>
    <tr>
        <td class="tt ct">電話</td>
        <td class="pp"><input type="text" name="tel" id="tel" value="<?=$row['tel'];?>"></td>
    </tr>
</table>
<div class="ct">
    <input type="hidden" name="id" value="<?=$_GET['id'];?>">
    <input type="submit" value="編輯">
    <input type="reset" value="重置">
    <input type="button" value="取消" onclick="location.href='?do=mem'">
</div>
</form>