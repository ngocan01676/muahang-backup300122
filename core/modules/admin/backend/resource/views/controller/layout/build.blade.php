@section('content-header')
    <h1>
        {!! @z_language(["Manager Layout"]) !!}
    </h1>
@endsection
@section('content')
    @breadcrumb()@endbreadcrumb
    @php
        $obj_layout = new \Admin\Lib\LayoutBlade();
    @endphp
    <div class="box box box-zoe">
        <div class="box-body clearfix">
            <ul class="timeline timeline-inverse builds">
                <li class="time-label">
                    <button action="0" class="btn  btn-default" style="margin-left: 7px;"
                            onclick="BuildAll(this,'build')">Build
                    </button>
                </li>
                @foreach($lists as $list)
                    @php
                        if($list->type == "partial"){
                            $fileName = $obj_layout->FilenamePartial($list->id, $list->token);
                        }else{
                            $fileName = $obj_layout->FilenameLayout($list->id, $list->token);
                        }
                        $FileNameBlade = view()->exists("zoe::".$fileName)?view()->getFinder()->find(\Illuminate\View\ViewName::normalize("zoe::".$fileName)):"";
                        $boolFilePhp = false;
                        $FileNamePhp= "";
                        if(!empty($FileNameBlade)){
                            $FileNamePhp = config('view.compiled')."/".sha1($FileNameBlade).".php";
                            if(file_exists($FileNamePhp)){
                                $boolFilePhp = true;
                            }
                        }
                    @endphp
                    <li data-id="{!! $list->id !!}">
                        <i class="fa fa-refresh"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> {!! $list->updated_at !!}</span>
                            <h3 class="timeline-header"><strong> {!! $list->name !!} </strong>
                                <span class="label label-success">{!! $list->type !!}</span> &nbsp;
                                <span class="label {!! !empty($FileNameBlade)?"label-info":"label-danger" !!}">Blade</span>
                                &nbsp;
                                <span class="label {!! $boolFilePhp?"label-info":"label-danger" !!}">Php</span> &nbsp;
                            </h3>

                            <div class="timeline-body">

                            </div>
                            <div class="timeline-footer">
                                <a href="{!! route('backend:layout:edit',["id"=>$list->id]) !!}"
                                   class="btn btn-default btn-xs">{!! z_language('Edit') !!}</a> &nbsp;
                                <a onclick="Action(this)" class="btn btn-default btn-xs build" data-act="build"
                                   data-id="{!! $list->id !!}">{!! z_language('Build') !!}</a> &nbsp;
                                <a onclick="Action(this)" class="btn btn-default btn-xs delete" data-act="delete"
                                   data-id="{!! $list->id !!}">{!! z_language('Delete') !!}</a> &nbsp;
                                <a onclick="Action(this)" class="btn btn-default btn-xs view" data-act="view"
                                   data-id="{!! $list->id !!}">{!! z_language('ViewSource') !!}</a>
                            </div>
                        </div>
                    </li>
                @endforeach
                <li>
                    <button action="0" class="btn  btn-default" style="margin-left: 7px;"
                            onclick="BuildAll(this,'delete')">Delete
                    </button>
                </li>
            </ul>
        </div>
    </div>
@endsection
@push('scripts')

    <script>
        function Action(self, cb) {
            var data = $(self).data();
            console.log(data);
            $.ajax({
                type: 'POST',
                url: '{{route('backend:layout:ajax:build')}}',
                data: data,
                success: function (data) {
                    if (cb) {
                        cb(data);
                    }
                }
            });
        }

        function BuildAll(self, name) {
            if ($(self).attr('action') === 1) {
                return;
            }

            $(self).attr('disabled', true);
            $arr_Promise = [];
            $(".builds li").each(function () {
                let build = $(this).find('.' + name);
                if (build.length > 0) {
                    let i = $(this).find('i');
                    $arr_Promise.push(new Promise((resolve, reject) => {
                        i.addClass('fa-spin');
                        Action($(build), function (data) {
                            setTimeout(function () {
                                resolve(data);
                                i.removeClass('fa-spin');
                            }, 500 * (Math.random() * (5 - 1) + 1));
                        });
                    }));
                }
            });
            Promise.all($arr_Promise).then(values => {
                console.log(values); // [3, 1337, "foo"]
                $(self).removeAttr('disabled');
            });
        }
    </script>
@endpush