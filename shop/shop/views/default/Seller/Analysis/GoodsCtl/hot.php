<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/seller_center.css"/>
<script src="<?= $this->view->js_com ?>/plugins/jquery.dialog.js" charset="utf-8"></script>
<script src="<?= $this->view->js ?>/seller_order.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/echarts-all.js"></script>
<link href="<?= $this->view->css_com ?>/jquery/plugins/datepicker/dateTimePicker.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.datetimepicker.js" charset="utf-8"></script>
<div class="search fn-clear">
    <form id="search_form" method="get">
        <input type="hidden" name="ctl" value="Seller_Analysis_Goods"/>
        <input type="hidden" name="met" value="hot"/>
        <input id="end_time" name="end_time"  class="ui-input ui-datepicker-input" type="text" value="<?=$data_search['end_time']?>"  style="width: 100px;height: 28px;background: #F5F5F5;border:1px #E1E1E1 solid" readonly placeholder="结束时间"/>
        <input id="start_time" name="start_time" class="ui-input ui-datepicker-input" type="text" value="<?=$data_search['start_time']?>" style="width: 100px;height: 28px;background: #F5F5F5;border:1px #E1E1E1 solid" readonly placeholder="开始时间"/>

        <!--        <a class="button refresh" href="index.php?ctl=Seller_Analysis_Goods&met=hot&typ=e"><i class="iconfont">
                        &#xe649;</i></a>-->
        <a class="button btn_search_goods ml10" href="javascript:void(0);"><i class="iconfont icon-btnsearch"></i>搜索</a>
<!--        <a  style="border:1px #E1E1E1 solid;height: 16px;" class="ui-btn" id="search">查询<i style="font-size: 16px" class="iconfont icon-btnsearch"></i></a>-->
        <a  style="border:1px #E1E1E1 solid;height: 16px;width:28px" class="ui-btn" id="search_sx">刷新</a>
    </form>
    <script type="text/javascript">

        $(".search").on("click", "a.button", function ()
        {
            $("#search_form").submit();
        });
    </script>
</div>

<div class="tabmenu">
    <ul class="tab clearfix">
        <li class="ui-tabs-selected bbc_seller_bg"><a href="javascript:void(0);" data-id="1" class="mar0">下单金额</a></li>
        <li><a href="javascript:void(0);" data-id="2" class="mar0">下单商品数</a></li>
    </ul>
</div>

<div class="main-content" id="mainContent">
    <div id="container" style="height: 400px;"></div>
    <div class="fl mr50 tb" style="width: 100%;" id="tb1">
        <table class="table-list-style table-promotion-list">
            <thead>
            <tr class="sortbar-array">
                <th class="align-center w100">序号</th>
                <th class="align-center">商品名称</th>
                <th class="align-center w200">下单金额</th>
            </tr>
            </thead>
            <tbody id="datatable">
            <?php if (empty($cash_list))
            { ?>
                <tr>
                    <td colspan="20" class="norecord">
                        <div class="no_account"> <img src="<?=$this->view->img?>/ico_none.png"><p>暂无符合条件的数据记录</p></div>
                    </td>
                </tr>
            <?php }
            else
            {
                foreach ($cash_list as $k => $v)
                {
                    ?>
                    <tr>
                        <td class="align-center"><?= ($k+1) ?></td>
                        <td class="align-center"><?= $v['goods_name'] ?></td>
                        <td class="align-center"><?= $v['cashes'] ?></td>
                    </tr>
                <?php }
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="fl mr50 tb" style="width: 100%;display: none;" id="tb2">
        <table class="table-list-style table-promotion-list">
            <thead>
            <tr class="sortbar-array">
                <th class="align-center w100">序号</th>
                <th class="align-center">商品名称</th>
                <th class="align-center w200">下单商品数量</th>
            </tr>
            </thead>
            <tbody id="datatable">
            <?php if (empty($num_list))
            { ?>
                <tr>
                    <td colspan="20" class="norecord">
                        <div class="warning-option"><i class="icon-warning-sign"></i><span>暂无符合条件的数据记录</span></div>
                    </td>
                </tr>
            <?php }
            else
            {
                foreach ($num_list as $k => $v)
                {
                    ?>
                    <tr>
                        <td class="align-center"><?=($k+1) ?></td>
                        <td class="align-center"><?= $v['goods_name'] ?></td>
                        <td class="align-center"><?= $v['nums'] ?></td>
                    </tr>
                <?php }
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="h30 cb">&nbsp;</div>
</div>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/echarts.js"></script>
<script>
    $(function ()
    {
        //时间
        $('#start_time').datetimepicker({
            controlType: 'select',
            format:"Y-m-d",
            timepicker:false
        });

        $('#end_time').datetimepicker({
            controlType: 'select',
            format:"Y-m-d",
            timepicker:false
        });
        $('#search_sx').click(function(){

            location.reload();
            var start_time=document.getElementById("start_time");
            var end_time=document.getElementById("end_time");
            start_time.value='';
            end_time.value='';
//            alert(start_time.value)
        });

        require.config({
            paths: {
                echarts: '<?=$this->view->js_com?>/plugins/echarts'
            }
        });

        option =
        {
            "1": {
                tooltip: {
                    show: true
                },
                legend: {
                    data:['下单金额']
                },
                xAxis : [
                    {
                        type : 'category',
                        data : <?=$data_cash['line']?>
                    }
                ],
                yAxis : {
                        type : 'value',
                        axisLabel: {
                            formatter: '{value} ￥'
                        }

                },
                series : [
                    {
                        "name":"下单金额",
                        "type":"line",
                        "data":<?=$data_cash['num']?>
                    }
                ]
            }
            ,
            "2": {
                tooltip: {
                    show: true
                },
                legend: {
                    data:['下单数量']
                },
                xAxis : [
                    {
                        type : 'category',
                        data : <?=$data_num['line']?>
                    }
                ],
                yAxis : [
                    {
                        type : 'value',
                        axisLabel: {
                            formatter: '{value} 单'
                        }
                    }
                ],
                series : [
                    {
                        "name":"下单数量",
                        "type":"line",
                        "data":<?=$data_num['num']?>,

                    }
                ]
            }
        }
        require(
            [
                'echarts',
                'echarts/chart/line' // 使用柱状图就加载bar模块，按需加载
            ],
            function (ec)
            {
                // 基于准备好的dom，初始化echarts图表
                var myChart = ec.init(document.getElementById('container'));
                myChart.setOption(option[1]);
            }
        );

        $(".tab li a").click(function ()
        {
            $(".tab li").removeClass("ui-tabs-selected bbc_seller_bg");
            $(this).parent("li").addClass("ui-tabs-selected bbc_seller_bg");
            var id = $(this).attr("data-id");
            $(".tb").css("display","none");
            $("#tb"+id).css("display","block");
            require(
                [
                    'echarts',
                    'echarts/chart/line' // 使用柱状图就加载bar模块，按需加载
                ],
                function (ec)
                {
                    // 基于准备好的dom，初始化echarts图表
                    var myChart = ec.init(document.getElementById('container'));
                    myChart.setOption(option[id]);
                }
            );
        })
    });
</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>



