$(document).ready(function () {

    function effectCard() {
        $("#aP6frKNbT").show()
        $("#aP6frKNbT").animate({opacity: '100%'},{duration: 1000, complete: function(){
                $("#aP6frKNbT").animate({opacity: '0%'}, {duration: 1000, complete: function(){
                    $(this).hide();
                }});
            }});
    }

    function initCarts(conf) {

        $.ajax({
            url:window._urlCartList,
            data:{},
            type:"POST",
            success:function (html) {
                $("#cart").html(html.content);
            }
        });

        if(conf.hasOwnProperty('company')){

            if($('.Controller_Cart')){
                $.ajax({
                    data:{},
                    type:"GET",
                    success:function (html) {
                        console.log(html.views['treeview_'+conf.company]);
                        $("#company_"+conf.company).html($(html.views['treeview_'+conf.company]));
                        if($('.item_row').length === 0){
                            location.reload();
                        }
                    }
                });
            }

        }
    }
   $(".btn-add").click(function () {
        var data = $(this).data();
       cartAdd(data);
   });
    function cartAdd(data) {
        if(data.act === "add") {
            effectCard();
        }
        $.ajax({
            url:window._urlCartAdd,
            data:data,
            type:"POST",
            success:function (html) {
                console.log(html);
                initCarts(data);
            }
        });
    }
    function cartRemove(data,self){
        $(self).closest('.minicart-products-item').remove();
        $.ajax({
            url:window._urlCartAdd,
            data:data,
            type:"POST",
            success:function () {
                initCarts();
            }
        });
    }
    $(document).on('click','.btn-cart-remove',function () {

        var row = $(this).closest('.product-cart-row');
        var data = $(this).data();

        row.mask();

        $.ajax({
            url:window._urlCartAdd,
            data:data,
            type:"POST",
            success:function () {
                initCarts(data);
                row.unmask();
                row.remove();
            }
        });
    });
    $(document).on('click','.js-minicart-del',function () {
        cartRemove($(this).data(),this);
    });

    $(document).on('click','.btn-set-btn',function () {
       var type = $(this).data().type;
       var element = $(this).closest('.btn-set-wrap');
       var num = element.find('.btn-set-num');
       var count = parseInt(num.text());
       console.log(count);
       console.log(type.toString() === '+');
       if(type === "+"){
           count++;
       }else{
           count--;
       }
       console.log(count);
       num.html(count);
       var data = element.data();
       if(count <= 0){
           data.count = 0;
           cartRemove(data,this);
       }else{
           data.count = count;
           cartAdd(data);
       }
       // console.log(type);
    });
   initCarts({});
});