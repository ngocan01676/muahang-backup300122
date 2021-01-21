<script src="https://cdnjs.cloudflare.com/ajax/libs/mobile-detect/1.4.3/mobile-detect.min.js"></script>
<script type='text/javascript' src='{!! asset('theme/missterry/plugin/contact-form-7/includes/js/scripts.js?ver=5.3.1') !!}' id='contact-form-7-js'></script>
<script type='text/javascript' src='{!! asset('theme/missterry/js/hoverIntent.min.js?ver=1.8.1') !!}' id='hoverIntent-js'></script>
<script type='text/javascript' id='flatsome-js-js-extra'>
    /* <![CDATA[ */
    var flatsomeVars = {"ajaxurl":"","rtl":"","sticky_height":"68","lightbox":{"close_markup":"<button title=\"%title%\" type=\"button\" class=\"mfp-close\"><svg xmlns=\"http:\/\/www.w3.org\/2000\/svg\" width=\"28\" height=\"28\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-x\"><line x1=\"18\" y1=\"6\" x2=\"6\" y2=\"18\"><\/line><line x1=\"6\" y1=\"6\" x2=\"18\" y2=\"18\"><\/line><\/svg><\/button>","close_btn_inside":false},"user":{"can_edit_pages":false},"i18n":{"mainMenu":"Main Menu"},"options":{"cookie_notice_version":"1"}};
    /* ]]> */
</script>
<script type='text/javascript' src='{!! asset('theme/missterry/flatsome/assets/js/flatsome.js?ver=3.13.0') !!}' id='flatsome-js-js'></script>
{{--<script type='text/javascript' src='https://demo.missterry.vn/wp-includes/js/wp-embed.min.js?ver=5.6' id='wp-embed-js'></script>--}}

<script src="{!! asset('theme/missterry/plugin/Modal-Popup-Plugin-jQuery-Mobilepopup/plugins/highlightjs/highlight.min.js') !!}"></script>
<script src="{!! asset('theme/missterry/plugin/Modal-Popup-Plugin-jQuery-Mobilepopup/src/mobilepopup.min.js') !!}"></script>

<script src="https://www.google.com/recaptcha/api.js?render=6LeSNSAaAAAAAPnoqpze0F2jMRW9CUMCP8ypmUeg"></script>
<script src="{!! asset('/theme/missterry/js/main.js') !!}"></script>
<script>
    function formatMoney(amount, decimalCount = 0, decimal = ".", thousands = ",") {
        try {
            decimalCount = Math.abs(decimalCount);
            decimalCount = isNaN(decimalCount) ? 0 : decimalCount;

            const negativeSign = amount < 0 ? "-" : "";

            let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
            let j = (i.length > 3) ? i.length % 3 : 0;

            return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
        } catch (e) {
            console.log(e)
        }
    };
    jQuery(document).ready(function () {
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN':jQuery('meta[name="csrf-token"]').attr('content'),
            },
            error: function (jqXHR, exception) {
                // if (jqXHR.status === 0) {
                //     alert('Not connect.\n Verify Network.');
                // } else if (jqXHR.status == 404) {
                //     alert('Requested page not found. [404]');
                // } else if (jqXHR.status == 500) {
                //     alert('Internal Server Error [500].');
                // } else if (exception === 'parsererror') {
                //     alert('Requested JSON parse failed.');
                // } else if (exception === 'timeout') {
                //     alert('Time out error.');
                // } else if (exception === 'abort') {
                //     alert('Ajax request aborted.');
                // } else {
                //     alert('Uncaught Error.\n' + jqXHR.responseText);
                // }
            }
        });

    });
</script>
<script type="text/javascript">
    var isMobile = false;var isTablet = false;
    $.cookie('referer', '{!! url('/') !!}');
    $.cookie('agent', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36');
    function googleTranslateElementInit() {
        new google.translate.TranslateElement(
            {
                pageLanguage: 'en',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                autoDisplay: false
            }, 'google_translate_element');
    }
</script>
<script type="text/javascript" async src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

@stack('scriptsTop')
@stack('scripts')
@section('extra-script')
@show
<script>
    (function () {
        var md = new MobileDetect(window.navigator.userAgent);
        var platform;
        function elementInViewport(el) {
            var rect = el.getBoundingClientRect();
            return (
                rect.top    >= 0
                && rect.left   >= 0
                && rect.top <= (window.innerHeight || document.documentElement.clientHeight)
            )
        }
        if (md.tablet()) {
            console.log('tablet');
            platform = 'tablet';
        } else if (md.mobile()) {
            console.log('mobile');
            platform = 'mobile';
        } else {
            console.log('pc');
            platform = 'pc';
        }
        let images = [...document.querySelectorAll('[lazy=load]')];
        let images_scroll = [...document.querySelectorAll('[lazy=scroll]')];
        const interactSettings = {
            root: document.querySelector('body'),
            rootMargin: '0px 0px 200px 0px'
        };
        var GetNameFile = function (str) {
            return str.split('\\').pop().split('/').pop();
        }
        function loadImage(image,cb,i) {
            let src = "";
            let _platform = platform;
            if (_platform === 'mobile') {
                if (image.dataset.hasOwnProperty('mobile')) {
                    src = image.dataset.mobile;
                } else {
                    _platform = 'tablet';
                }
            }
            if (_platform === 'tablet') {
                if (image.dataset.hasOwnProperty('tablet')) {
                    src = image.dataset.tablet;
                } else {
                    _platform = 'pc';
                }
            }
            if (_platform === 'pc') {
                src = image.dataset.src
            }
            image.removeAttribute('lazy');
            image.src = src;
            console.log( image.src );
            image.onload = () => {
                image.classList.add('loaded');
                image.removeAttribute('width');
                image.removeAttribute('height');

                if(cb) cb(i);
            };
        }
        function onIntersection(imageEntites) {
            imageEntites.forEach(image => {
                if (image.isIntersecting) {
                    observer.unobserve(image.target);
                    loadImage( image.target,function () {

                    },0);
                }
            });
        }
        let observer = new IntersectionObserver(onIntersection, interactSettings);
        images.forEach(image => observer.observe(image));
        function processScroll(){

            for (let i = 0; i < images_scroll.length; i++) {
                if(!images_scroll[i].classList.contains('loaded')){
                    if(elementInViewport(images_scroll[i]))  {
                        loadImage(images_scroll[i],function (i) {
                        },i);
                    }
                }
            }
            for (let i = 0; i < images_scroll.length; i++) {
                if(images_scroll[i].classList.contains('loaded')){
                    images_scroll.splice(i, 1);
                }
            }
            if(images_scroll.length === 0){
                removeEventListener('scroll',processScroll);
            }
        }
        processScroll();
        addEventListener('scroll',processScroll);
    });
    (function () {
        var md = new MobileDetect(window.navigator.userAgent);
        var platform;
        if (md.tablet()) {
            console.log('tablet');
            platform = 'tablet';
        } else if (md.mobile()) {
            console.log('mobile');
            platform = 'mobile';
        } else {
            console.log('pc');
            platform = 'pc';
        }
        document.addEventListener("DOMContentLoaded", function() {
            let lazyImages = [].slice.call(document.querySelectorAll('[lazyload=on]'));
            let active = false;
            function CheckLoadImg(lazyImage) {
                if(lazyImage.getAttribute("lazytype") === "load") return true;
                return (
                    lazyImage.getBoundingClientRect().top <= window.innerHeight &&
                    lazyImage.getBoundingClientRect().bottom >= 0) &&
                    getComputedStyle(lazyImage).display !== "none";
            }
            const lazyLoad = function() {
                if (active === false) {
                    active = true;
                    setTimeout(function() {
                        lazyImages.forEach(function(lazyImage) {
                            if (CheckLoadImg(lazyImage)) {
                                let src = "";
                                let _platform = platform;
                                if (_platform === 'mobile') {
                                    if (lazyImage.dataset.hasOwnProperty('mobile')) {
                                        src = lazyImage.dataset.mobile;
                                    } else {
                                        _platform = 'tablet';
                                    }
                                }
                                if (_platform === 'tablet') {
                                    if (lazyImage.dataset.hasOwnProperty('tablet')) {
                                        src = lazyImage.dataset.tablet;
                                    } else {
                                        _platform = 'pc';
                                    }
                                }
                                if (_platform === 'pc') {
                                    src = lazyImage.dataset.src
                                }
                                lazyImage.src =src;

                                if(lazyImage.dataset.hasOwnProperty('lazyImage.dataset')){
                                    lazyImage.srcset = lazyImage.dataset.srcset;
                                }

                                lazyImage.classList.add('loaded');
                                lazyImages = lazyImages.filter(function(image) {
                                    return image !== lazyImage;
                                });
                                lazyImage.onload = () => {
                                    lazyImage.classList.remove('loaded');
                                    lazyImage.removeAttribute('width');
                                    lazyImage.removeAttribute('height');
                                };
                                if (lazyImages.length === 0) {
                                    document.removeEventListener("scroll", lazyLoad);
                                    window.removeEventListener("resize", lazyLoad);
                                    window.removeEventListener("orientationchange", lazyLoad);
                                }
                            }
                        });
                        active = false;
                    }, 1);
                }
            };
            lazyLoad();
            document.addEventListener("scroll", lazyLoad);
            window.addEventListener("resize", lazyLoad);
            window.addEventListener("orientationchange", lazyLoad);
        });
    })();
    // $(function () {
    //    $(document).ready(function () {
    //       $(".edit-text").each(function () {
    //           $(this).hover(
    //               function() {
    //                   $(this).html($('<textarea  style="z-index: 999999;color:#000;width:'+($(this).width())+'px;height: '+($(this).height()*1.8)+'px;">'+($(this).text())+'</textarea>'));
    //               }, function() {
    //                   var val = $( this ).find("textarea").val();
    //                   $( this ).html(val);
    //               }
    //           );
    //       });
    //    });
    // });
</script>
</body>
</html>