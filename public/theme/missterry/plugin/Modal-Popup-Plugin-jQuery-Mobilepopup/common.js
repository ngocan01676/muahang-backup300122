jQuery().ready(function(){
    jQuery("body").on("click",".popup-demo",function(){
        var data = jQuery(this).data();

        var dom = jQuery(".pop-up2");
        dom.find('.form-info-date').html(data.date);
        dom.find('.form-info-time').html(data.time);

        jQuery.mobilepopup({
            targetblock:".pop-up2",
            width:"65%",
            height:"450px"
        });
        return false;
    });
});