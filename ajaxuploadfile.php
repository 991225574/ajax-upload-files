<?php 
    $file = $_FILES;
    $param = $_POST;
    var_dump($file);
    // 循环存入文件
    foreach($file as $alonefile){
      $result=move_uploaded_file($alonefile['tmp_name'],iconv("UTF-8","gb2312","uploads/".$alonefile['name']));
      if($result){ //判断是否上传成功
        $show="文件 {$alonefile['name']}上传成功"; //每一个文件名信息存起来
      }
    }

?>