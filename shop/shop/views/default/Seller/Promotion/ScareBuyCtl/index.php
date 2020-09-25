<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';

?>
<div class="exchange">
    <div class="alert">
        <?php if($this->self_support_flag){ ?>
            <ul>
                <li><?=_('1、点击新增惠抢购按钮可以添加惠抢购活动')?></li>
                <li><?=_('2、如发布虚拟商品的惠抢购活动，请点击新增虚拟惠抢购按钮')?></li>
                <li>3、<strong  class="bbc_seller_color"><?=_('参加了惠抢购的商品将被锁定不可修改')?></strong></li>
            </ul>
        <?php }else{ ?>
            <h4>
                <?php if($this->combo_flag){ ?><?=_('套餐过期时间')?>：<em class="red"></em><?=$combo_row['combo_endtime']?>。
                <?php }else{ ?>
                    <?=_('你还没有购买套餐或套餐已经过期，请购买或续费套餐')?>
                <?php  } ?>
            </h4>
            <ul>
                <li><?=_('1、点击套餐管理或续费套餐可以购买或续费套餐')?></li>
                <li>2、<strong  class="bbc_seller_color"><?=_('参加了惠抢购的商品将被锁定不可修改')?></strong></li>
                <li>3、<strong  class="bbc_seller_color"><?=_('相关费用会在店铺的账期结算中扣除')?></strong></li>
            </ul>
        <?php } ?>
    </div>

    <div class="search fn-clear">
        <form id="search_form" method="get" action="<?=YLB_Registry::get('url')?>">
            <input type="hidden" name="ctl" value="<?=request_string('ctl')?>">
            <input type="hidden" name="met" value="<?=request_string('met')?>">
            <input type="hidden" name="typ" value="<?=request_string('typ')?>">
            <a class="button refresh" href="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_ScareBuy&met=index&typ=e"><i class="iconfont icon-huanyipi"></i></a>
            <a class="button btn_search_goods" href="javascript:void(0);"><i class="iconfont icon-btnsearch"></i><?=_('搜索')?></a>

            <select name="state">
                <option value=""><?=_('全部状态')?></option>
                <option value="<?=ScareBuy_BaseModel::UNDERREVIEW?>" <?=ScareBuy_BaseModel::UNDERREVIEW == request_int('state')?'selected':''?>><?=_('审核中')?></option>
                <option value="<?=ScareBuy_BaseModel::NORMAL?>" <?=ScareBuy_BaseModel::NORMAL == request_int('state')?'selected':''?>><?=_('正常')?></option>
                <option value="<?=ScareBuy_BaseModel::FINISHED?>" <?=ScareBuy_BaseModel::FINISHED == request_int('state')?'selected':''?>><?=_('已结束')?></option>
                <option value="<?=ScareBuy_BaseModel::AUDITFAILUER?>" <?=ScareBuy_BaseModel::AUDITFAILUER == request_int('state')?'selected':''?>><?=_('审核失败')?></option>
                <option value="<?=ScareBuy_BaseModel::CLOSED?>" <?=ScareBuy_BaseModel::CLOSED == request_int('state')?'selected':''?>><?=_('管理员关闭')?></option>
            </select>
            <input type="text" name="keyword" class="text w200" placeholder="<?=_('请输入惠抢购名称')?>" value="<?=request_string('keyword')?>" />
        </form>
        <script type="text/javascript">
            $(".search").on("click","a.button",function(){
                $("#search_form").submit();
            });
        </script>
    </div>

    <table class="table-list-style table-promotion-list" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <th width="50"></td>
            <th class="tl" width="300"><?=_('惠抢购标题')?></th>
            <th width="120"><?=_('开始时间')?></th>
            <th width="120"><?=_('结束时间')?></th>
            <!--<th width="50"><?/*=_('浏览数')*/?></th>-->
            <th width="50"><?=_('已购买')?></th>
            <th width="60"><?=_('活动状态')?></th>
            <th width="140"><?=_('操作')?></th>
        </tr>
        <?php
        if($data['items'])
        {
            foreach($data['items'] as $key=>$value)
            {
                ?>
                <tr>
                    <td width="50"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>&typ=e" target="_blank" title="<?=$value['goods_name']?>"><img src="<?=image_thumb($value['goods_image'],30,30)?>" width="30" height="30" ></a></td>
                    <td class="tl"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>&typ=e" target="_blank"><?=$value['scarebuy_name']?></a></td>
                    <td><?=$value['scarebuy_starttime']?></td>
                    <td><?=$value['scarebuy_endtime']?></td>
                    <td><?=$value['scarebuy_buy_quantity']?></td>
                    <td><?=$value['scarebuy_state_label']?></td>
                    <td class="nscs-table-handle" >
                        <span class="edit"><a href="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_ScareBuy&met=index&op=detail&id=<?=$value['scarebuy_id']?>&typ=e"><i class="iconfont icon-btnclassify2"></i><?=_('详情')?></a></span>
                        <?php /*if($value['scarebuy_state'] > ScareBuy_BaseModel::NORMAL || Perm::$shopId == 240){*/?><!--
                            <span class="del">
                                <a data-param="{'ctl':'Seller_Promotion_ScareBuy','met':'removeScareBuy','id':'<?/*=$value['scarebuy_id']*/?>'}" href="javascript:void(0)"><i class="iconfont icon-lajitong"></i><?/*=_('删除')*/?></a>
                            </span>
                        <?php /*}else{*/?>
                            <span class="lock">
                                <a alt="已参加惠抢购活动，不能修改商品"><i class="iconfont icon-icopwd"></i>锁定</a>
                            </span>
                        --><?php /*}*/?>
                        <span class="del">
                            <a data-param="{'ctl':'Seller_Promotion_ScareBuy','met':'removeScareBuy','id':'<?=$value['scarebuy_id']?>'}" href="javascript:void(0)"><i class="iconfont icon-lajitong"></i><?=_('删除')?></a>
                        </span>
                    </td>
                </tr>
            <?php } }else{ ?>
            <tr class="row_line">
                <td colspan="99">
                    <div class="no_account">
                        <img src="<?=$this->view->img?>/ico_none.png">
                        <p>暂无符合条件的数据记录</p>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </table>
    <?php if($page_nav){ ?>
        <div class="mm">
            <div class="page"><?=$page_nav?></div>
        </div>
    <?php }?>
</div>

<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>



