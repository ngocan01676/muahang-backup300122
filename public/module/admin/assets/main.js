
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