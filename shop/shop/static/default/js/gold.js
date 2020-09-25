$(function(){
	cat_pid = null;
	order = null;
	sort = null;
    pageNow = 1;
	list = 0;
    $(".show-way-wrap.lf.orflow a").click(function () {
		list = $(this).index();
		getList();
    })
    // 判断用户在input框内输入的是不是数字  若不是 则在失去焦点时 清空
	$(".input-wrap input").keyup( function() {
		if( isNaN( $(this).val() ) || $(this).val()===" " ){
			$(this).val("");
		}
	} )

	// 点击分类 中各项 高亮
	$(".classify-wrap .filter-body-item").click(function(){
		cat_pid = $(this).attr('data-id');
		pageNow = 1;
		getList();
		$(this).addClass("curr").siblings(".filter-body-item").removeClass("curr");
	})

	//  判断 更多字段 显示或者隐藏
	if( parseInt($(".classify-wrap .filter-body").height()) >35 ){
		$(".classify-wrap .filter-foot-more").show()
	}else{
		$(".classify-wrap .filter-foot-more").hide();
	}

	// 点击 分类条目中的更多是展开
	$(".classify-wrap .filter-foot-more").click(function(){
		if( !($(this).hasClass("sq") )){
			$(this).addClass("sq");
			$(".classify-wrap").css({"height":"auto"});
			$(this).children("a").html("收起<i class='icon'></i>");
		}else{
			$(this).removeClass("sq");
			$(".classify-wrap").css({"height":"35px"});
			$(this).children("a").html("展开<i class='icon'></i>");
		}
	})

	// 点击 默认排序中的各选项
	$(".sort-wrap .filter-body-item.sort").click(function(){
		index = $(this).index();
        if(index==0){
            order = 'heat';
        }
        if(index==1){
            order = 'price';
        }
        if(index==2){
            order = 'sale';
        }
        if(index==3){
            order = 'radio';
        }
		$(".sort-wrap .filter-head-name").removeClass("curr");
		if(!($(this).hasClass("curr"))){
			$(this).addClass("curr").removeClass("sort").siblings(".curr").removeClass("curr").addClass("sort");
			$(this).children("a").children(".icon").addClass("up");
			$(this).siblings(".sort").children("a").children(".icon").removeClass("up");
			$(this).siblings(".sort").children("a").children(".icon").removeClass("down");
			sort='desc';
		}else{
			if($(this).children("a").children(".icon").hasClass("down")){
				$(this).children("a").children(".icon").removeClass("down").addClass("up");
			sort = 'desc';
			}else{
				$(this).children("a").children(".icon").addClass("down").removeClass("up");
			sort = 'asc';
			}
		}
		getList();
	})
	// 点击默认排行 
	$(".sort-wrap .filter-head a").click(function(){
		$(this).children(".filter-head-name").addClass("curr");
		$(".sort-wrap .filter-body-item.curr").removeClass("curr");
		$(".sort-wrap .filter-body-item").addClass("sort").children("a").children(".icon").removeClass("up").removeClass("down");
	})

	// 移入移出发货地 弹框显示或者隐藏
	$(".filter-body-item.slider-down").mouseenter(function(){
		$(".port-pop").show();
	}).mouseleave(function(){
		$(".port-pop").hide();
	})

	// 点击 显示方式
	$(".show-way-wrap a").click(function(){
		var index = $(this).index();
		$(".show-wrap").hide();
		$(".show-wrap").eq(index).show();

		$(this).siblings("a").children(".icon").removeClass("curr");
		$(this).children(".icon").addClass("curr");
	})

	// 点击 默认排序中的分页
	$(".page-next-a").click(function(){
		 pageNow = parseInt($(".paging-num .num-before").text());
		console.log(pageNow);
		if( pageNow < parseInt($(".num-next").text()) ) {
			pageNow +=1;
			$(".page-before-a").addClass("curr");
		}
		$(".paging-num .num-before").text(pageNow);

		if(pageNow >= parseInt($(".num-next").text()) ){
			$(this).removeClass("curr");
		}
		getList();
	})
	$(".page-before-a").click(function(){
		 pageNow = parseInt($(".paging-num .num-before").text());
		if( pageNow > 1 ) {
			pageNow -=1;
			$(".page-next-a").addClass("curr");
		}
		$(".paging-num .num-before").text(pageNow);

		if( pageNow ===1 ){
			$(".page-before-a").removeClass("curr");
		}
		getList();
	})

	// 点击申请淘金
	$(".spread.apply.cl").click(function(){
		// alert('123');
		if(confirm('尚未达成申请条件,请前去申请')){
			window.location.href='?ctl=Distribution_Buyer_Directseller&met=index&typ=e';
		}else {
			alert('no');
		}
		// if( !($(".apply-progress").hasClass("call") ) ){
		// 	$(".apply-progress").addClass("call");
		// 	var me = this;
		// 	setTimeout(function(){
		// 		$(".apply-progress.call").css({"top":"-60px"});
		// 		$(".apply-progress").removeClass("call");
		// 		$(me).hide();
		// 		$(me).siblings(".spread.join").show();
		// 	},1000)
		// }else{
		// 	return false;
		// }
	})
	// 点击加入淘金
	$(".spread.join").click(function(){
		$(this).hide();
		$(this).siblings(".spread.spread-3").show();
	})
	// 点击复制链接
	$(".copy-code").click(function(){
		$(this).addClass("curr");
	})
	// 点击二维码
	$(".erweima").click(function(){
		$(".ui-mask").fadeIn(200);
		$(".erweima-pop").fadeIn(300);
	})
	$(".close").click(function(){
		$(".ui-mask").fadeOut(200);
		$(".erweima-pop").fadeOut(300);
	})
	// 点击立即推广
	$(".extend-once").click(function(){
		// $(".ui-mask").fadeIn(200);
		// $(".extend-pop").fadeIn(300);
		// $(this).parent().parent().parent().next().fadeIn(300);
	})
	$(".close").click(function(){
		$(".ui-mask").fadeOut(200);
		$(".extend-pop").fadeOut(300);
	})
	// 移入 更多推广时
	$(".more-extend").mouseenter(function(){
		$(".more-extend-pop").fadeIn(200)
	}).mouseleave(function(){
		$(".more-extend-pop").fadeOut(200)
	})


	function getList() {
        $.post("index.php?ctl=Distribution_Buyer_Directseller&met=directsellerMarket&typ=json&page="+pageNow,{cat_pid:cat_pid,order:order,sort:sort},function (r) {
			if(r.status == 200){
				if(list ==1){
				var list_1 = template.render('list_1', r.data.detail);
				$('.show-list').html(list_1);
				}else{
                    var list_0 = template.render('list_0', r.data.detail);
                    $('.show-list').html(list_0);
				}
			}

        })

    }
})