var api = frameElement.api;
var oper = api.data.oper;
var rowData = api.data.rowData || {};
var callback = api.data.callback;

function initField() {
    if (rowData.id) {
        $.get(SITE_URL + '?ctl=Shop_Certificate&met=getCatCertificateById&typ=json&id=' + rowData.id, function(data) {
            if (data.status == 200) {
                var cat_id = data.data['cat_id'];
                $.get(SITE_URL + '?ctl=Goods_Cat&met=getCat&typ=json&cat_id=' + cat_id, function(d) {
                    if (d.status == 200) {
                        $.each(d.data, function(k, v) {
                            k += 1;
                            $("span[nctype=gc" + k + "]").empty();
                            $("span[nctype=gc" + k + "]").append(v['cat_name']);
                            $("#cat_id").val(v['cat_id']), $("#cat_name").val(v['cat_name']);
                        })
                    }
                });

                var text_append = '';
                var obj = $("#selected_list");
                $.each(data.data['shop_certificate'], function(key, val) {
                    var id = val['id'];
                    var name = val['name'];
                    text_append += '<li data-id='+id+' onclick="del(this);"><div><span>' + name + '</span></div>';
                    if(val['type'] == '1'){
                        text_append += "<div class='cer_type'>进口</div>";
                    }
                    text_append += '<input name="certificate_id[]" value="'+id+'" type="hidden"></li>';
                });
                obj.find("ul").append(text_append);
            }
        });
    }
}

function initPopBtns() {
    var operName = oper == "add" ? ["保存", "关闭"] : ["确定", "取消"];
    api.button({
        id: 'confirm',
        name: operName[0],
        focus: true,
        callback: function() {
            postData(oper, rowData.id);
            return false;
        }
    }, {
        id: 'cancel',
        name: operName[1]
    });
}

function postData(oper, id) {
    var id = rowData.id;
    var msg = oper == 'add' ? '新增' : '编辑';
    var cat_id = $("#cat_id").val();
    if(!cat_id){
        parent.parent.Public.tips({
            type: 1,
            content: '请选择分类'
        });
        return false;
    }
    var params = $("#cat_certificate_form").serialize();
    Public.ajaxPost(SITE_URL + '?ctl=Shop_Certificate&typ=json&met=' + (oper == 'add' ? 'addCatCertificate' : 'editCatCertificate'), params, function(data) {
        if (data.status == 200) {
            rowData = data.data;
            rowData.operate = oper;
            parent.parent.Public.tips({
                content: msg + '成功！'
            });
            if (callback && typeof callback == 'function') {
                callback(rowData, oper, window);
            }
        } else {
            parent.parent.Public.tips({
                type: 1,
                content: msg + '失败！' + data.msg
            });
        }
    });
}

function initFilter() {
    //查询条件
    Business.filterBrand();

}

initPopBtns();
initField();
initFilter();