<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'buyer_header.php';
?>
</div>
<style>
.grade {
    padding: 10px 0;
}
.grade h2 {
    font-size: 14px;
    font-weight: bold;
    margin: 20px 20px 10px;
}
.grade_list {
    border-bottom: 1px solid #eee;
    line-height: 36px;
    padding: 0 20px 10px;
}
.grade_list dl {
    float: left;
    margin: 30px 0 20px;
    width: 15%;
}
.grade_list dt {
    padding-left: 10px;
}
.grade_list dd p {
    line-height: 20px;
    margin: 5px 0;
    text-align: center;
    width: 85px;
}
.grade_list .red {
    color: #e60012;
}
</style>
<div class="grade">
    <div class="grade_list">
        <p><?=_('您的会员级别是:')?> <span><?=$data['user_grade_name']?></span></p>
       <!--  <p>会员级别有效期:')?> <?php if(!empty($data['expire'])){?><?=$data['user_grade_valid']?><?=_('年')?>
		<?php }else{?><?=_('无限期')?><?php } ?></p>
        <?php if(!empty($data['expire'])){?><p><?=_('到期时间:')?> <?=$data['expire']?></p><?php } ?>
        <?php if($data['user_grade_sum']>0){?><p>年费: <b><?=$data['user_grade_sum']?></b> <?=_('成长值')?></p><?php } ?> -->
		<?php if(!empty($data['next'])){?><p><?=_('距离成为')?> <span><?=$data['next']?></span> <?=_('还需')?> <span class="red"><?=$data['growth']?></span> <?=_('成长值')?></p>
		<?php } ?>
    </div>
    <h2><?=$data['user_grade_name']?><?=_('权利及优惠：')?></h2>
    <div class="grade_list">
    <?php if($data['user_grade_rate']>0){?><p><?=_('1.可以享受金牌会员部分商品')?> <b class="bbc_color"><?=number_format($data['user_grade_rate']/10,1)?></b> <?=_('折扣')?></p><?php } ?>
    <?=$data['user_grade_treatment']?>
    </div>
    <h2><?=_('会员级别图示：')?></h2>
    <div class="grade_list clearfix">
       <?php							
			foreach ($gradeList as $list)
			{
		?>
        <dl>
            <dt><img width="63" height="64" src="<?=image_thumb($list['user_grade_logo'],63,64)?>"></dt>
            <dd>
                <p><b class="green"> <?=$list['user_grade_name']?></b></p>
                <p>
                <?php if($list['id']==1){?><?=_('注册成功即成为')?><?=$list['user_grade_name']?><?php }else{?><?php if($list['user_grade_demand']<=1){?><?=_('注册成功且成功购买过商品')?><?php }else{?><?=_('成长值达到')?></br><?=$list['user_grade_demand']?><?php } ?><?php } ?>
                </p>
            </dd>
        </dl>   
        <?php							
			}
		?>
    </div>   

</div>
</div>
</div>
</div>
</div>

<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>