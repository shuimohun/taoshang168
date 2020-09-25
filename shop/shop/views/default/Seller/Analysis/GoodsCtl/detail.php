<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/seller_center.css"/>
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/detail.css"/>

<div id="mainContent">
    <div class="fl mr50" style="width: 100%;">
        <div class="padding20">
        <table width="100%" class="table-list-style table-promotion-list" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <th>序号</th>
                <th>商品名称</th>
                <th>下单商品数</th>
                <th>下单金额</th>
                <th>操作</th>
            </tr>

            <?php
            foreach($data_productbase as $k => $v) {

                echo '<tr>
								<td>'.($k+1).'</td>
								<td>
									<div class="padding10fl">
										<div class="pic80 ">
										 <a href="index.php?ctl=Goods_Goods&met=goods&cid='.$v['common_id'].'"><img src="'.$v['common_image'].'"></a>
										</div>
										<div class="padding10fl">
											<h4 class="pro_title"><a href="index.php?ctl=Goods_Goods&met=goods&cid='.$v['common_id'].'">'.$v["common_name"].'</a></h4>
											<p class="pro_date">'.date("Y-m-d", strtotime($v['common_add_time'])).'</p>
										</div>
									</div>
								</td>
								<td>'.$v["order_goods_num"].'</td>
								<td>'.$v["order_goods_amount"].'</td>
								<td><a href="javascript:;" onclick="getAjax('.$v['common_id'].')">单品分析</a></td>
							</tr>';
            }
            ?>
        </table>
    </div>
        <div class="page">
            <?php
            //输出分页信息，显示上一页和下一页的连接
            if($page>1)			  echo " <a href='?ctl=Seller_Analysis_Goods&met=detail&plat_id=".$plat_id."&shop_id=".$shop_id."&keywords=".$keywords."&page=".($page-1)."'>上一页</a> ";
            if($page-1>1)		  echo " <a href='?ctl=Seller_Analysis_Goods&met=detail&plat_id=".$plat_id."&shop_id=".$shop_id."&keywords=".$keywords."&page=".($page-2)."'>".($page-2)."</a> ";
            if($page>1)			  echo " <a href='?ctl=Seller_Analysis_Goods&met=detail&plat_id=".$plat_id."&shop_id=".$shop_id."&keywords=".$keywords."&page=".($page-1)."'>".($page-1)."</a> ";
            if($maxPages>1)		  echo " <b>".($page)."</b> ";
            if($page<$maxPages)   echo " <a href='?ctl=Seller_Analysis_Goods&met=detail&plat_id=".$plat_id."&shop_id=".$shop_id."&keywords=".$keywords."&page=".($page+1)."'>".($page+1)."</a> ";
            if($page+1<$maxPages) echo " <a href='?ctl=Seller_Analysis_Goods&met=detail&plat_id=".$plat_id."&shop_id=".$shop_id."&keywords=".$keywords."&page=".($page+2)."'>".($page+2)."</a> ";
            if($page<$maxPages)   echo " <a href='?ctl=Seller_Analysis_Goods&met=detail&plat_id=".$plat_id."&shop_id=".$shop_id."&keywords=".$keywords."&page=".($page+1)."'>下一页</a> ";
            ?>
        </div>
    </div>
    <div class="h30 cb">&nbsp;</div>
</div>

<script>
    function getAjax(a){
        var common_id = a;
        var analysis = 'analysis';
        $('.padding20').html('<div class="loading"></div>');
        var url = "?ctl=Seller_Analysis_Goods&met=" + analysis + "&plat_id=" + <?php echo $plat_id?> + "&shop_id=" + <?php echo $shop_id?> + "&common_id=" + common_id;
        var pars = {};
        $.post(url,pars,showResponse);
        function showResponse(originalRequest)
        {
            $(".padding20").html('');
            $(".page").html('');
            $(".padding20").html(originalRequest);
        }
//        $(".left_content p").removeClass("cur");
//        $('.' + a + ' p').addClass("cur");
    }
</script>

<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>
