@section('content-header')
    <h1>
        &starf; {!! @z_language(["Manager Plugins"]) !!}
        <small>it all starts here</small>
    </h1>
@endsection
@section('content')
    @breadcrumb()@endbreadcrumb
    @foreach($lists as $module=>$list)
        <div class="item col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <i class="fa fa-bookmark" @if(isset($lists_install[$module])) style="color: green" @endif></i><h3 class="box-title">{!! $list['name'] !!}</h3>
                    <div class="pull-right">v<strong>{!! $list['version'] !!}</strong></div>
                </div>
                <div class="box-body">
                    <div class="icon col-lg-3">
                        <div style="position: relative">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAACWCAMAAAAL34HQAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAuIwAALiMBeKU/dgAAAEtQTFRFMjIyPz8/srKyZWVlf39/mJiYWVlZ8vLy////TExMpqamzMzM2dnZ5eXlv7+/fn5+2NjYi4uL8/PzcnJymZmZ5ubms7OzjIyMpaWlBQNpXQAAA2JJREFUeJztl8uS4yAMRUNM22Acd4b40f//paMXdhZ2V6XCZDb3bOIEAkK6EvLlAgAAAAAAAAAAAAAAAAAAAAAAAAAAAPgc7tr8Muq/3McseabtQne+c6RR/0FrNvoQQn86mmh0qO4vfxu/7dGl+5+j9WOmnePJ/x80ltvaVrEnwk2WdXd+/jqYNP3irpnGHrWt8kEQbSzymA5mOXLX7XyBpbZVjVqV+XnV58OcY3cdB4qclWsLy3Uhj3bcNswsk/l4IrlrOhrgv6yVrbqMJNak2nD33PIeh5tLgI+iy2l4fJA3eLCossawpyD1p6HiqUfiaosuK0Ih7GXhkUVGbhpMZUdzadrBz/0/cFbPYl31vMNAPzwl1XTvdr+t6cqlS5/Djd1jg7k4y49dqlO8omhqlEq5cgI2m3ylgt0swRxP6To1y6sSKaZX/SbudSzQ0FWxK4mIM4fBdeylqZQHugP5QglJDGOr8prELLr/OOQU/jDoUF9OkfNxbXmRRu4TJ4Hr5WoZTT/uxoWiIal5M5YulyR+SXoLTRr5aHfSwBns5rN0eYlZdMSB81ElNZt+e7t7E6dBYyV20MRQ99jMVX2mRsYq4vd6UFZ8u+g9bDcP5+bM4ROzkglOKhr706nA2JGDDMVgYycl7yXUWXJSc1ZjxXQpEpvp46H1Q0MeLVXNWRbDRb55cdy7rNapkDPSoqIws1jOYqbjKTSeeWLPu067sth+rzEU1/kqLRftrRWKzbJzrpr7TSn1npwQy3U0c9RmibKozVJklVqR3TX0Ne7rtXQKeWtrSn0wHbPFXgqTMxPFRq95mtRUtn/iopZq1AZe0ZQgvYx7Nmsy/zwsbJakXruFeBmXQdMxai2lKUn04N5uBv3WjTw1ftZTefVe7LK6gjdbZc7E2p4GN6jhTSi/yjHc+5dP2lrzsPdLVk2jmNXepD+fxJVtJ7Ing5Onn5fNLP5o7dv8trPcfu8/9aPJinwfUvsTBjl7ZPvbzl4hBtUh3YBWia3X7h7f1wpvGc3eKYS9YSlmXfochtJE+Xz/6eaypR/VJY28b8x2oInypkYiurRVZFqyOK5Nm4VPL19xSuvJlm0u+ddU6ubjvk6zayK+uHz8Py/5AAAAAAAAAAAAAAAAAAAAAAAAAAAAACD8BSzEJ+/eaD9uAAAAAElFTkSuQmCC"
                                 class="img-thumbnail img-responsive img-rounded"  alt="Responsive Image"/>
                        </div>
                    </div>
                    <div class="info col-lg-9" style="position: relative">
                        <div class="description">
                            {!! $list['description'] !!}
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    <div class="step col-lg-5">
                        <div class="author"><i>{!! $list['author'] !!}</i></div>
                    </div>
                    <div class="actions col-lg-7 text-right">
                        <div class="app-uninstall" @if(!isset($lists_install[$module])) style="display:none" @endif>
                            <a href="javascript:void(0);" class="btn btn-xs btn-danger btnAction"
                               data-act="uninstall"
                               data-module="{!! $module !!}">
                                <i class="fa fa-remove"></i> {!! z_language('UnInstall') !!}
                            </a>
                        </div>
                        <div class="app-install" @if(isset($lists_install[$module])) style="display:none" @endif>
                            <a href="javascript:void(0);" class="btn bg-orange btn-xs  btnAction" data-act="remove" data-module="{!! $module !!}"> <i class="fa fa-remove"></i>  {!! z_language('Remove') !!} </a>
                            <a href="javascript:void(0);" class="btn bg-navy btn-xs btnAction" data-act="install" data-module="{!! $module !!}"> <i class="fa fa-cogs"></i> {!! z_language('Install') !!} </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@push('links')
    <style>
        .item .box{
            border-top: 3px solid #0c0c0c;
            border-radius:0px;
        }
        .item .box-title {
            color: #001f3f;
            font-weight: bold;
        }
        .item .icon{
            padding: 0;
        }
        .item .actions{
            padding: 0;
        }
        .actions .btn{
            margin-left: 5px;
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function () {
            $(".btnAction").click(function () {
                var self = this;
                if($(self).attr('process') === 1){
                    return;
                }
                $(self).attr('process',1);
                var box = $(this).closest('.box');
                box.find('.icon').loading({circles: 3, overlay: true, width: "5em", top: "13%", left: "11%"});
                var data = $(this).data();
                var status = true;
                ajax("{!! route('backend:module:ajax') !!}",function (json) {
                    box.find('.icon').loading({destroy: true});
                    console.log(json);
                    if(json.status === true){
                        if((data.act === "uninstall") === status){
                            box.find('.app-install').fadeIn(3000);
                            box.find('.app-uninstall').hide();
                        }else{
                            box.find('.app-install').hide();
                            box.find('.app-uninstall').fadeIn(3000);
                        }
                    }else{
                        $.growl.error({ message:json.status });
                    }
                    $(self).attr('process',0);
                },data);
            });

        });
    </script>
@endpush