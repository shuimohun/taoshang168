var queryConditions = {
    cardName: ''
    },
    hiddenAmount = false,
    SYSTEM = system = parent.SYSTEM;
var THISPAGE = {
  init:function(data){
      if(SYSTEM.isAdmin === false && !SYSTEM.rights.AMOUNT_COSTAMOUNT){
          hiddenAmount = true;
      };
      this.mod_PageConfig = Public.mod_PageConfig.init('other-income-list');//页面配置初始化
      this.initDom();
      this.loadGrid();
      this.addEvent();
    },
    initDom: function(){
        this.$_userName = $('#userName');
        this.$_userName.placeholder();
    },
    loadGrid: function(){
        var gridWH = Public.setGrid(), _self = this;
        // queryConditions.beginDate = this.$_beginDate.val();
        // queryConditions.endDate = this.$_endDate.val();
        var colModel = [
            {name:'operating', label:'操作', width:50, fixed:true, formatter:operFmatter, align:"center"},
            {name:"bank_account_name", label:'绑卡姓名', width:120, align:"center"},
            {name:'user_nickname', label:'用户昵称', width:150,align:'center'},
            {name:'bank_name', label:'所属银行', width:200, align:"center"},
            {name:'bank_account_number', label:'银行卡账号', width:210, align:"center"},
            {name:'card_img', label:'银行卡正面照', width:250, align:"center","formatter": handle.imgFmt ,classes:'img_flied'},
            {name:'card_statu_con', label:'状态', width:80, align:"center"},
            {name:'user_mobile', label:'用户手机号', width:120, align:"center"},
            {name:'user_email', label:'用户邮箱', width:150, align:"center"},
        ];
        this.mod_PageConfig.gridReg('grid', colModel);
        colModel = this.mod_PageConfig.conf.grids['grid'].colModel;
        $("#grid").jqGrid({
            url: SITE_URL +'?ctl=Paycen_PayInfo&met=getBankCard&typ=json',
            postData: queryConditions,
            datatype: "json",
            autowidth: true,//如果为ture时，则当表格在首次被创建时会根据父元素比例重新调整表格宽度。如果父元素宽度改变，为了使表格宽度能够自动调整则需要实现函数：setGridWidth
            height: gridWH.h,
            altRows: true, //设置隔行显示
            gridview: true,
            multiselect: false,
            multiboxonly: true,
            colModel:colModel,
            cmTemplate: {sortable: false, title: false},
            page: 1,
            sortname: 'number',
            sortorder: "desc",
            pager: "#page",
            rowNum: 25,
            rowList: [25, 50, 100],
            viewrecords: true,
            shrinkToFit: false,
            forceFit: true,
            jsonReader: {
                root: "data.items",
                records: "data.records",
                repeatitems : false,
                total : "data.total",
                id: "card_id"
            },
            loadError : function(xhr,st,err) {

            },
            ondblClickRow : function(rowid, iRow, iCol, e){
                $('#' + rowid).find('.ui-icon-pencil').trigger('click');
            },
            resizeStop: function(newwidth, index){
                THISPAGE.mod_PageConfig.setGridWidthByIndex(newwidth, index, 'grid');
            }
        }).navGrid('#page',{edit:false,add:false,del:false,search:false,refresh:false}).navButtonAdd('#page',{
            caption:"",
            buttonicon:"ui-icon-config",
            onClickButton: function(){
                THISPAGE.mod_PageConfig.config();
            },
            position:"last"
        });

        function operFmatter (val, opt, row) {
            var html_con = '<div class="operating" data-id="' + row.card_id + '"><span class="ui-icon ui-icon-pencil" title="修改"></span></div>';
            return html_con;
        };



    },
    reloadData: function(data){
        $("#grid").jqGrid('setGridParam',{postData: data}).trigger("reloadGrid");
    },
    addEvent: function(){
        var _self = this;
        //编辑
        $('.grid-wrap').on('click', '.ui-icon-pencil', function(e){
            e.preventDefault();
            var e = $(this).parent().data("id");
            handle.operate("edit", e)
        });
        //删除


        $('#search').click(function(){
            queryConditions.userName = _self.$_userName.val() === '请输入会员昵称' ? '' : _self.$_userName.val();
//            queryConditions.beginDate = _self.$_beginDate.val();
//            queryConditions.endDate = _self.$_endDate.val();
            THISPAGE.reloadData(queryConditions);
        });



        $(window).resize(function(){
            Public.resizeGrid();
        });
    }
};

var handle = {
    operate: function (t, e)
    {
        if ("edit" == t)
        {
            var i = "审核银行卡验证", a = {oper: t, rowData: $("#grid").jqGrid('getRowData',e), callback: this.callback};
            console.info(a);
        }
        $.dialog({
            title: i,
            content: "url:./index.php?ctl=Paycen_PayInfo&met=getEditCard&card_id="+e,
            data: a,
            width: 800,
            height: 800,
            max: !1,
            min: !1,
            cache: !1,
            lock: !0
        })
    }, callback: function (t, e, i)
    {
        window.location.reload();
    },imgFmt: function (val, opt, row)
    {
        if (val)
        {
            val = '<img height="100" width="200" src="' + val + '">';
        }
        else
        {
                val = '<img height="100" width="200" src="' + row.card_img + '">';
        }
        return val;
    }
};

$(function(){

    THISPAGE.init();
});