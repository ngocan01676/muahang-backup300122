<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')</script>
<script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mobile-detect/1.4.3/mobile-detect.min.js"></script>

<script src="{{ asset('theme/zoe/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('theme/zoe/js/jquery.fitvids.js') }}"></script>
<script src="{{ asset('theme/zoe/js/jquery.sequence-min.js') }}"></script>
<script src="{{ asset('theme/zoe/js/jquery.bxslider.js') }}"></script>
<script src="{{ asset('theme/zoe/js/main-menu.js') }}"></script>
<script src="{{ asset('theme/zoe/js/template.js') }}"></script>

<script>
    var md = new MobileDetect(window.navigator.userAgent);
    var platform;
    if(md.tablet()){
        console.log('tablet');
        platform = 'tablet';
    }else if(md.mobile()){
        console.log('mobile');
        platform = 'mobile';
    }else{
        console.log('pc');
        platform = 'pc';
    }
    let images = [...document.querySelectorAll('[lazy-load=true]')]
    const interactSettings = {
        root: document.querySelector('body'),
        rootMargin: '0px 0px 200px 0px'
    };
    function onIntersection(imageEntites) {
        imageEntites.forEach(image => {

            if (image.isIntersecting) {
                observer.unobserve(image.target);
                console.log(platform);
                console.log(image.target.dataset);
                var src;
                if(platform == "tablet"){
                    src = image.target.dataset.wtablet;
                }else if(platform == "mobile"){
                    src = image.target.dataset.wmobile;
                }else{
                    src = image.target.dataset.src;
                }
               image.target.src = src;
                image.target.onload = () => {
                    image.target.classList.add('loaded');
                    image.target.removeAttribute('lazy-load');
                    image.target.removeAttribute('width');
                    image.target.removeAttribute('height');
                };
            }
        })
    }
    let observer = new IntersectionObserver(onIntersection, interactSettings);
    images.forEach(image => observer.observe(image))
</script>