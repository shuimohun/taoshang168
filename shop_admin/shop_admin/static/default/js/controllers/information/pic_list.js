function getPic() {
    $.post(SITE_URL + "?ctl=Information_Pic&met=getPic&typ=json", function (r) {
        if (r.status == 200) {
            console.log(r.data[0]['config_value']);
            $('#photo_left_image').attr('src',r.data[0]['config_value']);
            $('#photo_right_image').attr('src',r.data[1]['config_value']);
            $('#photo_left_logo').val(r.data[0]['config_value']);
            $('#photo_right_logo').val(r.data[1]['config_value']);
            $('#photo_left_src').val(r.data[2]['config_value']);
            $('#photo_right_src').val(r.data[3]['config_value']);
            if(r.data[2]['config_value']==''){
                $('#photo_left_src').val('http://');
            }
            if(r.data[3]['config_value']==''){
                $('#photo_right_src').val('http://');
            }
        }
    });
}
function AddPicUrl() {
    left = $("#photo_left_src").val();
    right = $("#photo_right_src").val();
    $.post(SITE_URL + "?ctl=Information_Pic&met=addUrl&typ=json",{left:left,right:right},function (u) {
    });
}
getPic();