$('#check-all').on('ifChecked', function (event) {
    $('input[name="post\[\]"]').iCheck('check');
    // $('#bulk-action-container').show();
});

$('#check-all').on('ifUnchecked', function (event) {
    $('input[name="post\[\]"]').iCheck('uncheck');
    //  $('#bulk-action-container').hide();
});

function notice() {

}

function ajax(url, success, data, type = "POST") {
    $.ajax({
        url: url,
        type: type,
        data: data,
        success: success,
        error: function (xhr, error) {
            if (xhr.status === 401) {
                location.reload();
            }
        }
    });
}

$.notify.addStyle('htmlContent', {
    html: "<div><div data-notify-html/></div>",
    classes: {
        base: {
            "white-space": "nowrap",
            "background-color": "lightblue",
            "padding": "5px"
        },
        superblue: {
            "color": "white",
            "background-color": "blue"
        },
        error: {
            'color': "#B94A48",
            'background-color': "#F2DEDE",
            'border-color': '#EED3D7',
        }
    }
});
var _parseJSON = function (json) {
    try {
        var data = $.parseJSON(json);
        return data;
    } catch (e) {
        return {};
    }
}
function Click() {
    this.handlers = [];  // observers
}
Click.prototype = {
    subscribe: function(fn) {
        this.handlers.push(fn);
    },
    unsubscribe: function(fn) {
        this.handlers = this.handlers.filter(
            function(item) {
                if (item !== fn) {
                    return item;
                }
            }
        );
    },
    fire: function(o, thisObj) {
        var scope = thisObj || window;
        var arr = [];

        this.handlers.forEach(function(item) {
             var resulted = item.call(scope, o);
             if(resulted instanceof Promise){
                 arr.push(resulted);
             }
        });

        console.log(arr);

        Promise.all(arr).then(function (t) {
            console.log(t);
            thisObj();
        }).catch(function (t) {
            console.log(t);
        });
    }
};
function wordCount(val) {
    var wom = val.match(/\S+/g);
    return {
        charactersNoSpaces: val.replace(/\s+/g, '').length,
        characters: val.length,
        words: wom ? wom.length : 0,
        lines: val.split(/\r*\n/).length
    };
}
$(document).ready(function () {
    function eventWord(){
        let wc = wordCount($(this).val());
        console.log(wc);
        let max = $(this).attr('wordCount-max');
        let charcounter = $(this).attr('wordCount-charcounter');
        let template = $(this).attr('wordCount-template');
        let val = $(this).val();
        max = max?max:-1;
        console.log(charcounter);
        if(charcounter){
            let count = max?(max-wc.characters):wc.characters;

            count = count<0?0:count;
            let dom = $(this).parent().find(charcounter);

            dom.show();
            if(template){
                dom.text(template.replace('[NUMBER]',count));
            }else{
                dom.text(count);
            }

        }
        if(max !== -1){
            if(wc.characters > max){
                $(this).val(val.slice(0, -1));
            }
        }
    }

   // $(".wordCount").each(function () {
   //
   //     $(this).focusin(eventWord);
   //     $(this).keypress(eventWord);
   //     $(this).focusout(function () {
   //         let charcounter = $(this).attr('wordCount-charcounter');
   //         if(charcounter){
   //             $(this).parent().find(charcounter).hide();
   //         }
   //     });
   // });
   $(document).on('focusin','.wordCount',eventWord);
   $(document).on('keypress','.wordCount',eventWord);
   $(document).on('focusout','.wordCount',function () {
       let charcounter = $(this).attr('wordCount-charcounter');
       if(charcounter){
           $(this).parent().find(charcounter).hide();
       }
   });
});

