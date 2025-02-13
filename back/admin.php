<div class="ct">
    <button onclick="location.href='?do=add_admin'">新增管理員</button>
</div>
<!-- table.all>(tr.tt.ct>td*3)+(tr.pp.ct>td*3) -->

<?php //echo serialize([1,2,3,4,5]); ?>
<table class="all">
    <tr class="tt ct">
        <td>帳號</td>
        <td>密碼</td>
        <td>管理</td>
    </tr>
    <?php
    $rows=$Admin->all();
    foreach($rows as $row):
    ?>
    <tr class="pp ct">
        <td><?=$row['acc'];?></td>
        <td><?=str_repeat("*",strlen($row['pw']));?></td>
        <td>
            <?php
            if($row['acc']=='admin'):
                echo "此帳號為最高權限";
            else:
            ?>
            <button>修改</button>
            <button>刪除</button>
            <?php
            endif;
            ?>
        </td>
    </tr>
    <?php
    endforeach;
    ?>
</table>