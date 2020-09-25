<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/' . 'buyer_header.php';
?>

<div class="aright">
<div class="member_infor_content">

    <div class="tabmenu">
        <ul class="tab">
            <li class="active">
                <a href="#">
                    <?=_('资讯信息')?>
                </a>
            </li>
        </ul>
    </div>

      <table class="ncm-default-table annoc_con">
          <thead>
            <tr>
                <th class="w30"><?=_('序号')?></th>
              <th class="w80"><?=_('封面图片')?></th>
              <th class="w200"><?=_('标题')?></th>
              <th class="w200"><?=_('发布时间')?></th>
              <th class="w110"><?=_('操作')?></th>
            </tr>
          </thead>
		  <?php
				if($data['items'])
				{
            ?>
		  <tbody>
			
		   <?php
				foreach ($data['items'] as $key => $value)
				{
            ?>
            <tr class="bd-line">
                <td class="w30"><?= $value['information_id'] ?></td>
                <td class="w80"><img src="<?=$value['information_pic']?>" width="40" height="40" alt="封面图片"></td>
              <td data-id="<?= $value['information_id'] ?>" class="tl w200 btn-bluejeans <?php if($value['information_islook']==0){;?>dark<?php }?>"><?= $value['information_title'] ?></td>
              <td class="w200"><?= $value['information_add_time'] ?></td>

              <td class="ncm-table-handle"><span>
				<span class="edit">
                    <a  class="btn-bluejeans" dialog_width="550" dialog_title="<?=_('查看消息')?>" data-id="<?= $value['information_id'] ?>" href="javascript:void(0)" >
                        <i class="iconfont iconf icon-chakan"></i>
                        <?=_('查看')?>
                    </a>
                </span>
			  </td>
            </tr>
			<?php }?>
          </tbody>
		  <?php }else{?>
          <tbody>
            <tr>
              <td colspan="20" class="norecord">
			  <div class="no_account">
				<img src="<?= $this->view->img ?>/ico_none.png"/>
				<p><?=_('暂无符合条件的数据记录')?></p>
			 </div>  
			  </td>
            </tr>
          </tbody>
		  <?php }?>

        </table>
		<?php if($page_nav){ ?>
			<div style="clear:both"></div><div class="page page_front"><?=$page_nav?></div><div style="clear:both"></div>
		<?php } ?>
</div>
</div>
</div>
</div>

<script>
  $(".btn-bluejeans").bind("click",function(){
	  var obj = $(this);
	  var id = $(this).attr("data-id");
	  var ajax_url = SITE_URL+'?ctl=Buyer_Message&met=changeAnnouncement&typ=json';
	  /* http://localhost/taoshang/shop/index.php?ctl=Buyer_Message&met=changeAnnouncement&typ=json */
	  $.ajax({
			url: ajax_url,
			data:{id:id},
			success:function(a){
                if(a.status == 200)
				{
					 obj.parents('tr:first').children('.tl').removeClass('dark');
					location.href = SITE_URL+"?ctl=News&met=detail&id="+id;
					//window.open(url);
				}
				else
				{
					Public.tips.error("<?=_('查看失败！')?>");
				}
			}
		});
  });
</script>
<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>



