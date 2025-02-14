<h2 class="ct">修改商品</h2>
<?php
$item=$Item->find($_GET['id']);

?>
<form action="./api/save_item.php" method="post" enctype="multipart/form-data">
<table class="all">
    <tr>
        <td class="tt ct">所屬大分類</td>
        <td class="pp">
            <select name="big" id="big"></select>
        </td>
    </tr>
    <tr>
        <td class="tt ct">所屬中分類</td>
        <td class="pp">
            <select name="mid" id="mid"></select>
        </td>
    </tr>
    <tr>
        <td class="tt ct">商品編號</td>
        <td class="pp"><?=$item['no'];?></td>
    </tr>
    <tr>
        <td class="tt ct">商品名稱</td>
        <td class="pp"><input type="text" name="name" id="name" value="<?=$item['name'];?>"></td>
    </tr>
    <tr>
        <td class="tt ct">商品價格</td>
        <td class="pp"><input type="text" name="price" id="price" value="<?=$item['price'];?>"></td>
    </tr>
    <tr>
        <td class="tt ct">規格</td>
        <td class="pp"><input type="text" name="spec" id="spec" value="<?=$item['spec'];?>"></td>
    </tr>
    <tr>
        <td class="tt ct">庫存量</td>
        <td class="pp"><input type="text" name="stock" id="stock" value="<?=$item['stock'];?>"></td>
    </tr>
    <tr>
        <td class="tt ct">商品圖片</td>
        <td class="pp"><input type="file" name="img" id="img"></td>
    </tr>
    <tr>
        <td class="tt ct">商品介紹</td>
        <td class="pp"><textarea name="intro" id="intro" ><?=$item['intro'];?></textarea></td>
    </tr>
</table>
<div class="ct">
    <input type="hidden" name="id" value="<?=$item['id'];?>">
    <input type="submit" value="修改">
    <input type="reset" value="重置">
    <input type="button" value="返回">
</div>
</form>
<script>

getTypes('big');

$("#big").on("change",function(){
    getTypes('mid');
})

function getTypes(type){
    let big_id=0;
    if(type=='mid'){
        big_id=$("#big").val();
    }

    $.get("./api/get_types.php",{type,big_id},function(types){
        switch(type){
            case 'big':
                $("#big").html(types)
                $("#big option[value='<?=$item['big'];?>']").prop('selected',true)
                getTypes('mid');
                break;
            case 'mid':
                $("#mid").html(types)
                $("#mid option[value='<?=$item['mid'];?>']").prop('selected',true)
                break;
        }
      
    })
}




</script>