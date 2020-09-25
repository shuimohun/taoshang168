
<?php
if(empty($decoration_detail['goods_list'])) {
    $block_content = empty($block_content) ? $decoration_detail['block_content'] : $block_content;
    $goods_list = $block_content;
} else {
    $goods_list = $decoration_detail['goods_list'];
}

?>
<?php if(!empty($goods_list) && is_array($goods_list)){?>

    <style>

        p .share {
            width: 98px;
            height: 18px;
            border: 1px solid #c51e1e;
            font-size: 12px;
            line-height: 18px;
            color: #c51e1e;
            text-align: center;
            margin-top:10px;
        }

        p .share u {
            text-decoration: none;
            background-color: #c51e1e;
            color: #fff;
            float: right;
            width: 48px;
            height: 100%;
            text-align: center;
        }

        .share_wrap1{
            position: absolute;
            left:0px;
            top:292px;
        }
        .share_wrap2{
            position: absolute;
            left:110px;
            top:292px;
        }

        .store-decoration-page .goods-list li {
            height: 281px;
        }

    </style>

<ul class="goods-list">
  <?php foreach($goods_list as $key=>$val){?>
    <?php $goods_url = "index.php?ctl=Goods_Goods&met=goods&gid=".$val['goods_id'];?>
  <li nctype="goods_item" data-goods-id="<?php echo $val['goods_id'];?>" data-common-id="<?php echo $val['common_id'];?>" data-goods-name="<?php echo $val['common_name'];?>" data-goods-price="<?php echo $val['common_price'];?>"  data-goods-image="<?php echo $val['common_image'];?>">
      <div class="goods-thumb">
          <a href="<?php echo $goods_url;?>" target="_blank" title="<?php echo $val['common_name'];?>"> <img src="<?php echo $val['common_image']?>" alt="<?php echo $val['common_name'];?>">
          </a>
      </div>
    <dl class="goods-info">
      <dt>
          <a  target="_blank" title="<?php echo $val['common_name'];?>"><?php echo $val['common_name'];?></a>
      </dt>

      <dd>

          <p class='share_wrap share_wrap1'>
              <span class='share'>分享立减<u><?=format_money($val['common_share_price'])?></u></span>
          </p>
          <p class='share_wrap share_wrap2'>
              <span class='share'>分享立赚<u><?=format_money($val['common_promotion_price'])?></u></span>
          </p>


          <?php echo "￥".$val['common_price'];?>

      </dd>



    </dl>
    <?php if(!empty($decoration_detail['goods_list'])) { ?>
        <a nctype="btn_module_goods_operate" class="ncsc-btn-mini" href="javascript:;">
            <i class="icon-plus"></i>选择添加
        </a>
    <?php } ?>
  </li>
  <?php } ?>
</ul>
<?php if(!empty($decoration_detail['goods_list'])) { ?>
<div class="pagination"></div>
<?php } ?>
<?php } else { ?>
<?php if(!empty($decoration_detail['goods_list'])) { ?>
<div>店铺内无商品</div>
<?php } ?>
<?php } ?>
