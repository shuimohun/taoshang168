var api = frameElement.api;

initPopBtns();


function initPopBtns(){
    var operName =  ["确定", "取消"];
    api.button({
        id: 'confirm',
        name: operName[0],
        focus: true,
        callback: function() {
            postData(shop_id);
            return false;
        }
    },{
        id: 'cancel',
        name: operName[1]
    });
}

function postData(shop_id){

    var msg = '编辑原因';

    var params = $("#information_form").serialize();

    Public.ajaxPost( SITE_URL + '?ctl=Shop_Npass&met=AddShopNpass&typ=json', params, function(data){
        if (data.status == 200) {
            parent.Public.tips({content : msg + '成功！'});
        } else {
            parent.Public.tips({type:1, content : msg + '失败！' + data.msg});
        }
    });
}

function resetForm(data){
    $('#manage-form').validate().resetForm();
    $('#name').val('');
    $('#number').val(Public.getSuggestNum(data.locationNo)).focus().select();
}