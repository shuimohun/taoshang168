<?php if (!defined('ROOT_PATH')) exit('No Permission');?>

<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
</head>
<body>

	<div class="tabmenu">
		<ul>
                    <li class=""><a href="./index.php?ctl=Seller_Shop_Nav&met=nav&typ=e"><?=_('店铺导航')?></a></li>

            <?php if($act == 'add') {?>
            <li  class="active bbc_seller_bg"><a href="javascript:void(0);"><?=_('添加店铺导航')?></a></li>
            <?php }
            if($act == 'edit'){?>
            <li class="active bbc_seller_bg"><a href="javascript:void(0);"><?=_('编辑店铺导航')?></a></li>
            <?php }?>
        </ul>

    </div>
    <?php if($act == 'add') {?>
        <form id="form" action="#" method="post" >
            <div class="form-style">
                <dl class="dl">
                    <dt><i>*</i><?=_('导航名称：')?></dt>
                    <dd ><input type="text" class="text w120" name="nav[title]" id="title" value="" /></dd>
                </dl>
                <dl class="dl">
                    <dt><?=_('是否显示：')?></dt>
                    <dd >  <label class="radio status"><input type="radio"  name="nav[status]" id="status" checked="checked" value="1" /><?=_('是')?></label> <label class="radio status"><input type="radio"  name="nav[status]" id="status" value="0" /><?=_('否')?></label></dd>
                </dl>
                <dl class="dl">
                    <dt><i></i><?=_('排序：')?></dt>
                    <dd ><input type="text" class="text w50" name="nav[displayorder]" id="displayorder" value="" />
                    <p class="hint"><?=_('排序为0-255之间')?></p></dd>
                </dl>
                <dl class="dl">
                    <dt><i></i><?=_('内容：')?></dt>
                    <dd>
                        <textarea id="container" name="nav[detail]" style="width:100%;height:300px;">
					    </textarea>
                    </dd>
                </dl>
                <dl class="dl">
                    <dt><i></i><?=_('导航外链URL：')?></dt>
                    <dd style="width:50%;">
                        <input type="text" class="text w200" name="nav[url]" id="url" value="" />
                        <p class="hint"><?=_('请填写包含http://的完整URL地址,如果填写此项则点击该导航会跳转到外链')?></p>
                    </dd>
                </dl>
                <dl class="dl">
                    <dt><?=_('新窗口打开：')?></dt>
                    <dd ><label class="radio target"><input type="radio"  name="nav[target]" id="target" checked="checked" value="1" /><?=_('是')?></label> <label class="radio target"><input type="radio"  name="nav[target]" id="target" value="0" /><?=_('否')?></label></dd>
                </dl>
                <dl>
                    <dt></dt>
                    <dd><input type="submit" class="button bbc_seller_submit_btns" value="<?=_('确认提交')?>" /></dd>
                </dl>
            </div>
        </form>
    <?php }if($act == 'edit' && $data){?>
        <form id="form" action="#" method="post" >
            <div class="form-style">
                <input type="hidden" name="id" id="id" value="<?=$data['id']?>" />
                <dl class="dl">
                    <dt><i>*</i><?=_('导航名称：')?></dt>
                    <dd ><input type="text" class="text w120" name="nav[title]" id="title" value="<?=$data['title']?>" /></dd>
                </dl>
                 <dl class="dl">
                    <dt><?=_('是否显示：')?></dt>
                    <dd >  <label class="radio status"><input type="radio" <?=($data['status'] ? 'checked' : '') ?>  name="nav[status]" id="status" value="1" /><?=_('是')?></label> <label class="radio status"><input type="radio"   <?=(!$data['status'] ? 'checked' : '') ?>  name="nav[status]" id="status" value="0" /><?=_('否')?></label></dd>
                </dl>
                <dl class="dl">
                    <dt><i></i><?=_('排序：')?></dt>
                    <dd ><input type="text" class="text w50" name="nav[displayorder]" id="displayorder" value="<?=$data['displayorder']?>" />
                     <p class="hint"><?=_('排序为0-255之间')?></p></dd>
                </dl>
                <dl class="dl">
                    <dt><i></i><?=_('内容：')?></dt>
                    <dd>
                        <script id="detail" type="text/plain">
                            <?php echo @$data['detail']?>
                        </script>
                        <textarea id="container" name="nav[detail]" style="width:100%;height:500px;">
					    </textarea>
                    </dd>
                </dl>
                <dl class="dl">
                    <dt><i></i><?=_('导航外链URL：')?></dt>
                    <dd style="width:50%;">
                        <input type="text" class="text w200" name="nav[url]" id="url" value="<?=$data['url']?>" />
                        <p class="hint"><?=_('请填写包含http://的完整URL地址,如果填写此项则点击该导航会跳转到外链')?></p>
                    </dd>
                </dl>
                   <dl class="dl">
                   <dt><?=_('新窗口打开：')?></dt>
                   <dd ><label class="radio target"><input type="radio" <?=($data['target'] ? 'checked' : '') ?>  name="nav[target]" id="target" value="1" /><?=_('是')?></label> <label class="radio target"><input type="radio"  <?=(!$data['target'] ? 'checked' : '') ?> name="nav[target]" id="target" value="0" /><?=_('否')?></label></dd>
                </dl>
                <dl>
                    <dt></dt>
                    <dd><input type="submit" class="button bbc_seller_submit_btns" value="<?=_('确认提交')?>" /></dd>
                </dl>
            </div>
        </form>
    <?php }?>

    <script type="text/javascript" src="<?= $this->view->js_com ?>/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="<?= $this->view->js_com ?>/ueditor/ueditor.all.js"></script>
    <script type="text/javascript" src="<?= $this->view->js_com ?>/upload/addCustomizeButton.js"></script>
    <script type="text/javascript">
        var ue = UE.getEditor('container', {
            toolbars: [
                [
                 'fullscreen', 'source', '|', 'undo', 'redo', '|',
                 'bold', 'italic', 'underline', 'forecolor', 'backcolor', 'justifyleft', 'justifycenter', 'justifyright', 'insertunorderedlist', 'insertorderedlist', 'blockquote',
                 'emotion', 'insertvideo', 'link', 'removeformat', 'rowspacingtop', 'rowspacingbottom', 'lineheight', 'paragraph', 'fontsize', 'inserttable', 'deletetable', 'insertparagraphbeforetable',
                 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols'
                ]
            ],
            //关闭字数统计
            wordCount: false,
            //关闭elementPath
            autoHeightEnabled:false,
        });
        ue.ready(function() {
            var html = $('#detail').html();
            ue.setContent(html);
        });

        $(document).ready(function(){
            var ajax_url = './index.php?ctl=Seller_Shop_Nav&met=<?=$act?>Nav&typ=json';

            $('#form').validator({
                ignore: ':hidden',
                theme: 'yellow_right',
                timely: 1,
                stopOnError: true,
                rules: {
                },
                fields: {
                    'nav[title]': 'required;length[1~10]',
                    'nav[displayorder]':'range[0~255];integer',
                },
                valid:function(form){
                    var me = this;
                    me.holdSubmit();
                    $.post( ajax_url, $('#form').serialize(), function(a) {
                        if(a.status == 200)
                        {
                            parent.Public.tips.success('操作成功');
                            me.holdSubmit(false);
                        }
                        else
                        {
                            parent.Public.tips.error('操作失败！');
                            me.holdSubmit(false);
                        }
                    });

                }
            });
        });

       /* function editor_init() {
            $('#form').submit(function () {
                editor=UE.getEditor('container');
                if(editor.queryCommandState('source')==1) editor.execCommand('source');
            })
        }
        editor_init();*/

    </script>

<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>