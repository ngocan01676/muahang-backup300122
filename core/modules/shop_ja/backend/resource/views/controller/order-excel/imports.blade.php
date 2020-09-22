@section('content-header')
    <h1>
        {!! @z_language(["Chức năng quản lý đơn hàng Excel"]) !!}

    </h1>
@endsection
@section('content')
    @breadcrumb()@endbreadcrumb
    <div class="container1">
        <div class="row">
            <div class="col-md-6 offset-6">
                <div class="card">

                    <div class="card-body">
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <div class="success alert alert-success">
                            Upload Successfully
                        </div>
                        <form enctype="multipart/form-data" id="imageUpload">
                            <div class="form-group">
                                <label><strong>File Excel : </strong></label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-success">Đẩy lên</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border"></div>
                    <div class="box-body" id="results"></div>
                    <div class="box-footer">
                        <button type="button" class="btn btn-success" id="importBtn">Cập nhật</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('extra-script')
    <style>
        .update{
            color: #3a8104;
        }
        .oke{
            color: green;
        }
        .conflict{
            color: red;
        }
        .empty{
            color: #0000cc;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.success').hide();// or fade, css display however you'd like.
        });
        $('#imageUpload').on('submit',(function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type:'POST',
                url: "{{ route('backend:shop_ja:order:excel:imports')}}",
                data:formData,
                cache:false,
                contentType: false,
                processData: false,

                complete: function(response)
                {
                    console.log(response);
                    if($.isEmptyObject(response.responseJSON.error)){
                        $('.success').show();
                        setTimeout(function(){
                            $('.success').hide();
                        }, 5000);
                        $("#results").html(response.responseJSON.html);
                    }else{
                        printErrorMsg(response.responseJSON.error);
                    }
                }

            });
        }));
        function printErrorMsg(msg){
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }
        $("#importBtn").click(function () {
            let lists = [];

            $("#results .update").each(function () {
                lists.push(JSON.parse($(this).find('textarea.value').val()));
            });

            $.ajax({
                type: "POST",
                data: {
                    'type':"import",
                    lists:lists,
                },
                success: function (data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection