
$('#check-all').on('ifChecked', function(event){
        $('input[name="post\[\]"]').iCheck('check');
       // $('#bulk-action-container').show();
});

$('#check-all').on('ifUnchecked', function(event){
        $('input[name="post\[\]"]').iCheck('uncheck');
      //  $('#bulk-action-container').hide();
});

function notice(){

}
function ajax(url,success,data,type = "POST") {
        $.ajax({
                url:url,
                type:type,
                data:data,
                success: success,
                error: function (xhr, error) {
                        if (xhr.status === 401) {
                                location.reload();
                        }
                }
        });
}