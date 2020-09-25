
    //上传照片
    function checkinfo(obj){
        var len = obj.files.length;
        console.log(obj.files);
        for (var i =0 ; i < len ; i++){
            showimg(obj.files[i]);
        }
    }

    function showimg(img){
        var a = new FileReader();
        a.readAsDataURL(img);
        a.onload=function(){
            var img = new Image();
            img.src=a.result;
            document.getElementById('win_L').appendChild(img);
        }
    }



    $(function(){
        $('.remove').click(function(){
            $('#win_L').empty();
        })
    });