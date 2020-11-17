

@php
    $directories =  expand_directories_matrix( base_path('public/uploads'));
    $roles = DB::table('role')->get()->all();
    $admins = DB::table('admin')->get()->all();
@endphp
<div id="elf_premission">
    <div class="box box-zoe">
        <div class="box-body">
            <div id="formData">
                <div class="col-md-2">
                    <table class="table-bordered table">
                        <tr>
                            <th colspan="3" class="text-center">{!! z_language("Folders") !!}</th>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div id="main">
                                    <?php
                                    function showDirectories($list, $parent = array())
                                    {
                                        echo "<ul>";
                                        foreach ($list as $directory){
                                            $parent_name = count($parent) ? $parent['name'] : 'no';
                                            $prefix = str_repeat('-', $directory['level']);
                                            echo "<li a parent='".$parent_name."'>".$directory['name'];
                                            if(count($directory['children'])){
                                                // list the children directories
                                                showDirectories($directory['children'], $directory);
                                            }
                                            echo '</li>';
                                        }
                                        echo "</ul>";
                                    }
                                    showDirectories($directories);
                                    ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-5 permission">
                    <table class="table-bordered table">
                        <thead>
                        <tr>
                            <th colspan="5" class="text-center">{!! z_language("Role") !!}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th class="text-center" style="width: 40%">{!! z_language('Name') !!}</th>
                            <th class="text-center">{!! z_language('Read') !!} <input type="checkbox" value="1" onchange="change(this)"></th>
                            <th class="text-center">{!! z_language('Write') !!} <input type="checkbox" value="2" onchange="change(this)"></th>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="main">
                                    <table class="table-bordered table role" data-content="#">
                                        <tbody>
                                        @foreach($roles as $role)
                                            <tr>
                                                <td class="text-center" style="width: 40%">{!! $role->name !!}</td>
                                                <td class="text-center"><input type="checkbox" value="1" name="role.read[{!! $role->name !!}]"></td>
                                                <td class="text-center"><input type="checkbox" value="2" name="role.write[{!! $role->name !!}]"></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <div class="col-md-5 permission">
                    <table class="table-bordered table">
                        <thead>
                        <tr>
                            <th class="text-center" colspan="5">{!! z_language("User") !!}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th class="text-center" style="width: 40%">{!! z_language('Name') !!}</th>
                            <th class="text-center">{!! z_language('Read') !!} <input type="checkbox"  value="1" onchange="change(this)"></th>
                            <th class="text-center">{!! z_language('Write') !!} <input type="checkbox"  value="2" onchange="change(this)"></th>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="main">
                                    <table class="table-bordered table">
                                        <tbody>
                                        @foreach($admins as $admin)
                                            <tr>
                                                <td class="text-center" style="width: 40%">{!! $admin->username !!}</td>
                                                <td class="text-center"><input type="checkbox" value="1" name="admin.read[{!! $admin->username !!}]"></td>
                                                <td class="text-center"><input type="checkbox" value="2" name="admin.write[{!! $admin->username !!}]"></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button class="btn btn-sm btn-primary pull-right" onclick="SaveAction()"> <i class="fa fa-save"></i> {!! z_language("Save") !!}</button>
        </div>
    </div>
</div>
@push('scripts')
    <style>
        .permission tbody{
            opacity: 0.7;
        }
        .permission.selected tbody{
            opacity: 1;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <script>
        let selected = null;
        let dataJson = {};

        function change(self){
            let status = $(self).is(":checked");
            let val = $(self).val();
            $(self).closest('.permission').find('.main tbody tr input[value="'+val+'"]').each(function () {
                $(this).prop('checked',status);
            });
            console.log();
            console.log(val);
            console.log(status);
            if(status){

            }
        }
        $(function () {
            $('#main').on('changed.jstree', function (e, data) {
                var i, j, r = [];
                for(i = 0, j = data.selected.length; i < j; i++) {
                    r.push(data.instance.get_node(data.selected[i]).text);
                }
                if(r.length > 0){
                    $(".permission").addClass('selected');
                    $("#elf_premission .selected .main").mask("{!! z_language('Waiting...') !!}");
                    selected = r[0];
                    console.log('selected:'+selected);
                    $('#formData input:checkbox').each(function () {
                        $(this).prop('checked',false);
                    });
                    $.ajax({
                        type: "POST",
                        url:'{!! route('backend:configuration:action') !!}',
                        data: {"act": "get", selected:selected,'name':"Elfinder:permission"},
                        success: function (data) {
                            console.log($('#main').closest('form'));
                            $('#main').closest('form').zoe_inputs('set',data);
                            $("#elf_premission .selected .main").unmask();
                        }
                    });
                }
            }).jstree();
        });
        function SaveAction() {
            console.log(selected);
            let dataForm =  $('#main').closest('form').zoe_inputs('get');
            console.log(dataForm);
            $("#elf_premission .selected .main").mask("{!! z_language('Waiting...') !!}");
            // $.ajax({
            //     type: "POST",
            //     data: {"act": "save", data: dataForm,selected:selected,'name':"Elfinder:permission"},
            //     success: function (data) {
            //         $("#elf_premission .selected .main").unmask();
            //     }
            // });
        }
    </script>
@endpush
