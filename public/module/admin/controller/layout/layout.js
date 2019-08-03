var guidGenerator = function() {
    return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
};
function id() {
    return (guidGenerator()+guidGenerator()+"-"+guidGenerator()+"-"+guidGenerator()+"-"+guidGenerator()+"-"+guidGenerator()+guidGenerator()+guidGenerator());
}
function resetColumn(parent){
    var arrColumn =  parent.find(">.column");
    var list = [];
    for(var v=0 ; v<arrColumn.length ; v++){
        list.push($(arrColumn[v]).height());
    }
    var max = Math.max(...list);
    var index = list.indexOf(max);
    for(var v=0 ; v<arrColumn.length ; v++){
        if(index!=v){
            list.push($(arrColumn[v]).height((max)+"px"));
        }
    }
}
var demo = $(".demo");
$(".demo").sortable({
    connectWith: ".column",
    opacity: .35,
    handle: ".drag",
    cursorAt: {top: 0, left: 0 },
    stop:function (ui) {
        console.log("stop .demo");
        // console.log(ui.target);
        // console.log($(ui.target).height());
        var arrColumn =  $(ui.target);
        console.log(arrColumn);
        // console.log(arrColumn);
        // var indexPos = arrColumn.index($(ui.target));
        // var list = [];
        // for(var v=0 ; v<arrColumn.length ; v++){
        //     list.push($(arrColumn[v]).height());
        // }
        // var max = Math.max(...list);
        // var index = list.indexOf(max);
        //
        // for(var v=0 ; v<arrColumn.length ; v++){
        //     if(index!=v){
        //         list.push($(arrColumn[v]).height((max)+"px"));
        //     }
        // }
    },
    start:function (ui) {
        console.log("start");
        //console.log(ui.target);
    }
});
$(".demo .column").sortable({
    connectWith: ".column",
    opacity: .35,
    handle: ".drag",
    cursorAt: {top: 0, left: 0 },
    stop:function (ui) {
        console.log("stop .demo, .demo .column");
        // console.log(ui.target);
        // console.log($(ui.target).height());
        var arrColumn =  $(ui.target);
        console.log(arrColumn);
        // console.log(arrColumn);
        // var indexPos = arrColumn.index($(ui.target));
        // var list = [];
        // for(var v=0 ; v<arrColumn.length ; v++){
        //     list.push($(arrColumn[v]).height());
        // }
        // var max = Math.max(...list);
        // var index = list.indexOf(max);
        //
        // for(var v=0 ; v<arrColumn.length ; v++){
        //     if(index!=v){
        //         list.push($(arrColumn[v]).height((max)+"px"));
        //     }
        // }
    },
    start:function (ui) {
        console.log("start");
        //console.log(ui.target);
    }
});
$(".sidebar-nav .grid").draggable({
    connectToSortable: ".demo",
    helper: "clone",
    handle: ".drag",
    drag: function(e,ui) {
        ui.helper.width(300)
    },
    cursorAt: {
        top: 0,
        left: 0
    },
    stop: function(e,ui) {
        ui.helper.width("100%");
        ui.helper.height("auto");
        if(ui.helper.parent().hasClass("demo")){
            console.log($(this).attr('data-id'));
            //layout.formSettingGrid($(this).attr('data-id'));
        }else{
            var arrColumn =  ui.helper;
            console.log("j=>"+$(this).attr('data-id'));
            resetColumn(ui.helper.parent().parent());
            // var arrColumn =  ui.helper.parent().parent().find(">.column");
            //
            // var list = [];
            // for(var v=0 ; v<arrColumn.length ; v++){
            //     list.push($(arrColumn[v]).height());
            // }
            // var max = Math.max(...list);
            // var index = list.indexOf(max);
            // for(var v=0 ; v<arrColumn.length ; v++){
            //     if(index!=v){
            //         list.push($(arrColumn[v]).height((max)+"px"));
            //     }
            // }
        }
        ui.helper.find(".column").sortable({
            opacity: .35,
            handle: ".drag",
            connectWith: ".column",
            zIndex: 10000,
            cursorAt: {top: 0, left: 0 },
            stop:function (ui) {
                console.log("stop sidebar-nav .grid");
                resetColumn( $(ui.target).parent());
                // var arrColumn =  $(ui.target).parent().find(">.column");
                // var indexPos = arrColumn.index($(ui.target));
                // var list = [];
                // for(var v=0 ; v<arrColumn.length ; v++){
                //     list.push($(arrColumn[v]).height());
                // }
                // var max = Math.max(...list);
                // var index = list.indexOf(max);
                // for(var v=0 ; v<arrColumn.length ; v++){
                //    if(index!=v){
                //         list.push($(arrColumn[v]).height((max)+"px"));
                //     }
                // }
            },
            start:function (ui) {
                console.log("start");
              //  console.log(ui.target);
            }
        });
    },
    start: function(e,ui) {
        $(this).draggable("option", "cursorAt", {
            left: 0,
            top: 0
        });
        $(this).attr('data-id',id());
    }
});
$(".sidebar-nav .box-pluign").draggable({
    connectToSortable: ".column",
    helper: "clone",
    handle: ".drag",
    drag: function(e,ui) {
        ui.helper.width(300);
    },
    cursorAt: {
        top: 0,
        left: 0
    },
    stop: function(e,ui) {
        ui.helper.attr("data-id",id());
        ui.helper.removeAttr("style");
        if(ui.helper.parent().length ==0){
            // layout.formSettingWidget($(this).attr('data-id'),function(data,self){
            //     if(data.opt.title.length)
            //         self.find(".view >.plugin").html(data.opt.title);
            //     $.post($("#UrlSaveWidget").attr("data-url"),{act:'saveWidget',data:data},function(data){
            //
            //     });
            // });
        }
    },
    start: function(e,ui) {
        $(this).draggable("option", "cursorAt", {
            left: 0,
            top: 0
        });
        $(this).attr('data-id',id());
    }
});
demo.delegate(".configuration", "click", function(e) {
    e.preventDefault();
    console.log(1);
    var self = $(this).closest('.tool').parent();
    if(self.hasClass('box-pluign')){
        // layout.formSettingWidget(self.attr('data-id'),function(data,self){
        //     if(!data.opt.title.push){
        //         if(data.opt.title.length)
        //             self.find(".view >.plugin").html(data.opt.title);
        //
        //         $.post($("#UrlSaveWidget").attr("data-url"),{act:'saveWidget',data:data},function(data){
        //
        //         });
        //     }else{
        //         alertify.error("Đã có lỗi xảy ra");
        //         location.reload();
        //     }
        // });
    }else{
        // layout.formSettingGrid(self.attr('data-id'));
    }
});
demo.delegate(".status", "click", function(e) {
    var classOn = 'fa-check-square';
    var classOff = 'fa-square';
    e.preventDefault();
    var self = $(this).closest('.tool').parent();
    var i = $(this).find('i');
    var status = !i.hasClass(classOn);
    // layout.updateStatus(self.attr('data-id'),status,function(data,self){
    //     if(!data.opt.title.push){
    //         $.post($("#UrlSaveWidget").attr("data-url"),{act:'saveWidget',data:data},function(data){
    //             if(status){
    //                 i.removeClass(classOff).addClass(classOn);
    //
    //             }else{
    //                 i.removeClass(classOn).addClass(classOff);
    //             }
    //             alertify.success("Thành công ");
    //         });
    //     }else{
    //         alertify.error("Đã có lỗi xảy ra");
    //     }
    // });
});
demo.delegate(".remove", "click", function(e) {
    var classOn = 'fa-check-square';
    var classOff = 'fa-square';
    e.preventDefault();
    var parent = $(this).parent().parent().parent();
    console.log(parent);
    $(this).parent().parent().remove();
    //resetColumn( $(ui.target).parent());
});
var DataLayout = [];
var _parseJSON = function(json){
    try{
        var data = $.parseJSON(json);
        return data;
    }catch(e) {
        return {};
    }
}
function getOption(parent){
    return _parseJSON(parent.children('.option').find('.value textarea').html());
}
function setOption(parent,Object){
    parent.children('.option').find('.value textarea').html(JSON.stringify(Object));
}
var saveLayout = function(element){
    var data,
        widget= [],
        depth = 0;
    var step  = function(level, depth,trcms){
        var array = [],
            items = typeof trcms =='undefined'?level.children('.grid'):level;
        $.each(items,function()
        {
            var trcms   = $(this),
                item={};
            var option = $.extend({},getOption(trcms));
            item.row ={};
            item.row.option = option;
            var div_columns = trcms.children('.view').children('.row').children('.column');
            var _option_column = [];
            var place = [];
            div_columns.each(function(){
                var _option_plugins =[];
                if($(this).attr('place')){
                    place.push($(this).attr('place'));
                }else{
                    place.push(id());
                }
                var div_columns_plugin = $(this).children('div');
                div_columns_plugin.each(function(){
                    if($(this).hasClass('grid')){
                        var arr = [];
                        arr.push($(this));
                        var _option_plugin = step(arr, depth + 1,1);
                        _option_plugins.push(_option_plugin);
                    }else{
                        var _option_plugin = $.extend({},_parseJSON($(this).children('.option').find('.value textarea').html()));
                        widget.push(_option_plugin);
                        _option_plugins.push(widget.length-1);
                    }
                });
                _option_column.push(_option_plugins);
            });
            if(_option_column.length){
                item.row.view =_option_column;
            }
            item.row.option.stg.place = place;
            array.push(item);
        });
        return array;
    }

    data = step($(element), depth);
    return {data:data,widget:widget};
}
$("#saveLayout").click(function () {
    DataLayout = [];
    var grids = $("#layout_demo>.grid");
    var layout = saveLayout("#layout_demo");

    $.ajax({
        type:'POST',
        url:$(this).attr('url'),
        data:{
            layout:layout,
            name:"Home",
            theme:"zoe",
            id:$("#id").val()
        },
        success:function(data){
            var json = JSON.parse(data);
            if(json.hasOwnProperty('id')){
                $("#id").val(json.id);
            }
        }
    });
});