
var searchArray = {};
// 分类选择
function selClass(obj){
    $('.item_list').css('background','');
    $("#span").hide();
    $("#dt").show();
    $("#dd").show();
    $(obj).siblings('li').children('a').attr('class','');
    $(obj).children('a').attr('class','selected');
    tonextClass(obj.id);
}

function tonextClass(text){
    var valarray = text.split('|');
    $('#cat_id').val(valarray[0]);
    $('#dataLoading').show();
    var url = SITE_URL + '?ctl=Seller_Goods_Cat&met=cat&typ=json&cat_id='+valarray[0]+'&deep='+(valarray[1]*1+1);
    $.getJSON(url,function(data){
        data = data.data;
        if(data && data.length > 0){
            $('#button_next_step').attr('disabled',true).removeClass('bbc_seller_submit_btns').addClass('bbc_sellerGray_submit_btns');
            var str = '';
            var class_div_id = parseInt(valarray[1])+1;
            var searchStr = '';
            $.each(data, function(i, cat_row){
                str += '<li onclick="selClass(this);" id="'+cat_row.cat_id+'|'+class_div_id+'"><a href="javascript:void(0)"><i class="arrow iconfont icon-btnrightarrow"></i>'+cat_row.cat_name+'</a></li>';
                if($.inArray(cat_row.cat_id, searchArray) >= 0){
                    searchStr = cat_row.cat_id+'|'+class_div_id;
                }
            });
            $('#class_div_'+class_div_id).parents('.item_list').removeClass('blank');
            for (j = class_div_id; j <= 4; j++) {
                $('#class_div_'+(j+1)).parents('.item_list').addClass('blank');
            }
            $('#class_div_'+class_div_id).empty();
            $('#class_div_'+class_div_id).append(str);
            $('#class_div_'+class_div_id).parent().nextAll('.item_list').children('ul').empty();
            var str="";
            $.each($('a[class=selected]'),function(i){
                str+=$(this).html()+"&nbsp;&nbsp;";
            });
            $('#dd').html(str);
            $('#dataLoading').hide();

            if(searchStr.length > 0){
                var obj = document.getElementById(searchStr)
                selClass(obj);
            }
        }
        else
        {
            for(var i= parseInt(valarray[1]); i < 4; i++){
                $('#class_div_'+(i+1)).empty();
            }
            var str="";
            $.each($('a[class=selected]'),function(i){
                str+=$(this).html()+"&nbsp;&nbsp;";
            });
            str = str.substring(41,str.length);
            $('#dd').html(str);
            disabledButton();
            $('#dataLoading').hide();
        }
    });
}

function disabledButton(){
    if($('#cat_id').val() != ''){
        $('#button_next_step').attr('disabled',false).addClass('bbc_seller_submit_btns').removeClass('bbc_sellerGray_submit_btns');
    }else {
        $('#button_next_step').attr('disabled',true).removeClass('bbc_seller_submit_btns').addClass('bbc_sellerGray_submit_btns');
    }
}

$(function () {
    $('.btn_search_goods').on('click',function () {

        $('#dataLoading').show();

        var search_key = $('input[name="search_key"]').val();
        var url = SITE_URL + '?ctl=Goods_Cat&met=searchCat&typ=json';

        $.getJSON(url,{search_key:search_key},function(data){
            if(data.status == 200){
                data = data.data;

                var lists = '';
                $.each(data,function (i) {
                    var html = '';
                    var ids = '';
                    for(var j = 0;j < data[i].length;j++){

                        if(j == 0){
                            html += '<i class="iconfont icon-angle-right"></i>' + data[i][j].cat_name;
                            ids += data[i][j].cat_id;
                        }else {
                            html += '<i class="arrow iconfont icon-btnrightarrow"></i>' + data[i][j].cat_name + '&nbsp;&nbsp;';
                            ids += '|' + data[i][j].cat_id;
                        }
                    }
                    lists += '<li class="search-cat-li" data-ids="'+ids+'" data-id="'+i+'">'+html+'</li>';
                })

                $('#search-ul').html(lists);
                $('#dataLoading').hide();
                $('.goods-category-list').hide()
                $('.goods-search-list').show()

                $('.search-cat-li').on('click',function () {

                    searchArray = $(this).data('ids').split('|');

                    var obj = document.getElementById(searchArray[0]+'|'+1)
                    selClass(obj);

                    $('#cat_id').val($(this).data('id'));

                    $("#span").hide();
                    $("#dt").show();
                    $("#dd").show();
                    $('.goods-search-list').hide()
                    $('.goods-category-list').show()


                    $('#dd').html($(this).html());
                    disabledButton();
                })

            }
        });

    })
})