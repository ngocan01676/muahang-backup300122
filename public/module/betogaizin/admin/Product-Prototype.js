function GetProduct(self , val) {
    console.log(val);
    var data = $("#UrlCompany").data();
        $.ajax({
           url:data.url,
           type:data.type,
           data:{
                cate:$(self).val()
           },
           success:function (data) {
              var lists = $(self).closest('.data').parent().parent().find('[data-key="id"]');
               lists.empty();
              for(var i in data)
              {
                  lists.append('<option '+( (val.toString() === data[i].id.toString()) ?"selected=\"selected\"":"")+' value="'+data[i].id+'">'+data[i].description+'</option>');
              }
           }
        });
}

function BetoGaizin_DataComposer_Price_beforeInit() {
    $("#tab_prototy .ajax").each(function () {
        console.log();
        var element = $(this).closest('.Element').find('[data-key='+$(this).attr('data-ajax')+']');

        if(element) GetProduct(element,$(this).attr('data-value'));
    });
}