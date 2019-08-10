<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <td>
                {{var_dump($data)}}
                <div class="clearfix">
                    <div class="row">
                        <div class="col-xs-9">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                @php $langcurent = "vi" @endphp
                                @foreach($data['lang'] as $lang)
                                    @if($langcurent == $lang)
                                        <div class="tab-pane active" id="home-{!! $lang !!}">{{$lang}} a</div>
                                    @else
                                        <div class="tab-pane" id="home-{!! $lang !!}">{{$lang}} b</div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="col-xs-3"> <!-- required for floating -->
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tabs-right sideways">
                                @foreach($data['lang'] as $lang)
                                    @if($langcurent == $lang)
                                        <li class="active"><a href="#home-{!! $lang !!}home-{!! $lang !!}"
                                                              data-toggle="tab">{{$lang}}</a></li>
                                    @else
                                        <li><a href="#home-{!! $lang !!}" data-toggle="tab">{{$lang}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <style>
                        .tabs-left, .tabs-right {
                            border-bottom: none;
                            padding-top: 2px;
                        }

                        .tabs-left {
                            border-right: 1px solid #ddd;
                        }

                        .tabs-right {
                            border-left: 1px solid #ddd;
                        }

                        .tabs-left > li, .tabs-right > li {
                            float: none;
                            margin-bottom: 2px;
                        }

                        .tabs-left > li {
                            margin-right: -1px;
                        }

                        .tabs-right > li {
                            margin-left: -1px;
                        }

                        .tabs-left > li.active > a,
                        .tabs-left > li.active > a:hover,
                        .tabs-left > li.active > a:focus {
                            border-bottom-color: #ddd;
                            border-right-color: transparent;
                        }

                        .tabs-right > li.active > a,
                        .tabs-right > li.active > a:hover,
                        .tabs-right > li.active > a:focus {
                            border-bottom: 1px solid #ddd;
                            border-left-color: transparent;
                        }

                        .tabs-left > li > a {
                            border-radius: 4px 0 0 4px;
                            margin-right: 0;
                            display: block;
                        }

                        .tabs-right > li > a {
                            border-radius: 0 4px 4px 0;
                            margin-right: 0;
                        }
                    </style>
                </div>
            </td>
        </tr>
    </table>
</div>
