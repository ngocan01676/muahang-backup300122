@section('content-header')
    <h1>
        &starf; {!! @z_language(["Chức năng quản lý sản phẩm"]) !!}
        <small>it all starts here</small>
        <a href="{{route('backend:shop_ja:product:create')}}"
           class="btn btn-default btn-md"><i class="fa fa-fw fa-plus"></i> {!! @z_language(["Tạo mới"]) !!} </a>
        <x-btnOption :config="['name'=>'module:shop_ja:product']">
            <x-slot name="label">
                {{@z_language(["Option"])}}
            </x-slot>
            <x-slot name="header">
                {{@z_language(["Option"])}}
            </x-slot>
        </x-btnOption>
        <a href="javascript:void(0)" class="btn btn-default btn-md ExcelExport"><i class="fa fa-fw fa-file-excel-o"></i> {!! @z_language(["Xuất"]) !!} </a>
    </h1>
@endsection
@section('content')
    <x-breadcrumb/>
    @component('backend::layout.component.list',['name'=>'module:shop_ja:product','models'=>$models,'callback'=>$callback])
        @slot("tool")

            <div class="box-body">
                <div class="col-md-12" style="padding:0">
                    <div class="row" style="padding: 5px">
                        <div class="col-sm-4" style="padding:0">
                            <div class="col-sm-4" style="padding:0;text-align: center;line-height: 2;">
                                <label>Mã</label>
                            </div>
                            <div class="col-sm-8" style="padding:0;text-align: center;">
                                <input auto-action="1" type="text" name="filter.code" class="form-control" id="filter.code"
                                       placeholder="Code">
                            </div>
                        </div>
                        <div class="col-sm-4" style="padding:0">
                            <div class="col-sm-4" style="padding:0;text-align: center;line-height: 2;">
                                <label>Tiêu đề</label>
                            </div>
                            <div class="col-sm-8" style="padding:0;text-align: center;">
                                <input auto-action="1" type="text" name="filter.search" class="form-control" id="filter.search"
                                       placeholder="Name">
                            </div>
                        </div>
                        <div class="col-sm-4" style="padding:0">
                            <div class="col-sm-4" style="padding:0;text-align: center;line-height: 2;">
                                <label>Mô tả</label>
                            </div>
                            <div class="col-sm-8" style="padding:0;text-align: center;">
                                <input auto-action="1" type="text" name="filter.des" class="form-control" id="filter.des"
                                       placeholder="Mô tả">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding: 5px">
                        <div class="col-sm-4" style="padding:0">
                            <div class="col-sm-4" style="padding:0;text-align: center;line-height: 2;">
                                <label>Công ty</label>
                            </div>
                            <div class="col-sm-8" style="padding:0;text-align: center;" >
                                {!! Form::CategoriesNestableOne($nestables,[Form::value('category_id')=>""],"filter.cate","",["auto-action"=>1]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <BR>
                        <button type="button" class="btnFilter btn btn-sm btn-primary pull-right" id="btnSearch">
                            Dữ liệu
                        </button>
                    </div>
                </div>
            </div>
        @endslot
    @endcomponent
@endsection
@push('links')
    <div class="modal fade" id="myModalOptionExcel" role="dialog">
        <form action="">
            <div class="modal-dialog" style="width: 50%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Option</h4>

                    </div>
                    <div class="modal-body">
                        <form action="" id="myform">
                            <table class="table">
                                <tr>
                                    <th>Chuyên mục</th>
                                    <td>
                                        {!! Form::CategoriesNestableOne($nestables,[Form::value('category_id')=>""],"congty","",[]) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Loại xuất</th>
                                    <td>
                                        <input name="export_type" type="radio" value="facebook" checked> facebook
                                        <input name="export_type" type="radio" value="facebook"> zalo
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button"  class="btnExportOption btn btn-primary">Xuất</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endpush
@push('scripts')
    <script>
        function getDomain(url, subdomain) {
            subdomain = subdomain || false;

            url = url.replace(/(https?:\/\/)?(www.)?/i, '');

            if (!subdomain) {
                url = url.split('.');

                url = url.slice(url.length - 2).join('.');
            }

            if (url.indexOf('/') !== -1) {
                return url.split('/')[0];
            }

            return url;
        }
        $(document).ready(function () {

            $(".ExcelExport").click(function () {
                var myModalOption = $("#myModalOptionExcel");
                myModalOption.modal();
            });
            $('.btnExportOption').click(function () {
                $.ajax({
                    url:"{!! route('backend:shop_ja:product:export') !!}",
                    type:"POST",
                    data:{
                        cate:$("#congty-select").val(),
                        type:$("#myform input[type='radio']:checked").val()
                    },
                    success:function (data) {
                        window.open(window.location.protocol+"//"+getDomain(location.href)+"/"+data.url, '_blank').focus();
                       
                    }
                });
            });
            let action = false;
            function myFunction(){
                let delay = true;
                if($('js-loading-overlay').length == 0)
                {
                    delay = false;
                }
                if(delay){
                    if(action) return;
                    setTimeout(function () {
                        action = false;
                        $("#btnSearch").click();
                    },1000);
                }else{
                    $("#btnSearch").click();
                }

            }
            $("[auto-action=\"1\"]").each(function () {
               let dom = $(this);
               switch (dom.prop("tagName")) {
                   case "INPUT":
                       dom.change(myFunction).keyup(myFunction);
                       break;
                   case "SELECT":
                       dom.change(myFunction);
                       break;
               }
            });
        });
    </script>
@endpush
