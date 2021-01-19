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

                         let oke =  jQuery("#login-form-popup .account-register-inner .text-oke");
                         console.log(oke);
                         if(datas.hasOwnProperty('oke')){

                             oke.show();
                             jQuery(".account-register-inner .text-oke").html(datas.oke);
                         }
                        jQuery("#reg_email").val("");
                        jQuery("#reg_password").val("");
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
    jQuery('#page-login [name="registerForm"]').click(function (e) {
        e.preventDefault();
        let form = jQuery(this).closest('.register');
        let urlCurrent = form.attr('data-urlCurrent');

        let data =  {
            email:form.find('[name=email]').val(),
            password:form.find('[name=password]').val(),
        };
        let container =  form.closest('.account-container');

        jQuery.ajax({
            url:form.attr('action'),
            type:"POST",
            data:data,
            success:function (datas) {
                if(datas.hasOwnProperty('success')){
                    form.find('.error').empty();
                    if(datas.success){
                        container.find('.account-login-inner [name="email"]').val(data.email);
                        let oke =  container.find(".account-register-inner .text-oke");
                        if(datas.hasOwnProperty('oke')){
                            oke.show();
                            container.find(".account-register-inner .text-oke").html(datas.oke);
                        }
                        form.find('[name=email]').val("");
                        form.find('[name=password]').val("");
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

    jQuery('[value="Subscribe"]').click(function (e) {
        e.preventDefault();
        let form = jQuery(this).closest('.wpcf7-form');
        jQuery.ajax({
            url:form.attr('action'),
            type:"POST",
            data:{
               'email':form.find('[name="your-name"]').val()
            },
            success:function (datas) {
                console.log(datas);
                let notifications = form.find('.notifications');
                notifications.removeClass('text-error');
                notifications.removeClass('text-oke');
                if(datas.hasOwnProperty('errors') && datas.errors.hasOwnProperty('email')){
                    notifications.addClass('text-error').html(datas.errors.email[0]);
                }else if(datas.hasOwnProperty('oke')){
                    notifications.addClass('text-oke').html(datas.oke);
                    form.find('[name="your-name"]').val("");
                }
            }
        });
    });
});