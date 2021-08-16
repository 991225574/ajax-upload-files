<form enctype="multipart/form-data">
    <div class="form-group">
        <label for="upload_name">名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="upload_name" placeholder="请输入名称">
        </div>
    </div>
    <div class="form-group">
        <label for="testfile">上传文件</label>
        <div class="col-sm-10">
            <input type="file" accept=".xlsx" id="testfile">
            <!-- 多文件上传:<input type="file" accept=".xlsx" id="testfile" multiple="multiple"/> -->
        </div>
    </div>
</form>
<input type="button" class="submit" value="上传">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $('.submit').click(function () {
        var files = $('#testfile').prop('files');
        var name = $.trim($('#upload_name').val());
        if (files.length <= 0) {
            alert("请选择文件");
            return;
        }
        // 创建fromdata对象
        var formData = new FormData();

        /* 1.使用formdata存入文本和文件 */
        formData.append("name", name);  //通过formData追加键值对方式存文本值
        formData.append("testfile", files[0]);  //通过formData追加键值对方式存文件; testfile为键值,files[0]为文件
      
        // 多文件上传需要给参数名称后面加上[]
        // formData.append("testfile[]", files[1]);

        /* 2.线上创建一个文件，使用formdata存入文本和文件 */

        //使用fiel创建一个文件，然后formdata存入文件; ['foo']是UTF-8 编码的文件内容，foo.txt文件名
        var file = new File(["foo"], "foo.txt", {
          type: "text/plain",
        });
        formData.append("newfile", file);

        /* 3.把64编码数据转为文件，，然后formdata存入文件 */

        // base64toFile（图片的64编码，文件名字); 
        function base64toFile (dataurl, filename = 'file') {
       
        let arr = dataurl.split(',')          //把图片的base64解码和数据类型分开存入两个数组
        let mime = arr[0].match(/:(.*?);/)[1] //把 "data:image/jpeg;base64"的image/jpeg图片类型匹配出来
        let suffix = mime.split('/')[1]       //把 image/jpeg图片类型的jpeg图片格式匹配出来
        let bstr = atob(arr[1])               //atob() 方法用于解码使用 base-64 编码的字符串。
        let n = bstr.length                        
        let u8arr = new Uint8Array(n)       //创建8 位无符号整数值的类型化数组且实例化长度

        while (n--) {                       //从n--开始，因为数组下标为0开始
            u8arr[n] = bstr.charCodeAt(n)   //charCodeAt(字符串索引)返回bstr字符串的unicode编码，再存入u8arr数组中
        }
        return new File([u8arr], `${filename}.${suffix}`, { //${filename}.${suffix}为文件名和文件格式
            type: mime  //类型image/jpeg;
        })
      }

      var dataurl='data:image/jpeg;base64,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';

      //调用函数，返回转成的文件
      var imgfile=base64toFile (dataurl)
      formData.append("imgfile", imgfile);

      //使用ajax返回后台
        $.ajax({
            url:'./ajaxuploadfile.php',
            type:'POST',
            async: false,
            data: formData,       //直接发送formdata存储的文本和文件
            dataType:'json',
            cache: false,         // 上传文件无需缓存
            processData : false, //必须false才会避开jQuery对 formdata 的默认处理,XMLHttpRequest会对 formdata 进行正确的处理
            contentType : false, // 不要设置Content-Type请求头 false才会自动加上正确的Content-Type
            success: function(data){
                console.log(data);
                if (data.status == 'ok') {
                    alert('上传成功！');
                }
            },
            error:function(response){
                console.log(response);
            }
        });
    })
</script>
