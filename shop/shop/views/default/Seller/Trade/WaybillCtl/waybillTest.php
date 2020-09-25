
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>快递单据打印测试</title>
    <style>
        body { margin: 0;padding:0; }
        .waybill_area { position: relative; width: 820.8px; height: 528.2px; }
        .waybill_back { position: relative; width: 820.8px; height: 528.2px; }
        .waybill_back img { width: 820.8px; height: 528.2px; }
        .waybill_design { position: absolute; left: 0; top: 0; width: 820.8px; height: 528.2px; }
        .waybill_item { position: absolute; left: 0; top: 0; width:100px; height: 20px; border: none; }
        .print-btn { background:#FFF; border: solid 1px #ccc; line-height:32px; display: inline-block; padding:5px 10px; margin-top: 20px; margin-left: 280px; border-radius: 5px; box-shadow: 2px 2px 0 rgba(153,153,153,0.2); cursor: pointer;}
        .print-btn:hover {  background: #555; box-shadow: none; border-color: #555;}
        .print-btn a { font-family:"microsoft yahei"; font-size: 20px; text-decoration: none; padding: 0 0 0 10px; color: #555; font-weight:600; display:inline-block; vertical-align: middle;}
        .print-btn:hover a, .print-layout .print-btn a:hover { color: #FFF;  text-decoration:none;}
    </style>

    <style media="print">
        @page {
            size: auto;
            margin: 0mm;
        }
        .waybill_back{display: none}
        .control{display: none}
        .print-btn{display: none}
    </style>
</head>

<body>
    <div class="waybill_back"> <img src="<?php echo $waybill_data['waybill_tpl_image']; ?>" alt=""> </div>
    <div class="waybill_design">
        <?php if ( $waybill_data['waybill_tpl_item'] ) { ?>
        <?php foreach ( $waybill_data['waybill_tpl_item'] as $key => $val ) { ?>
        <div class="waybill_item" style="left:<?= $val['left']; ?>px; top:<?= $val['top']; ?>px; width:<?= $val['width']; ?>px; height:<?= $val['height']; ?>px;"><?php if ( empty($val['value']) ) { echo $val['name']; } else { echo $val['value']; } ?></div>
        <?php } ?>
        <?php } ?>
    </div>
    <?php if ( !empty($data) ) { ?>
    <div class="control">其它模板：
         <select id="waybill_list">
         <?php foreach ( $data as $key => $val ) { ?>
             <option value="<?= $val['way_bill']['waybill_tpl_id']; ?>"><?= $val['way_bill']['waybill_tpl_name']; ?></option>
         <?php } ?>
        </select>
    </div>
    <?php } ?>
    <div class="print-btn"><i></i><a id="btn" class="" href="javascript:;">打印运单</a> </div>
</body>

</html>

<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js" charset="utf-8"></script>
<script>
    $(document).ready(function() {
        $('#btn').on('click', function() {
            pos();
            window.print();
        });

        var pos = function () {
            var top = <?= $waybill_data['waybill_tpl_top']; ?>;
            var left = <?= $waybill_data['waybill_tpl_left']; ?>;

            $(".waybill_design").each(function(index) {
                var offset = $(this).offset();
                var offset_top = offset.top + top;
                var offset_left = offset.left + left;
                $(this).offset({ top: offset_top, left: offset_left})
            });
        };

        $(document).on('change', 'select', function () {
            var waybill_tpl_id = $('select').val();
            if ( window.location.href.indexOf('waybill_tpl_id') > -1 ) {
                window.location.href = window.location.href.replace(/waybill_tpl_id=\w+/, 'waybill_tpl_id=' + waybill_tpl_id );
            } else {
                window.location.href += '&waybill_tpl_id=' + waybill_tpl_id;
            }
        });

        <?php if ( !empty($waybill_tpl_id) ) { ?>
        $('select').children('option[value="<?= $waybill_tpl_id ?>"]').prop('selected', 'selected');
        <?php } ?>
    });

</script>
