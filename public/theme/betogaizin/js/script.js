$(document).ready(function () {
    function initCarts() {
        $.ajax({
            url:window._urlCartList,
            data:{},
            type:"POST",
            success:function (html) {
                $("#cart").html(html.views.content);
            }
        });
    }
   $(".btn-add").click(function () {
        var data = $(this).data();
       cartAdd(data);
   });
    function cartAdd(data) {
        $.ajax({
            url:window._urlCartAdd,
            data:data,
            type:"POST",
            success:function (html) {
                console.log(html);
                initCarts();
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
   initCarts();
});