var api = frameElement.api;
var oper = api.data.oper;
var rowData = api.data.rowData || {};

var callback = api.data.callback;

initPopBtns();
initField();
initEvent();

function initField(){
    // alert(rowData.id)
    if(rowData.id){
        $('#information_pic_image').attr('src',rowData.information_pic);
        $('#information_pic').val(rowData.information_pic);
        $('#information_title').val(rowData.information_title);
        $('#information_url').val(rowData.information_url);
        $('#information_sort').val(rowData.information_sort);
        $('#information_fake_read_count').val(rowData.information_fake_read_count);
        $('#information_group_id').val(rowData.information_group_id);
        $('#information_goods_recommend').val(rowData.information_goods_recommend);
        $('#information_goods_recommend_type').val(rowData.information_goods_recommend_type);
        html1 = '<select nctype="gc" data-deep="1"> <option>'+rowData.information_group_name+'</option>  </select>';
        $('span[nctype="gc1"]').html(html1);
        // html2 = '<select data-deep="2"> <option>'+rowData.information_fake_read_count+'</option>  </select>';
        // $('span[nctype="gc2"]').html(html2);
        //$("textarea[name=information_desc]").val(rowData.information_desc);
        //$("#information_desc").append(rowData.information_desc);
        ue.ready(function() {
            ue.setContent(rowData.information_desc);
        });
        if(rowData.information_status==1)
        {
            $("#information_status1").attr('checked', true);
            $("#information_status2").attr('checked', false);
            $('[for="information_status1"]').addClass('selected');
            $('[for="information_status2"]').removeClass('selected');
        }
        else
        {
            $("#information_status1").attr('checked', false);
            $("#information_status2").attr('checked', true);
            $('[for="information_status1"]').removeClass('selected');
            $('[for="information_status2"]').addClass('selected');
        }
		if(rowData.information_type==1)
        {
            $("#information_type1").attr('checked', true);
            $("#information_type2").attr('checked', false);
            $('[for="information_type1"]').addClass('selected');
            $('[for="information_type2"]').removeClass('selected');
        }
        else
        {
            $("#information_type1").attr('checked', false);
            $("#information_type2").attr('checked', true);
            $('[for="information_type1"]').removeClass('selected');
            $('[for="information_type2"]').addClass('selected');
        }
        // $('#information_image').attr('src',rowData.information_pic);
        // $('#information_logo').val(rowData.information_pic);
        if(rowData.information_recommend==1)
        {
            $("#information_recommend1").attr('checked', true);
            $("#information_recommend2").attr('checked', false);
            $('[for="information_recommend1"]').addClass('selected');
            $('[for="information_recommend2"]').removeClass('selected');
        }
        else
        {
            $("#information_recommend1").attr('checked', false);
            $("#information_recommend2").attr('checked', true);
            $('[for="information_recommend1"]').removeClass('selected');
            $('[for="information_recommend2"]').addClass('selected');
        }
    }
}

function initEvent(){
    $("#type").data("defItem",["information_group_id",rowData.information_group_id]);
    group = $("#type").combo({
        data: SITE_URL + "?ctl=Information_Group&met=queryAllGroup&typ=json",
        value: "information_group_id",
        text: "information_group_title",
        width: 130,
        ajaxOptions: {
            formatData: function (e)
            {
                return e.data.rows;
            }
        },
        defaultSelected: rowData.information_group_id ? $("#type").data("defItem") : void 0
    }).getCombo();
}

function initPopBtns(){
    var operName = oper == "add" ? ["保存", "关闭"] : ["确定", "取消"];
    api.button({
        id: 'confirm',
        name: operName[0],
        focus: true,
        callback: function() {
            postData(oper, rowData.id);
            return false;
        }
    },{
        id: 'cancel',
        name: operName[1]
    });
}

function postData(oper, id){
    /*
     if(!$('#manage-form').validate().form()){
     $('#manage-form').find('textarea.valid-error').eq(0).focus();
     return ;
     }
     */
    /*var	information_title = $.trim($('#information_title').val());
    var information_url = $.trim($('#information_url').val());
    var information_sort = $.trim($('#information_sort').val());
    var information_desc = $("textarea[name=information_desc]").val();
    var information_pic = $.trim($('#information_logo').val());
    var information_status =  $.trim($("input[name='information_status']:checked").val());*/
    // var information_group_id = group.getValue();
    var information_group_id = $("#information_group_id").val();
    var information_id = rowData.id;
    var msg = oper == 'add' ? '新增文章' : '编辑文章';

    //params = {information_title:information_title, information_url:information_url, information_sort:information_sort, information_group_id:information_group_id, information_desc:information_desc, information_pic:information_pic,information_status:information_status};

    //rowData.id?params['information_id']=id:'';
    var params = $("#information_form").serialize();

    Public.ajaxPost( SITE_URL + '?ctl=Information_Base&typ=json&met=' + (oper == 'add' ? 'addInformationBase' : 'editInformationBase&information_id='+information_id) + '&information_group_id='+information_group_id, params, function(data){
        if (data.status == 200) {
            rowData = data.data;
            rowData.operate = oper;
            parent.parent.Public.tips({content : msg + '成功！'});
            if(callback && typeof callback == 'function'){
                callback(rowData, oper, window);
            }
        } else {
            parent.parent.Public.tips({type:1, content : msg + '失败！' + data.msg});
        }
    });
}

function resetForm(data){
    $('#manage-form').validate().resetForm();
    $('#name').val('');
    $('#number').val(Public.getSuggestNum(data.locationNo)).focus().select();
}