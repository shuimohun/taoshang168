urlParam = Public.urlParam();
	var queryConditions = {"otyp":urlParam.otyp},
		hiddenAmount = false, 
		SYSTEM = system = parent.SYSTEM;
		if ( window.location.href.indexOf('met=virtualOrder') > -1 ) {
			queryConditions.action = 'virtual';
		}

	var THISPAGE = {
		init: function(data){
			if (SYSTEM.isAdmin === false && !SYSTEM.rights.AMOUNT_COSTAMOUNT) {
				hiddenAmount = true;
			};
			this.mod_PageConfig = Public.mod_PageConfig.init('other-income-list');//页面配置初始化
			this.initDom();
			this.loadGrid();            
			this.addEvent();
		},
		
		initDom: function(){
			this.$_searchName = $('#searchName');

			$('#filter-fromDate').datetimepicker({lang:'ch'}).prop('readonly', 'readnoly');
			$('#filter-toDate').datetimepicker({lang:'ch'}).prop('readonly', 'readnoly');
		},
		
		loadGrid: function(){
			var gridWH = Public.setGrid(), _self = this;
			
			var colModel = [
				{name:'operating', label:'操作', width:100,fixed:true, formatter:operFmatter, align:"center"},
				{name:'order_id', label:'订单编号', width:220, align:"center"},
				{name:'order_from_text', label:'订单来源',  width:70, align:"center"},
				{name:'order_create_time', label:'下单时间', width:130,align:'center'},
				{name:'order_goods_amount', label:'订单金额(元)', width:80, align:"center"},
				{name:'order_status_text', label:'订单状态', width:80,align:"center"},
                {name:'order_refund_state_text', label:'退款状态', width:80,align:"center"},
                {name:'order_return_state_text', label:'退货状态', width:80,align:"center"},
				{name:'payment_number', label:'支付单号',  width:150, align:"center"},
				{name:'payment_name', label:'支付方式',  width:70, align:"center"},
                {name:'payment_channel_text', label:'付款方式',  width:70, align:"center"},
				{name:'payment_time', label:'支付时间',  width:130, align:"center"},
				{name:'order_shipping_code', label:'发货物流单号',  width:100, align:"right"},
				{name:'order_refund_amount', label:'退款金额(元)', width:80,align:'center'},
				{name:'order_finished_time', label:'订单完成时间', width:130,align:"center"},
				{name:'order_buyer_evaluation_status', label:'是否评价',  width:80, align:"center", formatter: evalFmatter},
				{name:'shop_id', label:'店铺ID',  width:50, align:"center"},
				{name:'shop_name', label:'店铺名称',  width:150, align:"center"},
				{name:'buyer_user_id', label:'买家ID',  width:100, align:"center"},
				{name:'buyer_user_name', label:'买家账号', width:100, align:"center"}
			];
			
			this.mod_PageConfig.gridReg('grid', colModel);
			colModel = this.mod_PageConfig.conf.grids['grid'].colModel;
			
			$("#grid").jqGrid({
				url:SITE_URL + '?ctl=Trade_Order&met=getOrderList&typ=json',
				postData: queryConditions,
				datatype: "json",
				autowidth: true,//如果为ture时，则当表格在首次被创建时会根据父元素比例重新调整表格宽度。如果父元素宽度改变，为了使表格宽度能够自动调整则需要实现函数：setGridWidth
				height: gridWH.h,
				altRows: true, //设置隔行显示
				gridview: true,
				multiselect: true,
				multiboxonly: true,
				colModel:colModel,
				cmTemplate: {sortable: false, title: false},
				page: 1, 
				sortname: 'payment_time',
				sortorder: "desc", 
				pager: "#page",  
				rowNum: 25,
				rowList:[25,50,100],
				viewrecords: true,
				shrinkToFit: false,
				forceFit:true,
				jsonReader: {
				  root: "data.items", 
				  records: "data.records",  
				  repeatitems : false,
				  total : "data.total",
				  id: "order_id"
				},
				onSelectRow: function(rowid,status){
					/*var b = $('#grid').jqGrid('getGridParam', 'selarrrow'),
						c = b.join();
						Public.ajaxPost('./index.php?ctl=Trade_Order&met=CountAmount&typ=json', {
							id: c
						}, function (a) {
                            $('.count_amount').html(a.data.money);
						})*/
					if(status){
                        var rowData = $('#grid').jqGrid('getRowData',rowid);
                        $('.count_amount_price').html(rowData.order_goods_amount)
					}else {
                        $('.count_amount_price').html('0.00')
					}
                    getSelectedOrderAmount();
				},
				onSelectAll:function(rowids,statue){
					/*var b = $('#grid').jqGrid('getGridParam', 'selarrrow'),
						c = b.join();
						Public.ajaxPost('./index.php?ctl=Trade_Order&met=CountAmount&typ=json', {
							id: c
						}, function (a) {
							$('.count_amount').html(a.data.money);
						})*/
                    getSelectedOrderAmount();
				},
				loadError : function(xhr,st,err) {
					
				},
				ondblClickRow : function(rowid, iRow, iCol, e){
					$('#' + rowid).find('.ui-icon-pencil').trigger('click');
				},
				resizeStop: function(newwidth, index){
					THISPAGE.mod_PageConfig.setGridWidthByIndex(newwidth, index, 'grid');
				},
                loadComplete:function (e) {
					$('.count_amount_row').html(e.data.order_count);
					$('.count_amount_price').html(e.data.order_count_price)
                }
			}).navGrid('#page',{edit:false,add:false,del:false,search:false,refresh:false}).navButtonAdd('#page',{  
				caption:"",   
				buttonicon:"ui-icon-config",   
				onClickButton: function(){
					THISPAGE.mod_PageConfig.config();
				},   
				position:"last"  
			});
			
			//操作符
			function operFmatter (val, opt, row) {
				var html_con = '<div class="operating" data-id="' + row.order_id + '"><span class="ui-icon ui-icon-search" title="订单详情"></span>';
				if ( row.order_status == 1 ) {
					html_con += '<span class="ui-icon ui-icon-receive ui-icon-disabled" title="收到货款"></span><span class="ui-icon ui-icon-trash" title="取消订单"></span>';
				} else {
					html_con += '<span class="ui-icon ui-icon-receive ui-icon-disabled" title="收到货款"></span><span class="ui-icon ui-icon-trash ui-icon-disabled" title="取消订单"></span>';
				}
				html_con += '</div>';
				return html_con;
			}

			function evalFmatter (val, opt, row) {
				var res = new String();
				if ( val == 0 ) {
					res = '未评价';
				} else {
					res = '已评价';
				}
				return res;
			}
			
			function getSelectedOrderAmount() {
                var b = $('#grid').jqGrid('getGridParam', 'selarrrow');
                var amount = 0;
                $.each(b,function (i) {
                    var rowData = $('#grid').jqGrid('getRowData',b[i]);
					amount += Number(rowData.order_goods_amount);
                })
                $('.count_amount').html(amount.toFixed(2));
            }
		},
		
		//重新加载数据
		reloadData: function(data){
			$("#grid").jqGrid('setGridParam',{postData: data}).trigger("reloadGrid");
		},
		
		//增加事件
		addEvent: function(){
			var _self = this;
			//编辑
			$('.grid-wrap').on('click', '.ui-icon-search', function(e){
				e.preventDefault();
				var order_id = $(this).parent().data("id");
				parent.tab.addTabItem({
					tabid: order_id,
					text: '订单详情',
					url: SITE_URL + '?ctl=Trade_Order&met=getOrderInfo&order_id=' + order_id,
				})
			});
			//取消
			$('.grid-wrap').on('click', '.ui-icon-trash', function(e){
				e.preventDefault();
				if ( $(this).hasClass('ui-icon-disabled') ) {
					return false;
				}
				var $this = $(this);
					order_id = $(this).parent().data('id');
				$.dialog.confirm('您确定要取消该该订单吗？', function(){
					Public.ajaxPost(SITE_URL + '?ctl=Trade_Order&met=cancelOrder&typ=json', {order_id: order_id}, function ( data ) {
						if ( data.status == 200 ) {
							parent.Public.tips({type: 3, content : data.msg}), THISPAGE.reloadData();
						} else {
							parent.Public.tips({type: 1, content : data.msg});
						}
					})
				});
			});
			//收到货款
			$('.grid-wrap').on('click', '.ui-icon-receive', function(e){
				e.preventDefault();
				if ( $(this).hasClass('ui-icon-disabled') ) {
					return false;
				}

				var order_id = $(this).parent().data("id");
					rowData = $("#grid").jqGrid('getRowData', order_id),
					order_goods_amount = rowData.order_goods_amount;

				Public.ajaxGet(SITE_URL + '?ctl=Trade_Order&met=getPaymentNum&typ=json', {}, function ( data ) {
					var payment_number = data.data.payment_number;
					if ( data.status == 200 ) {
						$.dialog({
							title: '收到货款',
							content: 'url:' + SITE_URL + '?ctl=Trade_Order&met=receive&typ=e',
							data: { order_id: order_id, payment_number: payment_number, order_goods_amount: order_goods_amount },
							width: 700,
							height: 400,
							max: false,
							min: false,
							cache: false,
							lock: true
						});
					}
				});
			});
			/*//批量删除
			$('.wrapper').on('click', '#btn-batchDel', function(e){
				if (!Business.verifyRight('QTSR_DELETE')) {
					e.preventDefault(); 
					return ;
				};
				var arr_ids = $('#grid').jqGrid('getGridParam','selarrrow')
				var voucherIds = arr_ids.join();
				if (!voucherIds) {
					parent.Public.tips({type:2,content:"请先选择需要删除的项！"});
					return;
				}
				$.dialog.confirm('您确定要删除选中的其他收入单吗？', function(){
					Public.ajaxPost('./admin.php?ctl=Finance_OtherIncome&met=deleteInc',{"id":voucherIds}, function(data){
						if(data.status === 200 && data.msg && data.msg.length) {
							var result = '<p>操作成功！</p>';
							for(var resultItem in data.msg){
								if(typeof data.msg[resultItem] === 'function') continue;//兼容ie8
								resultItem = data.msg[resultItem];
								result += '<p class="'+ (resultItem.isSuccess == 1 ? '':'red') +'">其他收入单［'+ resultItem.id +'］删除' + (resultItem.isSuccess == 1 ? '成功！' : '失败：'+ resultItem.msg)+'</p>';
							}
							parent.Public.tips({content : result});
						} else {
							parent.Public.tips({type: 1, content : data.msg});
						}
						$('#search').trigger('click');
					});
				});
			});*/
			
			//搜索
			$('#search').click(function(){
                queryConditions.order_status = $source.getValue();
				queryConditions.order_id = $('#order_id').val();
				queryConditions.buyer_name = $('#buyer_name').val();
				queryConditions.shop_name = $('#shop_name').val();
				queryConditions.payment_number = $('#payment_number').val();
                queryConditions.payment_channel_id = $payment_channel.getValue();

				if ( $('#filter-fromDate').val() ) {
					queryConditions.payment_date_f = $('#filter-fromDate').val();
				}
				if ( $('#filter-toDate').val() ) {
					queryConditions.payment_date_t = $('#filter-toDate').val();
				}

				THISPAGE.reloadData(queryConditions);
			});
			
			//刷新
			$("#btn-refresh").click(function ()
			{
				THISPAGE.reloadData('');
				_self.$_searchName.placeholder('请输入相关数据...');
				_self.$_searchName.val('');
			});

			$(window).resize(function(){
				Public.resizeGrid();
			});
		}
	};
	
	/*var handle = {
		 cancel: function () {

		 },
		 receive: function () {

		 },
		 show: function () {

		 }
	};*/
	
	$(function(){
		$source = $("#source").combo({
		 data: [{
		 id: "-1",
		 name: "订单状态"
		 }, {
		 id: "1",
		 name: "待付款"
		 }, {
		 id: "2",
		 name: "已付款"
		 }, {
		 id: "3",
		 name: "待发货"
		 }, {
		 id: "4",
		 name: "已发货"
		 }, {
		 id: "5",
		 name: "已签收"
		 }, {
		 id: "6",
		 name: "已完成"
		 }, {
		 id: "7",
		 name: "已取消"
		 }, {
		 id: "8",
		 name: "退款中"
		 }, {
		 id: "9",
		 name: "退款完成"
		 }],
		 value: "id",
		 text: "name",
		 width: 110
		 }).getCombo();
		THISPAGE.init();
	});

    $(function(){
        $payment_channel = $("#payment_channel").combo({
            data: [{
                id: "-1",
                name: "付款方式"
            }, {
                id: "1",
                name: "支付宝"
            }, {
                id: "2",
                name: "支付宝WAP"
            }, {
                id: "3",
                name: "微信"
            }, {
                id: "4",
                name: "微信内部"
            }, {
                id: "6",
                name: "财付宝"
            }, {
                id: "7",
                name: "财付宝卡"
            }],
            value: "id",
            text: "name",
            width: 110
        }).getCombo();
        THISPAGE.init();
    });