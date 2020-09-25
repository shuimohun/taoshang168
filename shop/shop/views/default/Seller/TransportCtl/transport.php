<?php if (!defined('ROOT_PATH')) exit('No Permission');?>

<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
    <link href="<?=$this->view->css?>/font/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="<?=$this->view->css ?>/seller_center.css" rel="stylesheet" type="text/css">
    <style>
        .right-layout {
            float: right;
            width: 1000px;
            background-color: #FFF;
            min-height: 765px;
            margin-top: -72px;
        }
        .order tbody tr th h3 {
            font-size: 12px;
            line-height: 20px;
            font-weight: 700;
            vertical-align: middle;
            display: inline-block;
            margin: 5px 10px;
            float:left;
        }
       a.ncbtn-mini:hover{
            background-color: #999;
            color: #fff;
        }
    </style>

<script type='text/jade' id='thrid_opt'>
    <a class="button add bbc_seller_btns" href="<?=YLB_Registry::get('url')?>?ctl=Seller_Transport&met=transport&act=adds"><i class="iconfont icon-jia bbc_seller_btns"></i><?=_('添加运费模版')?></a>
</script>
<script type="text/javascript">
    $(function () {
        $('.tabmenu').append($('#thrid_opt').html());
    })
</script>
<div class="alert alert-block mt10">
    <ul class="mt5">
        <li>如果某商品选择使用了售卖区域，则该商品只售卖指定地区，运费为指定地区的运费。</li>
    </ul>
</div>

<?php if (is_array($list['items'])){?>
    <table class="ncsc-default-table order">
        <thead>
        <tr>
            <th class="w20"></th>
            <th class="cell-area tl">运送到</th>
            <th class="w150">首重重量(kg)</th>
            <th class="w150">首重运费(元)</th>
            <th class="w150">续重重量(kg)</th>
            <th class="w150">续重运费(元)</th>
        </tr>
        </thead>
        <?php foreach ($list['items'] as $v){?>
            <tbody>
            <tr>
                <td colspan="20" class="sep-row"></td>
            </tr>
            <tr>
                <th colspan="20">
                    <h3><?=$v['transport_type_name'];?></h3>
                    <span class="fr mr5">
                        <time title="添加时间"><i class="icon-time"></i><?=$v['transport_type_time']?></time>
                        <a class="J_Modify ncbtn-mini" href="javascript:void(0)" data-id="<?=$v['transport_type_id'];?>"><i class="icon-edit"></i>编辑</a> <a class="J_Delete ncbtn-mini" href="javascript:void(0)" data-id="<?=$v['transport_type_id'];?>"><i class="icon-trash"></i>删除</a>
                    </span>
                </th>
            </tr>
            <?php if (is_array($extends[$v['id']]['data'])){?>
                <?php foreach ($extends[$v['id']]['data'] as $value){?>
                    <tr>
                        <td></td>
                        <td class="cell-area tl"><?=$value['transport_item_city_name'];?></td>
                        <td><?=$value['transport_item_default_num'] ?></td>
                        <td><?=$value['transport_item_default_price'];?></td>
                        <td><?=$value['transport_item_add_num'] ?></td>
                        <td><?=$value['transport_item_add_price'];?></td>
                    </tr>
                <?php }?>
            <?php }?>
            </tbody>
        <?php }?>
    </table>
<?php } else {?>
    <div class="warning-option"><i class="icon-warning-sign"></i><span>暂无数据</span></div>
<?php } ?>

<script>
    $(document).ready(function(){
        //删除
        $('a[class="J_Delete ncbtn-mini"]').click(function(){
            var id = $(this).attr('data-id');
            $.post(SITE_URL+'?ctl=Seller_Transport&met=delTransports&typ=json',{id:id},function(r){
                if(r.status == 200)
                {
                    location.href = "<?=YLB_Registry::get('url')?>?ctl=Seller_Transport&met=transport";
                }
                else if(r.status == 300)
                {
                    Public.tips({type:1,content:r.msg});
                }
                else
                {
                    Public.tips({type:1,content:"<?=_('操作失败！')?>"});
                }
            });
        });

        //编辑
        $('a[class="J_Modify ncbtn-mini"]').click(function(){
            var id = $(this).attr('data-id');
            location.href = "<?=YLB_Registry::get('url')?>?ctl=Seller_Transport&met=transport&act=edits&id="+id;
        });
    });
</script>

<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>


