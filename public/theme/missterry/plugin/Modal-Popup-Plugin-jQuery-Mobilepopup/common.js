jQuery().ready(function(){
    jQuery("body").on("click",".popup-demo",function(){
        jQuery.mobilepopup({
            targetblock:".pop-up2",
            width:"500px",
            height:"300px"
        });
        return false;
    });
});