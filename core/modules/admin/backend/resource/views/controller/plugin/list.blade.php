@section('content-header')
    <h1>
        &starf; {!! @z_language(["Manager Plugins"]) !!}
        <small>it all starts here</small>
    </h1>
@endsection
@section('content')
    @breadcrumb()@endbreadcrumb
    @foreach($lists as $plugin=>$list)
        <div class="item col-lg-4 col-sm-6 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <i class="fa fa-bookmark" @if(isset($lists_install[$list['name']])) style="color: green" @endif></i>
                    <h3 class="box-title">{!! $list['name'] !!}</h3>
                    <div class="pull-right">v<strong>{!! $list['version'] !!}</strong></div>
                </div>
                <div class="box-body">
                    <div class="icon col-lg-3">
                        <div style="position: relative">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAACWCAMAAAAL34HQAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAuIwAALiMBeKU/dgAAAEtQTFRFMjIypqamfn5+cnJy////5eXlZWVlPz8/8vLys7OzWVlZpaWlzMzM2NjYi4uLTExMmZmZ2dnZmJiY8/PzjIyMf39/v7+/5ubmsrKykB+XXAAAAwhJREFUeJztmNGCmyAQRaUSEZYUXEXz/19aZka0Nd3Y3eomD/c8JAtBuc5cBtyqAgAAAAAAAAAAAAAAAAAAAAAAAAAAr4z68WwFf6PW+tI8W8QdptVa2+dqcD/evL/oq/8ZSlfMqjrzTE1vF73yLp0h/9m7xxeemWLnF0U2xui14m6b28PjK4O+1KfJGkhQ39EnByfxFwXL/8OV6ixZptf9YOzqb0tTxaLyAeN+mv+DWmVjT3mK2e3RyzLcXYX+TFWMy8GJ1Sor5XZ4eEVG6XSuKjJ4X4rBlJPYfRysZolQzUPCeUWEclbMa7On3Bwsc9WeVCxKGv9bWJnQXk/TteYseD1SeuhTTG1Iacu1woy0XkepG07UjGXF1sfvoHPOTH0THb3WVJGoAtS8OXKEcuxy4Q8myJO05KyGhNJ3rsjXg1XRvW83T7PyfpN1TJWkliIxiVZWZSl2I+UuNxpajdyXyqVHYteth4oFtUvtakQ0BWtWEPhHK+WWfsuFhW/QH6zKkBy6sR9Cabs1WGQoIxnt2Ghkw17caFmyPNbOVvVpIk1vmuVh5xwOa7CsiKSC65YoRXmAKWdwjHLJoWTv/FEX5xzm7q7i5UBxme1PzST5LZ0px2l7iwPIdu23Mhsp/IlrBaeyky8rg0epINTp8opsJM+H4jfngCAzDzxVXVwjfkt6iWSSY0Zq1VrnDsRtzwpJ5hgph6FV4rCKM5rK8UfWHTWvVp7saMNbsdBKXOqBqjrl5vz0uXPoZ781Un5tKVZepB9I2G5yJIvmyNFSt45LAc2s9PvYuTmjTuzvy2kojx3c7onjM6i7894gHa6XTLmJJRjfR3YaW7vjIV7UyfbUHxqvYbsOKX7yrUbRm5a1b8t5x3CA47JWQkoHr0R1t4iS/mCo0RsPnXkMbO6i/9FROO6/djwB2n/OewP7Mq8ZLLd11ktgLie+rH4ZOpt2+8O+D05c3a7vt6/BcHkf6V8608mv0J+loWPzFPcHfjsvlT4AAAAAAAAAAAAAAAAAAAAAAAAAgNfgF3lnHa/qgc/3AAAAAElFTkSuQmCC"
                                 class="img-thumbnail img-responsive img-rounded" alt="Responsive Image"/>
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
                        <div class="app-uninstall" @if(!isset($lists_install[$plugin])) style="display:none" @endif>
                            <a href="javascript:void(0);" class="btn btn-xs btn-danger btnAction"
                               data-act="uninstall"
                               data-plugin="{!! $plugin !!}">
                                <i class="fa fa-remove"></i> {!! z_language('UnInstall') !!}
                            </a>
                        </div>
                        <div class="app-install" @if(isset($lists_install[$plugin])) style="display:none" @endif>
                            <a href="javascript:void(0);" class="btn bg-orange btn-xs  btnAction" data-act="remove"
                               data-plugin="{!! $plugin !!}"> <i class="fa fa-remove"></i> {!! z_language('Remove') !!}
                            </a>
                            <a href="javascript:void(0);" class="btn bg-navy btn-xs btnAction" data-act="install"
                               data-plugin="{!! $plugin !!}"> <i class="fa fa-cogs"></i> {!! z_language('Install') !!}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@push('links')
    <style>
        .item .box {
            border-top: 3px solid #0c0c0c;
            border-radius: 0px;
        }

        .item .box-title {
            color: #001f3f;
            font-weight: bold;
        }

        .item .icon {
            padding: 0;
        }

        .item .actions {
            padding: 0;
        }

        .actions .btn {
            margin-left: 5px;
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function () {
            $(".btnAction").click(function () {
                var self = this;
                if ($(self).attr('process') === 1) {
                    return;
                }
                $(self).attr('process', 1);
                var box = $(this).closest('.box');
                box.find('.icon').loading({circles: 3, overlay: true, width: "5em", top: "13%", left: "11%"});
                var data = $(this).data();
                var status = true;
                ajax("{!! route('backend:plugin:ajax') !!}", function (json) {
                    box.find('.icon').loading({destroy: true});
                    console.log(json);
                    if (json.status === true) {
                        if ((data.act === "uninstall") === status) {
                            box.find('.app-install').fadeIn(3000);
                            box.find('.app-uninstall').hide();
                        } else {
                            box.find('.app-install').hide();
                            box.find('.app-uninstall').fadeIn(3000);
                        }
                    } else {
                        $.growl.error({message: json.status});
                    }
                    $(self).attr('process', 0);
                }, data);
            });

        });
    </script>
@endpush