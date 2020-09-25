<link rel="stylesheet" type="text/css" href="<?=$this->view->css?>/Group-integral.css" />
<link rel="stylesheet" type="text/css" href="<?=$this->view->css?>/base.css" />

<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.toastr.min.js"></script>
<script type="text/javascript" src="<?=$this->view->js?>/common.js"></script>
<script type="text/javascript" src="<?=$this->view->js?>/receive_redpack.js"></script>

<div class="bbc-voucher-exchange voucher-exchange">
    <?php
    if($data)
    {
    ?>
		<input type="hidden" name="form_submit" value="ok">
        <input type="hidden" name="vid" value="<?=$data['redpacket_t_id']?>">
		<div class="pic">
            <span>
                <img src="<?=$data['redpacket_t_img']?>" alt="<?=$data['redpacket_t_title']?>">
            </span>
		</div>
        <dl>
            <dt>
                <?php
                    if($data['redpacket_t_points']){
                ?>
                <?=_('您正在使用')?><span class="ml5 mr5"><?=$data['redpacket_t_points']?></span><?=_('金蛋')?>&nbsp;<?=_('兑换')?>&nbsp;1&nbsp;<?=_('张')?><br>
                <?php
                    }else{
                ?>
                <?=_('您正在兑换')?>&nbsp;1&nbsp;<?=_('张')?><br>
                <?php
                    }
                ?>
                <?=$data['redpacket_t_title']?>
                （<em><?=_('满')?><?=$data['redpacket_t_orderlimit']?><?=_('减')?><?=$data['redpacket_t_price']?></em>）
            </dt>
            <dd><?=_('店铺代金券有效期至')?><?=date("Y-m-d", strtotime($data['redpacket_t_end_date']))?></dd>
            <dd>
                <?=_('每个ID限领')?><?=$data['redpacket_t_eachlimit']?><?=_('张')?>
            </dd>
        </dl>
		<?php
			}
		?>
</div>
	