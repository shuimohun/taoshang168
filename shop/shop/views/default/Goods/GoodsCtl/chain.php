<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="<?=$this->view->css?>/goods-detail.css" rel="stylesheet">
    <link href="<?=$this->view->css?>/base.css" rel="stylesheet" type="text/css">

</head>
<body>
<div class="store-mention-alert">
    <div class="store-mention">
        <div class="dialog_body">
            <div class="dialog_content">
                <div class="chain-show">
                    <dl>
                        <dt>门店所在地区：</dt>
                        <dd>
                            <input type="hidden" name="address_area" id="t" value="" />
                            <input type="hidden" name="province_id" id="id_1" value="" />
                            <input type="hidden" name="city_id" id="id_2" value="" />
                            <input type="hidden" name="area_id" id="id_3" value="" />
                            <div id="d_2">
                                <select id="select_1" name="select_1" onChange="district(this);">
                                    <option value="">--<?=_('请选择')?>--</option>
                                    <?php foreach($district['items'] as $key=>$val){ ?>
                                        <option value="<?=$val['district_id']?>|1"><?=$val['district_name']?></option>
                                    <?php } ?>
                                </select>
                                <select id="select_2" name="select_2" onChange="district(this);" class="hidden"></select>
                                <select id="select_3" name="select_3" onChange="district(this);getchain(this);" class="hidden"></select>
                            </div>
                        </dd>
                    </dl>
                    <div class="chain-list">
                        <ul nctype="chain_see">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= $this->view->js_com?>/jquery.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js?>/district.js"></script>
<script>
    $(document).ready(function(){
        $(".dialog_close_button").click(function(){
            $(".store-mention-alert").css("display","none");
        });
        var inde;
        $(".tabs-nav li").click(function(){
            inde=$(this).index();
            $(".tabs-nav li").removeClass("tabs-selected");
            $(".order-info .tabs-panel").removeClass("tabs-active");
            $(".order-info .tabs-panel").eq(inde).addClass("tabs-active");
            $(this).addClass("tabs-selected");
        });
    })
    var SITE_URL = "<?=YLB_Registry::get('url')?>";
    var api = frameElement.api;
    var callback = api.data.callback;

    function getchain(obj){
        var _chain_list = <?=$chain?>;
        var obj_array=obj.value.split('|');
        var _chain_check = eval('_chain_list[' +obj_array[0] +' ]');
        $('ul[nctype="chain_see"]').html('');
        $('.ncs-chain-no-date').remove();
        if (typeof(_chain_check) == 'undefined') {
            $('<div class="ncs-chain-no-date">很抱歉，该区域暂无门店有货，正努力补货中•••</div>').insertAfter('ul[nctype="chain_see"]');
            return false;
        }
        for (var i=0;i < _chain_check.length;i++) {
            _chain = eval('_chain_check[' + i +']');
            var callback_url=SITE_URL+'?ctl=Buyer_Cart&met=confirmChain&goods_id=<?=$goods_id?>&chain_id='+_chain.chain_id;
            $('<li><div class="handle"><a href="javascript:;" onclick="callback(\''+callback_url+'\')">马上自提></a></div><h5><i></i><a target="_blank" href="'+SITE_URL+'?ctl=Goods_Goods&met=getChain&chain_id='+_chain.chain_id+'">' + _chain.chain_name + '</a></h5><p>' + _chain.chain_province + ' ' + _chain.chain_city + ' ' + _chain.chain_county + ' ' + _chain.chain_address + '</p></li>').appendTo('ul[nctype="chain_see"]');
        }
        return false;
    }
</script>

</body>
</html>
