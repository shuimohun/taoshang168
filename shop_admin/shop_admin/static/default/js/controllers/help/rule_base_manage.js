var api = frameElement.api;
var oper = api.data.oper;
var rowData = api.data.rowData || {};
var callback = api.data.callback;

initPopBtns();
initField();
initEvent();

function initField(){
    if(rowData.id){
        $('#help_title').val(rowData.help_title);
        $('#help_url').val(rowData.help_url);
        $('#help_sort').val(rowData.help_sort);

        //$("textarea[name=help_desc]").val(rowData.help_desc);
        //$("#help_desc").append(rowData.help_desc);
        ue.ready(function() {
            ue.setContent(rowData.help_desc);
        });
        if(rowData.help_status==1)
        {
            $("#help_status1").attr('checked', true);
            $("#help_status2").attr('checked', false);
            $('[for="help_status1"]').addClass('selected');
            $('[for="help_status2"]').removeClass('selected');
        }
        else
        {
            $("#help_status1").attr('checked', false);
            $("#help_status2").attr('checked', true);
            $('[for="help_status1"]').removeClass('selected');
            $('[for="help_status2"]').addClass('selected');
        }
		if(rowData.help_type==1)
        {
            $("#help_type1").attr('checked', true);
            $("#help_type2").attr('checked', false);
            $('[for="help_type1"]').addClass('selected');
            $('[for="help_type2"]').removeClass('selected');
        }
        else
        {
            $("#help_type1").attr('checked', false);
            $("#help_type2").attr('checked', true);
            $('[for="help_type1"]').removeClass('selected');
            $('[for="help_type2"]').addClass('selected');
        }
        $('#help_image').attr('src',rowData.help_pic);
        $('#help_logo').val(rowData.help_pic);
        html1 = '<select nctype="gc" data-deep="1"> <option>'+rowData.help_group_name_c+'</option>  </select>';
        $('span[nctype="gc1"]').html(html1);
        $('#help_group_id').val(rowData.help_group_id);
        html2 = '<select data-deep="2"> <option>'+rowData.help_group_name+'</option>  </select>';
        $('span[nctype="gc2"]').html(html2);
        $('.ctn-wrap p').html('');
    }
}

function initEvent(){
    $("#type").data("defItem",["help_group_id",rowData.help_group_id]);
    group = $("#type").combo({
        data: SITE_URL + "?ctl=Help_RuleGroup&met=queryAllGroup&typ=json",
        value: "help_group_id",
        text: "help_group_title",
        width: 130,
        ajaxOptions: {
            formatData: function (e)
            {
                return e.data.rows;
            }
        },
        defaultSelected: rowData.help_group_id ? $("#type").data("defItem") : void 0
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
    /*var	help_title = $.trim($('#help_title').val());
    var help_url = $.trim($('#help_url').val());
    var help_sort = $.trim($('#help_sort').val());
    var help_desc = $("textarea[name=help_desc]").val();
    var help_pic = $.trim($('#help_logo').val());
    var help_status =  $.trim($("input[name='help_status']:checked").val());*/
    // var help_group_id = group.getValue();
    var help_group_id =  $("#help_group_id").val();

    var help_id = rowData.id;
    var msg = oper == 'add' ? '新增规则' : '编辑规则';

    //params = {help_title:help_title, help_url:help_url, help_sort:help_sort, help_group_id:help_group_id, help_desc:help_desc, help_pic:help_pic,help_status:help_status};

    //rowData.id?params['help_id']=id:'';
    var params = $("#help_form").serialize();
    Public.ajaxPost( SITE_URL + '?ctl=Help_RuleBase&typ=json&met=' + (oper == 'add' ? 'addHelpBase' : 'editHelpBase&help_id='+help_id) + '&help_group_id='+help_group_id, params, function(data){
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