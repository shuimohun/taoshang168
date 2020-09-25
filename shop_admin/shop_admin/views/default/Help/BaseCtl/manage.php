<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
<link href="<?= $this->view->css_com ?>/webuploader.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
<!-- 配置文件 -->
<script type="text/javascript" src="<?= $this->view->js_com ?>/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="<?= $this->view->js_com ?>/ueditor/ueditor.all.js"></script>

<script type="text/javascript" src="<?= $this->view->js_com ?>/upload/addCustomizeButton.js"></script>
<style>
</style>
</head>
<body>
<form id="help_form" method="post">
    <div class="ncap-form-default">
      <dl class="row">
        <dt class="tit">
          <label for="help_title"><em>*</em>标题</label>
        </dt>
        <dd class="opt">
          <input type="text" value="" name="help_title" id="help_title" class="ui-input">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
            <label><em>*</em>分类:</label>
        </dt>
        <dd class="opt">
            <div class="ctn-wrap">

                <span nctype="gc1">
                    <select nctype="gc" data-deep="1">
                        <!--<option>请选择...</option>-->
                    </select>
                </span>
                <span nctype="gc2"></span>
                <span nctype="gc3"></span>
                <span nctype="gc4"></span>
                <p>请选择帮助分类（必须选到最后一级）</p>
                <input type="hidden" id="help_group_id" name="help_group_id" value="" class="mls_id">
            </div>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="help_url">链接</label>
        </dt>
        <dd class="opt">
          <input type="text" value="" name="help_url" id="help_url" class="ui-input">
          <span class="err"></span>
          <p class="notic">当填写&quot;链接&quot;后点击文章标题将直接跳转至链接地址，不显示文章内容。链接格式请以http://开头</p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="if_show">是否启用:</label>
        </dt>
        <dd class="opt">
          <div class="onoff">
            <label for="help_status1" class="cb-enable  ">启用</label>
            <label for="help_status2" class="cb-disable  selected">关闭</label>
            <input id="help_status1"  name ="help_status"  value="1" type="radio">
            <input id="help_status2"  name ="help_status"  checked="checked"  value="2" type="radio">
          </div>
          <p class="notic"></p>
        </dd>
      </dl>
	  <dl class="row">
        <dt class="tit">
          <label for="if_show">是否公告:</label>
        </dt>
        <dd class="opt">
          <div class="onoff">
            <label for="help_type1" class="cb-enable  ">是</label>
            <label for="help_type2" class="cb-disable  selected">否</label>
            <input id="help_type1"  name ="help_type"  value="1" type="radio">
            <input id="help_type2"  name ="help_type"  checked="checked"  value="0" type="radio">
          </div>
          <p class="notic"></p>
        </dd>
      </dl>
<!--	  <dl class="row">-->
<!--        <dt class="tit">-->
<!--          <label for="rule_help">帮助/规则:</label>-->
<!--        </dt>-->
<!--        <dd class="opt">-->
<!--          <div class="onoff">-->
<!--            <label for="rule_type1" class="cb-enable  ">帮助</label>-->
<!--            <label for="rule_type2" class="cb-disable  selected">规则</label>-->
<!--            <input id="rule_type1"  name ="help_or_rule"  value="帮助" type="radio">-->
<!--            <input id="rule_type2"  name ="help_or_rule"  checked="checked"  value="规则" type="radio">-->
<!--          </div>-->
<!--          <p class="notic"></p>-->
<!--        </dd>-->
<!--      </dl>-->
      <dl class="row">
        <dt class="tit">排序</dt>
        <dd class="opt">
          <input type="text" value="" name="help_sort" id="help_sort" class="ui-input">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label><em>*</em>帮助内容</label>
        </dt>
        <dd class="opt">
            <!-- 加载编辑器的容器 -->
            <textarea id="help_desc" style="width:700px;height:300px;" name="content" type="text/plain">

            </textarea>
        </dd>
      </dl>
    </div>
  </form>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('help_desc', {
        toolbars: [
            [
                'fullscreen', 'source', '|', 'undo', 'redo', '|','bold', 'italic', 'underline', 'forecolor', 'backcolor', 'justifyleft', 'justifycenter', 'justifyright', 'insertunorderedlist', 'insertorderedlist', 'blockquote',
             'emotion', 'insertvideo', 'link', 'removeformat', 'rowspacingtop', 'rowspacingbottom', 'lineheight', 'paragraph', 'fontsize', 'inserttable', 'deletetable', 'insertparagraphbeforetable',
             'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols'
            ]
        ],
        autoClearinitialContent: true,
        //关闭字数统计
        wordCount: false,
        //关闭elementPath
        elementPathEnabled: false,
        maximumWords:20000
    });
</script>
<script type="text/javascript" src="<?= $this->view->js_com ?>/webuploader.js" charset="utf-8"></script>
<script type="text/javascript" src="<?= $this->view->js ?>/models/upload_image.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js?>/controllers/help/base_manage.js" charset="utf-8"></script>
<script>
    //分步获取商品分类
    if(oper == 'add'){
        getCatList(0, $("span[nctype=gc1]>select"), false);
    }
    $("span[nctype=gc1], span[nctype=gc2]").on('change', 'select', function (){
        var $select = $(this),
            p_id = $(this).val(),
            cat_name = $(this).children("option:checked").text();
        $("#help_group_id").val(p_id), $("#cat_name").val(cat_name);
        getCatList(p_id, $select, true);
    });
    function getCatList(p_id, $select, change) {

        var deep = $select.data('deep');
        switch (deep) {
            case 1 :
                $("span[nctype=gc2], span[nctype=gc3], span[nctype=gc4]").empty();
                break;
            case 2 :
                $("span[nctype=gc3], span[nctype=gc4]").empty();
                break;
            case 3 :
                $("span[nctype=gc4]").empty();
                break;
        }
        $.get(SITE_URL + '?ctl=Help_Base&met=getGroupByClass&typ=json', {p_id: p_id}, function(data){
            if (data.status == 200) {
                var option_rows = [], cat_data = data.data;
                if(cat_data.length > 0){
                    option_rows.push("<option value=>" + '请选择...' + "</option>");
                }
                for (var i = 0; i < cat_data.length; i++) {
                    option_rows.push("<option value=" + cat_data[i].help_group_id + ">" + cat_data[i].help_group_title + "</option>");
                }
                if (change){
                    if (option_rows.length > 0) {
                        //default first goods_cat
                        //$("#gc_id").val(cat_data[0].p_id), $("#cat_name").val(cat_data[0].cat_name);
                        var next_deep = deep + 1;
                        $("span[nctype=gc" + next_deep + "]").append("<select data-deep=" + next_deep + ">" + option_rows.join("") + "</select>");
                        //$("span[nctype=gc" + next_deep + "]").children("option").eq(0).trigger("click");
                    }
                } else {
                    $select.append(option_rows.join(""));
                }

            } else {
                Public.tips.error(data.msg);
            }
        })

    }
</script>

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>