<h2 class="ct">商品分類</h2>

<div class="ct">
    新增大分類
    <input type="text" name="big" id="big">
    <button onclick="addType('big')">新增</button>
</div>
<div class="ct">
    新增中分類
    <select name="selbig" id="selbig"></select>
    <input type="text" name="mid" id="mid">
    <button onclick="addType('mid')">新增</button>
</div>

<table class="all">
    <?php
    $bigs=$Type->all(['big_id'=>0]);
    foreach($bigs as $big):
    ?>
    <tr>
        <td class="tt"><?=$big['name'];?></td>
        <td class="tt ct">
            <button data-id="<?=$big['id'];?>" onclick="editType(<?=$big['id'];?>,this)">修改</button>
            <button>刪除</button>
        </td>
    </tr>
    <?php
    if($Type->count(['big_id'=>$big['id']])>0):
        $mids=$Type->all(['big_id'=>$big['id']]);
        foreach($mids as $mid):
    ?>
            <tr class='ct'>
                <td class="pp"><?=$mid['name'];?></td>
                <td class="pp">
                    <button data-id="<?=$mid['id'];?>" onclick="editType(<?=$mid['id'];?>,this)">修改</button>
                    <button>刪除</button>
                </td>
            </tr>
    <?php
        endforeach;
      endif;
    endforeach;
    ?>

</table>
<script>
getBigs();

function addType(type){
    let name,big_id;
    switch(type){
        case 'big':
            name=$("#big").val();
            big_id=0;
            break;
        case 'mid':
            name=$("#mid").val();
            big_id=$("#selbig").val();
            break;
    }

    $.post("./api/save_types.php",{name,big_id},function(){
                /* if(type=='big'){
                    getBigs();
                    $("#big").val("");
                }else{
                    $("#mid").val("");
                } */
                location.reload();
            })
}

function getBigs(){
    $.get("./api/get_bigs.php",function(bigs){
        $("#selbig").html(bigs)
    })
}

function editType(id,dom){
    let typeName=$(dom).parent().prev().text();
    let name=prompt("請輸入你要修改的分類名稱",typeName)

    $.post("./api/save_types.php",{id,name},function(res){
      //  console.log(res);
         //location.reload();
        $(dom).parent().prev().text(name);
    })
}
</script>



<h2 class="ct">商品管理</h2>
<div class="ct">
    <button>新增商品</button>
</div>

<table class="all">
    <tr class="tt">
        <td class="ct">編號</td>
        <td class="ct">商品名稱</td>
        <td class="ct">庫存量</td>
        <td class="ct">狀態</td>
        <td class="ct">操作</td>
    </tr>
    <tr class="pp">
        <td class="ct"></td>
        <td></td>
        <td class="ct"></td>
        <td class="ct"></td>
        <td class="ct"></td>
    </tr>
</table>