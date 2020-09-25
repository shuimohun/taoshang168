<!DOCTYPE HTML>
<html>
<head>
<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js" charset="utf-8"></script>
<style>
    .dialog_content{border-top:1px solid #E6E6E6}
    .dialog_content dl{margin:0;padding:0;clear:both;overflow:hidden}
    .dialog_content dl dd,.dialog_content dl dt{font-size:12px;line-height:34px;vertical-align:top;display:inline-block;padding:10px}
    .dialog_content dl dt{width:30%;text-align:right}
    .dialog_content dl dd{width:50%;overflow:auto;margin:0}
    .text{padding:6px;width:40px;height:20px;border:1px solid #e1e1e1}
    .dialog_content dl dd em{color:#666;font-style:normal;line-height:32px;background-color:#E6E6E6;vertical-align:top;display:inline-block;text-align:center;width:32px;height:32px;border:solid #CCC;border-width:1px 1px 1px 0;zoom:1;font-weight:700}
    .bm_code{width:100px}
</style>
</head>
<body>

<div class="dialog_content" style="margin: 0px; padding: 0px;">
    <form method="post" id="batch_modify_form" onsubmit="ajaxpost('batch_modify_form', '', '', 'onerror');return false;" >
        <dl>
            <dt>市场价：</dt>
            <dd>
                <input class="text price" type="text" name="bm_market_price" data-type="bm_market_price"  value=""><em>￥</em>
            </dd>
        </dl>
        <dl>
            <dt>价格：</dt>
            <dd>
                <input class="text price" type="text" name="bm_price" data-type="bm_price"  value=""><em>￥</em>
            </dd>
        </dl>
        <dl>
            <dt>库存：</dt>
            <dd>
                <input class="text price" type="text" name="bm_stock" data-type="bm_stock"  value="">
            </dd>
        </dl>
        <dl>
            <dt>预警值：</dt>
            <dd>
                <input class="text price" type="text" name="bm_alarm" data-type="bm_alarm"  value="">
            </dd>
        </dl>
        <dl>
            <dt>商家货号：</dt>
            <dd>
                <input class="text bm_code" type="text" name="bm_code" data-type="bm_code"  value="">
            </dd>
        </dl>
    </form>
</div>

</body>
</html>
<script>
    api = frameElement.api;
    bm_price = api.data.bm_price ;
    bm_market_price = api.data.bm_market_price ;
    bm_stock = api.data.bm_stock ;
    bm_alarm = api.data.bm_alarm ;
    bm_code = api.data.bm_code ;

    $(function () {
        $('input[name="bm_price"]').val(bm_price);
        $('input[name="bm_market_price"]').val(bm_market_price);
        $('input[name="bm_stock"]').val(bm_stock);
        $('input[name="bm_alarm"]').val(bm_alarm);
        $('input[name="bm_code"]').val(bm_code);
    })
</script>