<h2>第一次購物</h2>
<a href="?do=reg">
    <img src="./icon/0413.jpg" alt="">
</a>
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
            <img src="" alt="" id="chapcha">
            <input type="text" name="ans" id="ans"></td>
    </tr>
</table>
<div class="ct"><button onclick="login()">確認</button></div>

<script>
    $.get("./api/code.php",function(res){
        $("#chapcha").attr("src",res)
    })

    function login(){
        let ans=$("#ans").val();
    
        $.get("./api/chk_ans.php",{ans},function(res){
            //console.log(ans,res)
            if(parseInt(res)){
                $.get("api/chk_pw.php",{
                    acc:$("#acc").val(),
                    pw:$("#pw").val(),
                    table:"Mem"
                },function(res){
                    //console.log(res)
                    if(parseInt(res)){
                       location.href='index.php';
                    }else{
                        alert("帳號或密碼錯誤")
                    }
                }
            )
            }else{
                alert("驗證碼錯誤，請重新輸入")
            }
        })
    }
</script>