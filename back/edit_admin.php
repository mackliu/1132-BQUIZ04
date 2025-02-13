<?php

$row=$Admin->find($_GET['id']);
$userPr=unserialize($row['pr']);
?>
<h2 class="ct">修改管理權限</h2>
<form action="./api/save_admin.php" method="post">
<table class="all">
    <tr>
        <td class="tt ct">帳號</td>
        <td class="pp">
            <input type="text" name='acc' id='acc' value="<?=$row['acc'];?>">
        </td>
    </tr>
    <tr>
        <td class="tt ct">密碼</td>
        <td class="pp">
            <input type="password" name='pw' id='pw' value="<?=$row['pw'];?>">
        </td>
    </tr>
    <tr>
        <td class="tt ct">權限</td>
        <td class="pp">
            <div>
                <input type="checkbox" name="pr[]" value="1" <?=(in_array(1,$userPr))?'checked':'';?>>商品分類與管理
            </div>
            <div>
                <input type="checkbox" name="pr[]" value="2" <?=(in_array(2,$userPr))?'checked':'';?>>訂單管理
            </div>
            <div>
                <input type="checkbox" name="pr[]" value="3" <?=(in_array(3,$userPr))?'checked':'';?>>會員管理
            </div>
            <div>
                <input type="checkbox" name="pr[]" value="4" <?=(in_array(4,$userPr))?'checked':'';?>>頁尾版權管理
            </div>
            <div>
                <input type="checkbox" name="pr[]" value="5" <?=(in_array(5,$userPr))?'checked':'';?>>最新消息管理
            </div>
        </td>
    </tr>
</table>
<div class="ct">
    <input type="hidden" name="id" value="<?=$row['id'];?>">
    <input type="submit" value="修改">
    <input type="reset" value="重置">
</div>
</form>