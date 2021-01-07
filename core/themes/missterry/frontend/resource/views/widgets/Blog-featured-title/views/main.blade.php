<div class="page-title blog-featured-title featured-title no-overflow">
    <div class="page-title-bg fill">
        <div class="title-bg fill bg-fill bg-top parallax-active"
             style="
              @if(isset($_dataGlobal['Blog-featured-background']))
                     background-image: url({!! asset($_dataGlobal['Blog-featured-background']) !!});
              @else
                     background-image: url({!! asset("theme/missterry/images/bg.jpg") !!});
              @endif
              height: 434.778px;
              transform: translate3d(0px, -0.11px, 0px); backface-visibility: hidden;" data-parallax-fade="true" data-parallax="-2" data-parallax-background="" data-parallax-container=".page-title"></div>
        <div class="title-overlay fill" style="background-color: rgba(0,0,0,.5)"></div>
    </div>

    <div class="page-title-inner container  flex-row  dark is-large" style="min-height: 300px">
        <div class="flex-col flex-center text-center">
            @if(isset($_dataGlobal['Blog-featured-entry-category']))
            <h6 class="entry-category is-xsmall">
                <a href="https://demo.missterry.vn/category/frequently-asked-questions/" rel="category tag">Frequently asked questions</a>,
                <a href="https://demo.missterry.vn/category/offer/" rel="category tag">Offer</a>
            </h6>
            @endif
            <h1 class="entry-title">{!! isset($_dataGlobal['Blog-featured-title'])?$_dataGlobal['Blog-featured-title']:"" !!}</h1>
            <div class="entry-divider is-divider small"></div>

        </div>
    </div>
</div>