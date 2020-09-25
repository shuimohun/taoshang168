<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link href="<?= $this->view->css ?>/iconfont/iconfont.css?ver=<?=VER?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js" charset="utf-8"></script>
<link href="<?= $this->view->css ?>/base.css?ver=<?=VER?>" rel="stylesheet" type="text/css">
<link href="<?= $this->view->css ?>/seller.css?ver=<?=VER?>" rel="stylesheet">
<link href="<?= $this->view->css ?>/seller_center.css?ver=<?=VER?>" rel="stylesheet">
<script type="text/javascript">
    var BASE_URL = "<?=YLB_Registry::get('base_url')?>";
    var SITE_URL = "<?=YLB_Registry::get('url')?>";
    var INDEX_PAGE = "<?=YLB_Registry::get('index_page')?>";
    var STATIC_URL = "<?=YLB_Registry::get('static_url')?>";

    var DOMAIN = document.domain;
    var WDURL = "";
    var SCHEME = "default";
    try
    {
        //document.domain = 'ttt.com';
    } catch (e)
    {
    }

    var SYSTEM = SYSTEM || {};
    SYSTEM.skin = 'green';
    SYSTEM.isAdmin = true;
    SYSTEM.siExpired = false;
</script>
<style>
    .eject_con dl dt{width: 20%;}
    select{width: 100px;}
    .eject_con{margin-top: 72px;}
    .eject_con .bottom{    position: absolute;  bottom: 15px;  float: right;  text-align: right; right: 50px;}
    .disable{opacity: .4;}
    .disable .submit{cursor:auto;}
</style>
<div class="eject_con" id="eject_con">
    <form id="form" method="post" action="#" >
        <dl>
            <dt><?=_('经营类目：')?></dt>
            <dd>
                <span nctype="gc1">
                    <select nctype="gc" data-deep="1">
                    </select>
                </span>
                <span nctype="gc2"></span>
                <span nctype="gc3"></span>
                <span nctype="gc4"></span>
                <p>请选择商品分类（必须选到最后一级）</p>
                <p class="bbc_color hidden">您已经申请过此类目,请选择其他类目！</p>
                <input type="hidden" id="cat_id" name="cat_id" value="" class="mls_id">
                <input type="hidden" id="cat_name" name="cat_name" value="" class="mls_names">
            </dd>
        </dl>
        <div class="bottom">
            <label id="handle_submit" class="submit-border bbc_btns disable"><input type="button" value="<?=_('确认提交')?>" class="submit bbc_btns"></label>
        </div>
    </form>
</div>

<link href="<?= $this->view->css_com ?>/jquery/plugins/validator/jquery.validator.css?ver=<?=VER?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<link href="<?= $this->view->css_com ?>/jquery/plugins/dialog/green.css" rel="stylesheet">
<script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/jquery.dialog.js"></script>
<script>
    $(function() {

        //分步获取商品分类
        $("span[nctype=gc1], span[nctype=gc2], span[nctype=gc3], span[nctype=gc4]").on('change', 'select', function (){
            var $select = $(this),
                cat_id = $(this).val(),
                cat_name = $(this).find("option:checked").text();
            getCatList(cat_id, $select, true);
        });
        function getCatList(cat_id, $select, change) {
            var deep = $select.data('deep');
            switch (deep) {
                case 1 :
                    $("span[nctype=gc2], span[nctype=gc3], span[nctype=gc4]").empty();
                    break;
                case 2 :
                    $("span[nctype=gc3], span[nctype=gc4]").empty();
                    break;
                case 3 :
                    $("span[nctype=gc4]").empty();
                    break;
            }
            $.get(SITE_URL + '?ctl=Goods_Cat&met=getCatNew&typ=json', {cat_id: cat_id}, function(data){
                if (data.status == 200) {
                    $('.hidden').hide();
                    var option_rows = [], cat_data = data.data;
                    if(cat_data.length > 0){
                        option_rows.push("<option value=>" + '请选择...' + "</option>");
                        $("#cat_id").val('');
                        $('#handle_submit').addClass('disable');
                    }else{
                        $("#cat_id").val(cat_id);
                        $.get(SITE_URL + '?ctl=Seller_Shop_Info&met=checkCategory&typ=json', {cat_id: cat_id}, function(data){
                            if (data.status == 200) {
                                $('#handle_submit').removeClass('disable');
                            }else if (data.status == 250) {
                                $('.hidden').show();
                                parent.Public.tips.error('您已经申请过此类目,请选择其他类目！');
                            }
                        });
                    }
                    for (var i = 0; i < cat_data.length; i++) {
                        option_rows.push("<option value=" + cat_data[i].cat_id + ">" + cat_data[i].cat_name + "</option>");
                    }
                    if (change){
                        if (option_rows.length > 0) {
                            var next_deep = deep + 1;
                            $("span[nctype=gc" + next_deep + "]").append("<select data-deep=" + next_deep + ">" + option_rows.join("") + "</select>");
                            $("span[nctype=gc" + next_deep + "]").children("option").eq(0).trigger("click");
                        }
                    } else {
                        $select.append(option_rows.join(""));
                    }

                } else {
                    Public.tips.error(data.msg);
                }
            })
        }

        //分布获取商品分类
        getCatList(0, $("span[nctype=gc1]>select"), false);

        $('#form').validator({
            ignore: ':hidden',
            theme: 'yellow_right',
            timely: 1,
            stopOnError: false,
            rules: {

            },
            fields: {
                'cat_id': 'required',
            },
            valid:function(form){
                var me = this;
                // 提交表单之前，hold住表单，防止重复提交
                me.holdSubmit();
                //表单验证通过，提交表单
                $.ajax({
                    url: SITE_URL + "?ctl=Seller_Shop_Info&met=addCategory&typ=json",
                    data:$("#form").serialize(),
                    success:function(a){
                        if(a.status == 200) {
                            parent.Public.tips.success('操作成功！');
                            parent.location.reload();
                        } else {
                            parent.Public.tips.error('操作失败！');
                        }
                        me.holdSubmit(false);
                    }
                });
            }
        }).on("click", "#handle_submit", function (e) {
            if(!$(this).hasClass('disable')){
                $(e.delegateTarget).trigger("validate");
            }
        });
    });
</script>
