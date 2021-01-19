jQuery().ready(function(){
    jQuery("body").on("click",".popup-demo",function(){
        var data = jQuery(this).data();

        var dom = jQuery(".pop-up2");
        dom.find('.form-info-date').html(data.date);
        dom.find('.form-info-time').html(data.time);
        var lists = [];
        jQuery(this).closest('.list').find('.calendar__item').each(function () {
           let time = jQuery(this).find('.item__time').text();
            lists.push({
                time:time,
                disabled:(jQuery(this).hasClass('disabled') || jQuery(this).hasClass('low'))
            });
        });
        let dom_time = dom.find('[name="time"]');
        dom_time.empty();
        let html_time = "";

        for(let i in lists){
            html_time+='<option '+(lists[i].disabled?"disabled":((data.time === lists[i].time) ?"selected":""))+' value="'+lists[i].time+'">'+lists[i].time+'</option>';
        }
        dom_time.html(html_time);
        console.log(lists);
        jQuery.mobilepopup({
            targetblock:".pop-up2",
            width:"80%",
            height:"650px"
        });
        return false;
    });
});