<?php
if(isset($_POST['bottom'])){
    $Bot->save($_POST);
}

?>
<h2 class="ct">編輯頁尾版權區</h2>
<!-- form:post>table.all>tr>td.tt.ct+td.pp>input:text -->
<form action="?do=bot" method="post">
    <table class="all">
        <tr>
            <td class="tt ct">頁尾宣告內容</td>
            <td class="pp">
                <input type="text" name="bottom"  value="<?=$Bot->find(1)['bottom'];?>">
            </td>
        </tr>
    </table>
    <div class="ct">
        <input type="hidden" name="id" value="1">
        <input type="submit" value="編輯">
        <input type="reset" value="重置">
    </div>
</form>