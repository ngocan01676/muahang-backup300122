@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{!! @z_language(["Premission Folder"]) !!}</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                                title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <form action="" id="formData">
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
                        <div class="col-md-5">
                            <table class="table-bordered table">
                                <tr>
                                    <th colspan="5" class="text-center">{!! z_language("Role") !!}</th>
                                </tr>
                                <tr>
                                    <th class="text-center">{!! z_language('Name') !!}</th>
                                    <th class="text-center">{!! z_language('All') !!}</th>
                                    <th class="text-center">{!! z_language('Read') !!}</th>
                                    <th class="text-center">{!! z_language('Write') !!}</th>
                                    <th class="text-center">{!! z_language('No') !!}</th>
                                </tr>
                                @foreach($roles as $role)
                                    <tr>
                                        <td class="text-center">{!! $role->name !!}</td>
                                        <td class="text-center"><input type="checkbox" value="1" name="role.all[{!! $role->name !!}]"></td>
                                        <td class="text-center"><input type="checkbox" value="1" name="role.read[{!! $role->name !!}]"></td>
                                        <td class="text-center"><input type="checkbox" value="1" name="role.write[{!! $role->name !!}]"></td>
                                        <td class="text-center"><input type="checkbox" value="1" name="role.status[{!! $role->name !!}]"></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="col-md-5">
                            <table class="table-bordered table">
                                <tr>
                                    <th class="text-center" colspan="5">{!! z_language("User") !!}</th>
                                </tr>
                                <tr>
                                    <th class="text-center">{!! z_language('Name') !!}</th>
                                    <th class="text-center">{!! z_language('All') !!}</th>
                                    <th class="text-center">{!! z_language('Read') !!}</th>
                                    <th class="text-center">{!! z_language('Write') !!}</th>
                                    <th class="text-center">{!! z_language('No') !!}</th>
                                </tr>
                                @foreach($admins as $admin)
                                    <tr>
                                        <td class="text-center">{!! $admin->username !!}</td>
                                        <td class="text-center"><input type="checkbox" value="1" name="admin.all[{!! $admin->username !!}]"></td>
                                        <td class="text-center"><input type="checkbox" value="1" name="admin.read[{!! $admin->username !!}]"></td>
                                        <td class="text-center"><input type="checkbox" value="1" name="admin.write[{!! $admin->username !!}]"></td>
                                        <td class="text-center"><input type="checkbox" value="1" name="admin.status[{!! $admin->username !!}]"></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    Footer
                </div>
                <!-- /.box-footer-->
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <script>
        $(function () { $('#main').on('changed.jstree', function (e, data) {
            var i, j, r = [];
            for(i = 0, j = data.selected.length; i < j; i++) {
                r.push(data.instance.get_node(data.selected[i]).text);
            }
            console.log('Selected: ' + r.join(', '));
            let dataForm = $("#formData").zoe_inputs('get');
            console.log(dataForm);
        }).jstree(); });
    </script>
@endpush

