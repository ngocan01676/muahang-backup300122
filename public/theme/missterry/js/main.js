jQuery(document).ready(function () {
    jQuery('[name="login"]').click(function (e) {
        e.preventDefault();
        let form = jQuery(this).closest('.login');
        console.log(form.attr('action'));
        let urlCurrent = form.attr('data-urlCurrent');
        jQuery.ajax({
            url:form.attr('action'),
            type:"POST",
            data:{
                email:jQuery("#email").val(),
                password:jQuery("#password").val(),
            },
            success:function (datas) {
                console.log(datas);
                if(datas.hasOwnProperty('success')){
                    form.find('.error').empty();

                    if(datas.success){
                        if(urlCurrent){
                            window.location.replace(urlCurrent);
                        }else{
                            window.location.replace(datas.uri);
                        }
                    }else if(datas.hasOwnProperty('errors')){
                        for(let index in datas.errors){
                            console.log(datas.errors[index]);
                            console.log(form.find('[name='+index+']'));
                            form.find('[name='+index+']').parent().find('.error').html(datas.errors[index][0]);
                        }
                    }

                }
            }
        });
    });
    jQuery('[name="register"]').click(function (e) {
        e.preventDefault();
        let form = jQuery(this).closest('.register');
        console.log(form.attr('action'));
        let urlCurrent = form.attr('data-urlCurrent');
        let data =  {
            email:jQuery("#reg_email").val(),
                password:jQuery("#reg_password").val(),
        };
        jQuery.ajax({
            url:form.attr('action'),
            type:"POST",
            data:{
                email:jQuery("#reg_email").val(),
                password:jQuery("#reg_password").val(),
            },
            success:function (datas) {
                console.log(datas);
                if(datas.hasOwnProperty('success')){
                    form.find('.error').empty();
                    if(datas.success){
                         jQuery('#email').val(data.email);
                    }else if(datas.hasOwnProperty('errors')){
                        for(let index in datas.errors){
                            console.log(datas.errors[index]);
                            console.log(form.find('[name='+index+']'));
                            form.find('[name='+index+']').parent().find('.error').html(datas.errors[index][0]);
                        }
                    }

                }
            }
        });
    });
});