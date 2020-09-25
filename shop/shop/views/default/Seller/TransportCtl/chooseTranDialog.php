<!DOCTYPE HTML>
<html>
<head>
    <link href="<?= $this->view->css ?>/seller.css?ver=<?= VER ?>" rel="stylesheet">
    <link href="<?= $this->view->css ?>/iconfont/iconfont.css?ver=<?= VER ?>" rel="stylesheet" type="text/css">
    <link href="<?= $this->view->css ?>/seller_center.css?ver=<?= VER ?>" rel="stylesheet">
    <link href="<?= $this->view->css ?>/base.css?ver=<?= VER ?>" rel="stylesheet">
    <script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js" charset="utf-8"></script>
</head>
<body>

<div class="dialog_content" style="margin: 0px; padding: 0px;">
    <div class="eject_con">
        <div class="adds" style=" min-height:240px;">
            <table class="ncsc-default-table">
                <thead>
                <tr>
                    <th class="w80">模板名称</th>
                    <th>配送区域</th>
                    <th class="w100">首重重量</th>
                    <th class="w80">首重费用</th>
                    <th class="w100">续重重量</th>
                    <th class="w80">续重费用</th>
                    <th class="w80"></th>
                </tr>
                </thead>

                <tbody>
                <?php if ( !empty($transport_list) ) { ?>
                    <?php foreach ( $transport_list as $key => $val ) { ?>
                        <?php for($i = 0;$i<count($val['transport_item']);$i++){?>
                        <tr class="bd-line">
                            <td class="tc"><?= $val['transport_type_name']; ?></td>
                            <td><?= $val['transport_item'][$i]['transport_item_city_name']; ?></td>
                            <td class="tc"><?php if ( !empty($val['transport_item'][$i]['transport_item_default_num']) ) { echo $val['transport_item'][$i]['transport_item_default_num']; } ?></td>
                            <td class="tc"><?= $val['transport_item'][$i]['transport_item_default_price']; ?></td>
                            <td class="tc"><?= $val['transport_item'][$i]['transport_item_add_num']; ?></td>
                            <td class="tc"><?= $val['transport_item'][$i]['transport_item_add_price']; ?></td>
                            <?php if(count($val['transport_item'])-1 == $i){?>
                            <td class="tc">
                                <a href="javascript:void(0);" nc_type="select" class="ncbtn bbc_seller_btns" data-transport_type_name="<?= $val['transport_type_name']; ?>" data-transport_type_id="<?= $val['transport_type_id']; ?>">选择</a>
                            </td>
                                <?php } ?>
                        </tr>
                            <?php } ?>
                    <?php } ?>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>

<script>

    api = frameElement.api;
    callback = api.data.callback;

    $(function () {

        $('a[nc_type="select"]').on('click', function () {

            if ( typeof callback == 'function' ) {

                var data = { transport_type_name: $(this).data('transport_type_name'), transport_type_id: $(this).data('transport_type_id') };

                callback(data, api);
            }
        })
    })
</script>