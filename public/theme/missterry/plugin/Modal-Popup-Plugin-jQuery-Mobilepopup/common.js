jQuery().ready(function(){
    jQuery("body").on("click",".popup-demo",function(){

        jQuery.mobilepopup({
            targetblock:".pop-up2",
            width:"800px",
            height:"400px"
        });
        return false;
    });
});