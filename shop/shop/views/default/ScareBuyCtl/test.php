<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>

<div>

    <!--<input type="text" class="demo-input" placeholder="选择日" id="test">
    <input type="text" class="demo-input" placeholder="选择月" id="test1">
    <input type="text" class="demo-input" placeholder="选择周" id="test2">
    <input type="text" class="demo-input" placeholder="选择范围" id="test3">
    <script type="text/javascript" src="<?/*=$this->view->js_com*/?>/laydate/laydate.js"></script>-->
    <script src="<?=$this->view->js_com?>/jquery-1.11.3.min.js"></script>

    <div class="ip"></div>
    <!--<script>
        $.ajaxPrefilter(function (options) {
            if (options.crossDomain && jQuery.support.cors) {
                var http = (window.location.protocol === 'http:' ? 'http:' : 'https:');
                options.url = http + '//cors-anywhere.herokuapp.com/' + options.url;
            }
        });

        $.get(
            'http://www.kdniao.com/External/GetIp.aspx',
            function (response) {
                $(".ip").html(response.toString().substring(0,15));
            });
    </script>-->
    <script>

        var url = "http://www.kdniao.com/External/GetIp.aspx";
        $.ajax({
            type: "get",
            async: false,
            url: encodeURI(url),
            dataType: "jsonp",
            jsonp: "cb", // 后台定义的回调函数标识符(一般默认为:callback)
            jsonpCallback: "jsonCallback", // 自定义的jsonp回调函数名称(默认为jQuery自动生成的随机函数名)
            success: function(data){
                $(".ip").html(data.toString().substring(0,15));
            }
        });

        /*$.ajax({
            async : false,
            url : 'http://www.kdniao.com/External/GetIp.aspx',
            type : "GET",
            dataType : 'jsonp',
            jsonp : 'callback',
            data : {
            },
            timeout : 5000,
            success : function(data) {
                $(".ip").html(data.toString().substring(0,15));
            }

        });*/

        /*laydate.render({
            elem: '#test'
        });

        laydate.render({
            elem: '#test1',
            type: 'month'
        });

        laydate.render({
            elem: '#test2',
            format: 'yyyy-MM-dd',
            min:'2017-10-22',
            max:'2018-02-24',
            value:'2017-12-03 - 2017-12-09',
            range:'-',
            week:1
        });

        laydate.render({
            elem: '#test3',
            format: 'yyyy-MM-dd',
            min:'2017-10-26',
            max:'2018-12-30',
            value:'2017-12-04 - 2017-12-19',
            range:'-'
        });

        $(function () {
            $('body').on('mouseover','.week .layui-laydate-content tbody tr',function () {
                hover_tr = $(this);
                $.each(hover_tr.children(),function (i) {
                    if(i == 0 || i == 6){
                        $(hover_tr.children()[i]).addClass('hover-this');
                    }else{
                        $(hover_tr.children()[i]).addClass('hover-selected');
                    }
                })
            }).on('mouseleave','.week .layui-laydate-content tbody tr',function () {
                hover_tr = $(this);
                $.each(hover_tr.children(),function (i) {
                    $(hover_tr.children()[i]).removeClass('hover-this');
                    $(hover_tr.children()[i]).removeClass('hover-selected');
                })
            });
        });*/
    </script>






    <!--<style type="text/css">
        @-webkit-keyframes spin_left{from{-webkit-transform: rotate(0deg) ;} to{-webkit-transform: rotate(-360deg);} }
        @keyframes spin_left{from{transform: rotate(0deg);} to{transform: rotate(-360deg);} }
        @-webkit-keyframes spin_right{from{-webkit-transform: rotate(0deg);} to{-webkit-transform: rotate(360deg);} }
        @keyframes spin_right{from{transform: rotate(0deg);} to{transform: rotate(360deg);} }
        @-webkit-keyframes spin_x{from{transform:rotateX(0deg);} to{transform:rotateX(360deg);} }
        @keyframes spin_x{from{transform:rotateX(0deg);} to{transform:rotateX(360deg);} }
        @-webkit-keyframes spin_y{from{transform:rotateY(0deg);} to{transform:rotateY(360deg);} }
        @keyframes spin_y{from{transform:rotateY(0deg);} to{transform:rotateY(360deg);} }
        .boll{width: 33px; height: 33px; position: absolute; top: 500px; left: 600px; background: url('<?/*=$this->view->img*/?>/hui.png');}
        .boll_left{-webkit-animation: spin_left 1s linear 1s 5 alternate; animation: spin_left 1s linear infinite ;}
        .boll_right{-webkit-animation: spin_right 1s linear 1s 5 alternate; animation: spin_right 1s linear infinite;}
        .boll_x{-webkit-animation: spin_x 1s linear 1s 5 alternate; animation: spin_x 1s linear infinite;}
        .boll_y{-webkit-animation: spin_y 1s linear 1s 5 alternate; animation: spin_y 1s linear infinite;}
    </style>

    <div id="boll" class="boll"></div>
    <script type="text/javascript">

        (function () {
            var _$ = function (_this) {
                return _this.constructor == jQuery ? _this : $(_this);
            };
            function now() {
                return +new Date();
            }

            function toInteger(text) {
                text = parseInt(text);
                return isFinite(text) ? text : 0;
            }

            var Parabola = function (options) {
                this.initialize(options);
            };
            Parabola.prototype = {
                constructor: Parabola,
                initialize: function (options) {
                    this.options = this.options || this.getOptions(options);
                    var ops = this.options;
                    if (!this.options.el) {
                        return;
                    }
                    this.$el = _$(ops.el);
                    this.timerId = null;
                    this.elOriginalLeft = toInteger(this.$el.css("left"));
                    this.elOriginalTop = toInteger(this.$el.css("top"));
                    if (ops.targetEl) {
                        this.driftX = toInteger(_$(ops.targetEl).css("left")) - this.elOriginalLeft;
                        this.driftY = toInteger(_$(ops.targetEl).css("top")) - this.elOriginalTop;
                    } else {
                        this.driftX = ops.offset[0];
                        this.driftY = ops.offset[1];
                    }
                    this.duration = ops.duration;
                    this.curvature = ops.curvature;
                    this.b = ( this.driftY - this.curvature * this.driftX * this.driftX ) / this.driftX;
                    if (ops.autostart) {
                        this.start();
                    }
                },
                getOptions: function (options) {
                    if (typeof options !== "object") {
                        options = {};
                    }
                    options = $.extend({}, defaultSetting, _$(options.el).data(), (this.options || {}), options);

                    return options;
                },
                domove: function (x, y) {

                    this.$el.css({
                        position: "absolute",
                        left: this.elOriginalLeft + x,
                        top: this.elOriginalTop + y
                    });

                    return this;
                },
                step: function (now) {
                    var ops = this.options;
                    var x, y;
                    if (now > this.end) {
                        x = this.driftX;
                        y = this.driftY;
                        this.domove(x, y);
                        this.stop();
                        if (typeof ops.callback === 'function') {
                            ops.callback.call(this);
                        }
                    } else {
                        x = this.driftX * ((now - this.begin) / this.duration);
                        y = this.curvature * x * x + this.b * x;

                        this.domove(x, y);
                        if (typeof ops.stepCallback === 'function') {
                            ops.stepCallback.call(this,x,y);
                        }
                    }
                    return this;
                },
                setOptions: function (options) {
                    this.reset();
                    if (typeof options !== "object") {
                        options = {};
                    }
                    this.options = $.extend(this.options,options);
                    this.initialize(this.options);
                    return this;
                },
                start: function () {
                    var self = this;
                    this.begin = now();
                    this.end = this.begin + this.duration;
                    if (this.driftX === 0 && this.driftY === 0) {
                        return;
                    }
                    if (!!this.timerId) {
                        clearInterval(this.timerId);
                        this.stop();
                    }
                    this.timerId = setInterval(function () {
                        var t = now();
                        self.step(t);

                    }, 13);
                    return this;
                },
                reset: function (x, y) {
                    this.stop();
                    x = x ? x : 0;
                    y = y ? y : 0;
                    this.domove(x, y);
                    return this;
                },
                stop: function () {
                    if (!!this.timerId) {
                        clearInterval(this.timerId);
                        this.$el.remove();
                    }
                    return this;
                }
            };
            var defaultSetting = {
                el: null,
                offset: [0, 0],
                targetEl: null,
                duration: 500,
                curvature: 0.001,
                callback: null,
                autostart: false,
                stepCallback: null
            };
            window.Parabola = Parabola;
        })();

        function randomNum(minNum,maxNum){
            switch(arguments.length){
                case 1:
                    return parseInt(Math.random()*minNum+1);
                    break;
                case 2:
                    return parseInt(Math.random()*(maxNum-minNum+1)+minNum);
                    break;
                default:
                    return 0;
                    break;
            }
        }

        function doMove() {
            for (var i = 0; i < 20; i++){

                var offset_x = randomNum(100,600);
                var offset_y = randomNum(100,200);
                var type = 'boll_right';

                if (randomNum(0,1) == 0){
                    offset_x = offset_x * (-1);
                    type = 'boll_left';
                }

                var x_y = randomNum(0,2);
                if (x_y == 0){
                    type = 'boll_x';
                }else if (x_y == 1){
                    type = 'boll_y';
                }

                $('#boll').after('<div id="boll'+i+'" class="boll ' + type + '"></div>');

                var bool = new Parabola({
                    el: "#boll" + i,
                    offset: [offset_x, offset_y],
                    curvature: 0.015,
                    duration: 3000,
                    callback:function(){
                    },
                    stepCallback:function(x,y){
                    }
                });

                bool.start();
            }
        }
        setInterval(function () {
            doMove();
        },500);
    </script>-->

</div>
