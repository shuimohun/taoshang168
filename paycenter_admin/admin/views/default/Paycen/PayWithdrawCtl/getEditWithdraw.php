<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css?>/jquery/plugins/validator/jquery.validator.css">
<script type="text/javascript" src="<?=$this->view->js?>/libs/jquery/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js?>/libs/jquery/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
</head>

<body>
        <form method="post" enctype="multipart/form-data" id="shop_edit_class" name="form1">
       <div class="ncap-form-default">
           <input type="hidden" id="id" name="id" value="<?=$data['id']?>">
              <dl class="row">
                <dt class="tit">
                    <label for="cardno">银行卡号</label>
                </dt>
                <dd class="opt">
                    <p><?=$data['cardno']?></p>
                </dd>
              </dl>
             <dl class="row">
                <dt class="tit">
                    <label for="amount">金额</label>
                </dt>
                <dd class="opt">
                         <p><?=$data['amount']?></p>
                </dd>
          
            </dl>
          
             <dl class="row">
                <dt class="tit">
                    <label for="add_time">创建时间</label>
                </dt>
                <dd class="opt">
                      <p><?=$data['add_time']?></p>
                </dd>
          
            </dl>

            <dl class="row">
                <dt class="tit">
                    <label for="bank">开户支行</label>
                </dt>
                <dd class="opt">
                      <p><?=$data['bank']?></p>
                </dd>
            </dl>
           <?php if($data['bank_code']){?>
               <dl class="row">
                   <dt class="tit">
                       <label for="bank_code">银行支行联号</label>
                   </dt>
                   <dd class="opt">
                       <p><?=$data['bank_code']?></p>
                   </dd>
               </dl>
           <?php }?>
            <dl class="row">
                <dt class="tit">
                    <label for="bank_user">开户名</label>
                </dt>
                <dd class="opt">
                      <p><?=$data['cardname']?></p>
                </dd>
            </dl>
           <?php if($data['bank_code']){?>
               <dl class="row">
                   <dt class="tit">
                       <label for="legal_person">法人代表</label>
                   </dt>
                   <dd class="opt">
                       <p><?=$data['legal_person']?></p>
                   </dd>
               </dl>
           <?php }?>

           <dl class="row">
                <dt class="tit">
                    <label for="bankflow">银行流水账号</label>
                </dt>
                <dd class="opt">
                      <p>
                          <?php if($data['is_succeed'] != 3){?>
                              <input type="text" id="bankflow" name="bankflow" class="w200 ui-input " placeholder="请输入银行流水账号">
                          <?php }else{?>
                              <?=$data['bankflow']?>
                          <?php } ?>
                      </p>
                </dd>
            </dl>
            <dl class="row">
              <dt class="tit">
                    <label for="fee">手续费</label>
              </dt>
              <dd class="opt">
                      <p><?=$data['fee']?></p>
              </dd>
            </dl>
               <dl class="row">
              <dt class="tit">
                    <label for="is_succeed">状态</label>
              </dt>
              <dd class="opt">
                  <?php if($data['is_succeed'] != 3){?>
                    <input type="radio" name="is_succeed" value="3" <?php if($data['is_succeed'] == 3){?>checked="checked"<?php }?>>通过
                    <input type="radio" name="is_succeed" value="4" <?php if($data['is_succeed'] == 4){?>checked="checked"<?php }?>>不通过
                    <?php }else{?>
                       <p>成功</p>
                    <?php } ?>
              </dd>
            </dl>
        </div>
    </form>

    <script>



function initPopBtns()
{
    var t = "add" == oper ? ["保存", "关闭"] : ["确定", "取消"];
    api.button({
        id: "confirm", name: t[0], focus: !0, callback: function ()
        {
            postData(oper, rowData.id);
           return cancleGridEdit(),$("#shop_edit_class").trigger("validate"), !1
        }
    }, {id: "cancel", name: t[1]})
}
function postData(t, e)
{
 
	$_form.validator({

        messages: {
                required: "请填写该字段",
        },
        fields: {
            bankflow: "required;",
        },

        valid: function (form)
        {
            var id = $.trim($("#id").val()),is_succeed= $.trim($("input[name='is_succeed']:checked").val()),bankflow=$('#bankflow').val();

            var params ={
                id:id,
				is_succeed: is_succeed,
                bankflow:bankflow,
			};
			Public.ajaxPost(SITE_URL +"?ctl=Paycen_PayWithdraw&met=editWithdrawRow&typ=json", params, function (e)
			{
				if (200 == e.status)
				{
					parent.parent.Public.tips( {content:"修改成功！"});
                                        callback && "function" == typeof callback && callback(e.data, t, window)
//					 var callback = frameElement.api.data.callback;
//                                            callback();
				}
				else
				{
					parent.parent.Public.tips({type: 1, content:  "修改失败！" + e.msg})
				}
			})
        },
        ignore: ":hidden",
        theme: "yellow_bottom",
        timely: 1,
        stopOnError: !0
    });
}
function cancleGridEdit()
{
    null !== curRow && null !== curCol && ($grid.jqGrid("saveCell", curRow, curCol), curRow = null, curCol = null)
}
function resetForm(t)
{
    $_form.validate().resetForm();
    $("#user_account").val("");
    $("#add_user_money").val("");
    $("#user_id").val("");
    $("#record_desc").val("");
}
var curRow, curCol, curArrears, $grid = $("#grid"),  $_form = $("#shop_edit_class"), api = frameElement.api, oper = api.data.oper, rowData = api.data.rowData || {}, callback = api.data.callback;
initPopBtns();

    </script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
