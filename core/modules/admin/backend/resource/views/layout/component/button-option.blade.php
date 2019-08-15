<a href="javascript:void(0);"
   class="btn btn-default btn-md btnOption" data-id="layout"><i class="fa fa-fw fa-cogs"></i> {{ $label }}
</a>
@push('extra-content')
    <div class="modal fade" id="myModalOption" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{$header}}</h4>
                </div>
                <div class="modal-body">
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{z_language('Close')}}</button>
                    <button type="button" class="btn btn-primary">{{z_language('Save')}}</button>
                </div>
            </div>
        </div>
    </div>
@endpush
@push("scripts")
    <script>
        $(".btnOption").click(function () {
            console.log("sdfsfsfd");
            $("#myModalOption").modal();
        });
    </script>
@endpush
