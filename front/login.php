<h2>第一次購物</h2>
<img src="./icon/0413.jpg" alt="">
<h2>會員登入</h2>
<table class="all">
    <tr>
        <td class="tt ct">帳號</td>
        <td class="pp"><input type="text" name="acc" id="acc"></td>
    </tr>
    <tr>
        <td class="tt ct">密碼</td>
        <td class="pp"><input type="password" name="pw" id="pw"></td>
    </tr>
    <tr>
        <td class="tt ct">驗證碼</td>
        <td class="pp">
            <?php
                $a=rand(10,99);
                $b=rand(10,99);
                $_SESSION['ans']=$a+$b;
                echo $a . " + " . $b . " = ";
            ?>
            <input type="text" name="ans" id="ans"></td>
    </tr>
</table>
<div class="ct"><button onclick="login()">確認</button></div>

<script>
    function login(){
        let ans=$("#ans").val();
        $.get("./api/chk_ans.php",{ans},function(res){
            //console.log(ans,res)
            if(parseInt(res)){
                alert("正確")
            }else{
                alert("驗證碼錯誤，請重新輸入")
            }
        })
    }
</script>