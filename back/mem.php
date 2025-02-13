
<!-- table.all>(tr.tt.ct>td*3)+(tr.pp.ct>td*3) -->

<?php //echo serialize([1,2,3,4,5]); ?>
<table class="all">
    <tr class="tt ct">
        <td>姓名</td>
        <td>會員帳號</td>
        <td>註冊日期</td>
        <td>操作</td>
    </tr>
    <?php
    $rows=$Mem->all();
    foreach($rows as $row):
    ?>
    <tr class="pp ct">
        <td><?=$row['name'];?></td>
        <td><?=$row['acc'];?></td>
        <td><?=date("Y-m-d",strtotime($row['regdate']));?></td>
        <td>
            <button onclick="location.href='?do=edit_mem&id=<?=$row['id'];?>'">修改</button>
            <button onclick="del('Mem',<?=$row['id'];?>)">刪除</button>
        </td>
    </tr>
    <?php
    endforeach;
    ?>
</table>