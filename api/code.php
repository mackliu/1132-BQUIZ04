<?php
    session_start();
    $_SESSION['ans']=code(6);
    echo captcha($_SESSION['ans']);

    /**
     * 設計兩個function用來產生驗證碼和圖形
     * 驗證碼的部份可以指定長度也可以由函式亂數決定
     * 回傳值 :string
     */

     function code($length=5)
     {
         // 定義一個包含所有可能字元的字元池
         $charPool = array_merge(range(0, 9), range('A', 'Z'), range('a', 'z'));
         
         // 如果參數有指定長度，使用指定的長度，否則產生4到8之間的隨機長度
         $length = $length ?? rand(4, 8);
 
         // 如果長度超過字元池長度，則報錯或調整為字元池的最大長度
         if ($length > count($charPool)) {
             throw new InvalidArgumentException('指定的長度超過了字元池的最大長度。');
         }
 
         // 使用 array_rand 從字元池中隨機選取不重複的字元
         $keys = array_rand($charPool, $length);
 
         // 把選取的字元連結成字串
         $gstr = implode('', array_map(fn($key) => $charPool[$key], (array)$keys));
 
         return $gstr;
     }
 
     function captcha($str)
     {
         $gstr = $str;
 
         //定義字型大小
         $fontsize = 20;
 
         //建立一個陣列用來儲存每一個字元的圖形資訊
         $text_info = [];
 
         //建立兩個變數用來計算所有字元的總寬度及最大高度
         $dst_w = 0;
         $dst_h = 0;
 
         //使用迴圈來逐一分析每個字元的圖形資訊
         for ($i = 0; $i < mb_strlen($gstr); $i++) {
 
             //使用mb_substr()順序取出每一個字元
             $char = mb_substr($gstr, $i, 1);
 
             //使用亂數產生一個正負之間的傾斜的角度
             $text_info[$char]['angle'] = rand(-35, 35);
 
             //使用imagettfbbox()來取得單一字元在大小,角度和字型的影響下，字元圖形的四個角的坐標資訊陣列
             $tmp = imagettfbbox($fontsize, $text_info[$char]['angle'], realpath('./fonts/arial.ttf'), $char);
 
             //利用字元的資訊，使用x坐標的最大值減最小值來計算出字元寬度，使用y坐標的最大值-最小值來計出字元高度
             //因坐標特性，需要加上1才能得到正確的寬度及高度
             $text_info[$char]['width'] = max($tmp[0], $tmp[2], $tmp[4], $tmp[6]) - min($tmp[0], $tmp[2], $tmp[4], $tmp[6]) + 1;
             $text_info[$char]['height'] = max($tmp[1], $tmp[3], $tmp[5], $tmp[7]) - min($tmp[1], $tmp[3], $tmp[5], $tmp[7]) + 1;
 
             //累加每個字元的寬度來計算總寬度
             $dst_w += $text_info[$char]['width'];
 
             //比較每一次字元的高度來決定最大高度
             $dst_h = ($dst_h >= $text_info[$char]['height']) ? $dst_h : $text_info[$char]['height'];
 
             //根據字型的資訊來取得字元的左上角坐標
             $text_info[$char]['x'] = min($tmp[0], $tmp[2], $tmp[4], $tmp[6]);
             $text_info[$char]['y'] = min($tmp[1], $tmp[3], $tmp[5], $tmp[7]);
         }
         /*         echo "<pre>";
         print_r($text_info);
         echo "</pre>"; */
         //建立一個邊框的厚度變數
         $border = 10;
 
         //使用計算出來的總寬度和最大高度加上邊框厚度來計算驗證碼圖形的完整寬高
         $base_w = $dst_w + ($border * 2);
         $base_h = $dst_h + ($border * 2);
 
         //根據計算出來的驗證碼圖形完整寬高來建立一個全彩圖形資源
         $dst_img = imagecreatetruecolor($base_w, $base_h);
 
         //顏色定義區
         $white = imagecolorallocate($dst_img, 255, 255, 255);
         $black = imagecolorallocate($dst_img, 0, 0, 0);
         $blue = imagecolorallocate($dst_img, 0, 0, 255);
         $red = imagecolorallocate($dst_img, 255, 0, 0);
         $green = imagecolorallocate($dst_img, 0, 255, 0);
 
         //顏色陣列
         $colors = [
             imagecolorallocate($dst_img, 255, 127, 80),
             imagecolorallocate($dst_img, 204, 85, 0),
             imagecolorallocate($dst_img, 184, 115, 51),
             imagecolorallocate($dst_img, 204, 119, 34),
             imagecolorallocate($dst_img, 112, 66, 20),
             imagecolorallocate($dst_img, 80, 200, 120),
             imagecolorallocate($dst_img, 222, 49, 99),
             imagecolorallocate($dst_img, 128, 0, 0),
             imagecolorallocate($dst_img, 255, 204, 0),
             imagecolorallocate($dst_img, 128, 128, 0),
             imagecolorallocate($dst_img, 0, 255, 128),
             imagecolorallocate($dst_img, 0, 128, 128),
             imagecolorallocate($dst_img, 0, 0, 128),
             imagecolorallocate($dst_img, 75, 0, 128),
             imagecolorallocate($dst_img, 255, 140, 105),
             imagecolorallocate($dst_img, 218, 112, 214),
             imagecolorallocate($dst_img, 255, 128, 51),
         ];
 
         //填入底色        
         imagefill($dst_img, 0, 0, $white);
 
         //建立一個開始繪製文字圖形的起始坐標，由邊框的厚度開始繪製
         $x_pointer = $border;
 
         //使用迴圈把驗證碼文字逐一寫入到圖片中
         foreach ($text_info as $char => $info) {
 
             //計算放置的y坐標範圍，字元的高度加上邊框起始點(5)及總高度-底部坐標終點的限制(5)
             $y = rand($info['height'] + 5, $info['height'] + ($border * 2 - 5 * 2));
 
             //將字元依照大小，角度，坐標，顏色，字型等資訊畫在畫布上
             imagettftext($dst_img, $fontsize, $info['angle'], $x_pointer, $y, $colors[rand(0, count($colors) - 1)], realpath('./fonts/arial.ttf'), $char);
 
             //依照字元的寬度及字元的x坐標來產生下一個字元的x坐標起點
             $x_pointer = $x_pointer + $info['width'] + $info['x'] + 1;
         }
 
         //建立一個線條範圍亂數，決定圖形驗證碼上的干擾線數量
         $lines = rand(3, 6);
 
         //使用迴圈來產生每一條干擾線
         for ($i = 0; $i < $lines; $i++) {
 
             //使用亂數來產生起點x坐標，限定範圍為5開始到邊框厚度—5*2之間
             $left_x = rand(5, $border - (5 * 2));
 
             //使用亂數來產生起點y坐標，限定範圍為5開始到總高度—5之間
             $left_y = rand(5, $base_h - 5);
 
             //使用亂數來產生終點x坐標，限定範圍為邊框厚度開始到邊框厚度—5*2之間
             $right_x = rand($base_w - $border + 5, $base_w - 5);
 
             //使用亂數來產生終點y坐標，限定範圍為5開始到總高度—5之間
             $right_y = rand(5, $base_h - 5);
 
             //根據計算出來的起點和終點坐標來畫出干擾線
             imageline($dst_img, $left_x, $left_y, $right_x, $right_y, $colors[rand(0, count($colors) - 1)]);
         }
 
         //開啟輸出緩衝區(output buffer)
         ob_start();
         
         //產生png格式的圖片，此時會先暫時存放在緩衝區中不送出去
         imagepng($dst_img);
 
         //將緩衝區中的圖形圖片資料取回來指定給變數$output
         $output = ob_get_clean();
 
         //刪除處理完畢的圖形資源資料
         imagedestroy($dst_img);
 
         //使用base64的方式把緩衝區中的二進位圖形資料轉成base64的字串格式回傳出去
         //前方的data:image/png:base64, 是資料格式的宣告,讓瀏灠器可以知道這一段文字的功能是什麼
         return "data:image/png;base64," . base64_encode($output);
     }