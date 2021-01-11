@section('content')


        <section class="section" id="section_1228298135">
            <div class="bg section-bg fill bg-fill bg-loaded">

            </div>

            <div class="section-content relative">

                <div class="row" id="row-1885844881">

                    <div id="col-2125194203" class="col small-12 large-12">
                        <div class="col-inner text-center">


                            <h2>MISS TERRY COMPANY LIMITED</h2>
                            <p style="text-align: center;">Add 1: Floor 10, 381 Doi Can Str, Hanoi |&nbsp; Add 2: Floor 11, 24 Hoang Quoc Viet Str, Hanoi</p>
                            <p style="text-align: center;">Website: www.missterry.vn – Tel: (+84) 088-883-7755 –&nbsp; Email: info@missterry.vn</p>
                        </div>

                        <style>
                            #col-2125194203 > .col-inner {
                                padding: 29px 0px 0px 0px;
                            }
                        </style>
                    </div>
                    <div id="col-1685446362" class="col medium-6 small-12 large-6">
                        <div class="col-inner text-center">
                            <p><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d238327.06565857466!2d105.813481!3d21.038271!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x62a40c55ed83880!2sMiss%20Terry%20-%20Escape%20Rooms!5e0!3m2!1svi!2sus!4v1608030769603!5m2!1svi!2sus" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></p>
                        </div>
                    </div>
                    <div id="col-1329566085" class="col medium-6 small-12 large-6">
                        <div class="col-inner text-center">
                            <div role="form" class="wpcf7" lang="vi" dir="ltr">
                                <div class="screen-reader-response"><p role="status" aria-live="polite" aria-atomic="true"></p>
                                    <ul></ul>
                                </div>
                                <form action="{!! route('frontend:widget:Subscribe') !!}" method="post" class="wpcf7-form init">
                                    <p><span class="wpcf7-form-control-wrap your-name">
                                            <input type="text" name="your-name" value="" size="40" class="wpcf7-form-control" placeholder="{!! z_language('Email . . .') !!}"></span>
                                        <input type="submit" value="Subscribe" class="wpcf7-form-control wpcf7-submit">
                                        <span class="ajax-loader"></span></p>
                                    <p class="notifications"></p>
                                    <div class="wpcf7-response-output" aria-hidden="true"></div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <style>
                #section_1228298135 {
                    padding-top: 30px;
                    padding-bottom: 30px;
                }
            </style>
        </section>
@endsection