
@if(isset($_dataGlobal['Blog-featured-style']))
    @if($_dataGlobal['Blog-featured-style'] == 1)
        <div id="page-header-441590599" class="page-header-wrapper">
            <div class="page-title dark featured-title">

                <div class="page-title-bg">
                    <div class="title-bg fill bg-fill parallax-active" data-parallax-container=".page-title" data-parallax-background="" data-parallax="-">
                    </div>
                    <div class="title-overlay fill"></div>
                </div>

                <div class="page-title-inner container align-center text-center flex-row-col medium-flex-wrap">
                    <div class="title-wrapper is-larger flex-col">
                        <h1 class="entry-title mb-0">
                            {!! isset($_dataGlobal['Blog-featured-title'])?$_dataGlobal['Blog-featured-title']:"" !!}          </h1>
                    </div>
                    <div class="title-content flex-col">
                        <div class="title-breadcrumbs pb-half pt-half"></div>      </div>
                </div>
                <style>
                    #page-header-441590599 .page-title-inner {
                        min-height: 268px;
                    }
                    #page-header-441590599 .title-bg {
                        @if(isset($_dataGlobal['Blog-featured-background']))
                        background-image: url({!! asset($_dataGlobal['Blog-featured-background']) !!});
                                                @else
                        background-image: url({!! asset("theme/missterry/images/bg.jpg") !!});
                    @endif
}
                    #page-header-441590599 {
                        background-color: rgb(0,0,0);
                    }
                </style>
            </div>
        </div>
    @elseif($_dataGlobal['Blog-featured-style'] == 2)
        <div id="page-header-1804778628" class="page-header-wrapper">
            <div class="page-title dark featured-title">

                <div class="page-title-bg">
                    <div class="title-bg fill bg-fill parallax-active" data-parallax-container=".page-title" data-parallax-background="" data-parallax="-">
                    </div>
                    <div class="title-overlay fill"></div>
                </div>

                <div class="page-title-inner container align-center text-center flex-row-col medium-flex-wrap">
                    <div class="title-wrapper is-larger flex-col">
                        <h1 class="entry-title mb-0">
                            {!! isset($_dataGlobal['Blog-featured-title'])?$_dataGlobal['Blog-featured-title']:"" !!}             </h1>
                    </div>
                    <div class="title-content flex-col">
                        <div class="title-breadcrumbs pb-half pt-half"></div>      </div>
                </div>


                <style>
                    #page-header-1804778628 .page-title-inner {
                        min-height: 268px;
                    }
                    #page-header-1804778628 .title-bg {
                        @if(isset($_dataGlobal['Blog-featured-background']))
background-image: url({!! asset($_dataGlobal['Blog-featured-background']) !!});
                        @else
background-image: url({!! asset("theme/missterry/images/bg.jpg") !!});
                    @endif
                    }
                    #page-header-1804778628 {
                        background-color: rgb(0,0,0);
                    }
                </style>
            </div>
        </div>
    @endif
@else
    <div id="page-header-441590599" class="page-title blog-featured-title featured-title no-overflow">
        <div class="page-title-bg fill">
            <div class="title-bg fill bg-fill bg-top parallax-active"
                 style="
                 @if(isset($_dataGlobal['Blog-featured-background']))
                         background-image: url({!! asset($_dataGlobal['Blog-featured-background']) !!});
                 @else
                         background-image: url({!! asset("theme/missterry/images/bg.jpg") !!});
                 @endif
                 @if(isset($_dataGlobal['Blog-featured-height']))
                         height: {!! asset($_dataGlobal['Blog-featured-background']) !!};
                 @else
                         height: 434.778px;
                 @endif

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
@endif

