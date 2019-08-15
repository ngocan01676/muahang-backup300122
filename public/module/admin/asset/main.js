
$(".listMain .table tbody > tr").hover(function () {
        $(this).find('.row-actions').css({position:"static"});
},function () {
        $(this).find('.row-actions').css({position:"relative"});
});

$(".btn-box-tool").click(function () {
        var i = $(this).find('i');
        if($(this).find('i').hasClass('fa-plus')){
                i.removeClass('fa-plus');
                i.addClass('fa-minus');
                $(this).closest('tr').find('.row-actions').css({position:"static"});
        }else{
                i.addClass('fa-plus');
                i.removeClass('fa-minus');
                $(this).closest('tr').find('.row-actions').css({position:"relative"});
        }
});
$('#check-all').on('ifChecked', function(event){
        $('input[name="post\[\]"]').iCheck('check');
       // $('#bulk-action-container').show();
});

$('#check-all').on('ifUnchecked', function(event){
        $('input[name="post\[\]"]').iCheck('uncheck');
      //  $('#bulk-action-container').hide();
});

