function GetProduct(self) {

    console.log();
    var data = $("#UrlCompany").data();
    $.ajax({
       url:data.url,
       type:data.type,
       data:{
            cate:$(self).val()
       },
       success:function (data) {
           console.log(data);
          var lists = $(self).closest('.data').parent().parent().find('[data-key="id"]');
           lists.empty();
          for(var i in data)
          {
              lists.append('<option>'+data[i].description+'</option>');
          }

       }
    });
}