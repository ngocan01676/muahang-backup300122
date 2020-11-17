@php
    $directories =  expand_directories_matrix( base_path('public/uploads'));
    $roles = DB::table('role')->get()->all();
    $admins = DB::table('admin')->get()->all();

    $permission = configs_get('Elfinder:permission');

    $input_line = "/Pictures/demo";
@endphp
<div id="elf_premission">
    <div class="box box-zoe">
        <div class="box-body">
            <div>
                <table class="table-bordered table">

                        @foreach($roles as $role)
                           <tr>
                               <td>{!! $role->name !!}</td>
                               <td>
                                   @php
                                      $reg = show_preg_match_1($directories,'/',$permission,$role->id);
                                      echo "<pre>";
                                        echo trim($reg,"|");
                                      echo "</pre>";
                                   @endphp
                               </td>
                           </tr>
                        @endforeach

                </table>
            </div>
            <form>
                <input type="hidden" value='' name="path">
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
                                            if(count($directory['children']) && $directory['level'] < 2){
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
                            <th class="text-center" style="width: {!! 100/6 !!}%">{!! z_language('Name') !!}</th>
                            <th class="text-center" style="width: {!! 100/6 !!}%">{!! z_language('File') !!}</th>
                            <th class="text-center" style="width: {!! 100/6 !!}%">{!! z_language('Folder') !!}</th>
                            <th class="text-center" style="width: {!! 100/6 !!}%">{!! z_language('File & Folder') !!}</th>
                            <th class="text-center" style="width: {!! 100/6 !!}%">{!! z_language('All') !!}</th>
                            <th class="text-center" style="width: {!! 100/6 !!}%">{!! z_language('Hide') !!}</th>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <div class="main">
                                    <table class="table-bordered table role" data-content="#">
                                        <tbody>
                                        @foreach($roles as $role)
                                            <tr>
                                                <td class="text-center" style="width: {!! 100/6 !!}%">{!! $role->name !!}</td>
                                                <td class="text-center" style="width: {!! 100/6 !!}%"><input type="radio" value="1" name="role.premission[{!! $role->id !!}]"></td>
                                                <td class="text-center" style="width: {!! 100/6 !!}%"><input type="radio" value="2" name="role.premission[{!! $role->id !!}]"></td>
                                                <td class="text-center" style="width: {!! 100/6 !!}%"><input type="radio" value="3" name="role.premission[{!! $role->id !!}]"></td>
                                                <td class="text-center" style="width: {!! 100/6 !!}%"><input type="radio" value="4" name="role.premission[{!! $role->id !!}]"></td>
                                                <td class="text-center" style="width: {!! 100/6 !!}%"><input type="radio" value="0" name="role.premission[{!! $role->id !!}]"></td>
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
                            <th class="text-center" style="width: {!! 100/6 !!}%">{!! z_language('Name') !!}</th>
                            <th class="text-center" style="width: {!! 100/6 !!}%">{!! z_language('File') !!}</th>
                            <th class="text-center" style="width: {!! 100/6 !!}%">{!! z_language('Folder') !!}</th>
                            <th class="text-center" style="width: {!! 100/6 !!}%">{!! z_language('File & Folder') !!}</th>
                            <th class="text-center" style="width: {!! 100/6 !!}%">{!! z_language('All') !!}</th>
                            <th class="text-center" style="width: {!! 100/6 !!}%">{!! z_language('Hide') !!}</th>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <div class="main">
                                    <table class="table-bordered table">
                                        <tbody>
                                        @foreach($admins as $admin)
                                            <tr>
                                                <td class="text-center" style="width: {!! 100/5 !!}%">{!! $admin->username !!}</td>
                                                <td class="text-center" style="width: {!! 100/5 !!}%"><input type="radio" value="1" name="admin.premission[{!! $role->id !!}]"></td>
                                                <td class="text-center" style="width: {!! 100/5 !!}%"><input type="radio" value="2" name="admin.premission[{!! $role->id !!}]"></td>
                                                <td class="text-center" style="width: {!! 100/5 !!}%"><input type="radio" value="3" name="admin.premission[{!! $role->id !!}]"></td>
                                                <td class="text-center" style="width: {!! 100/5 !!}%"><input type="radio" value="4" name="admin.premission[{!! $role->id !!}]"></td>
                                                <td class="text-center" style="width: {!! 100/5 !!}%"><input type="radio" value="0" name="admin.premission[{!! $role->id !!}]"></td>
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
            </form>
        </div>
    </div>
</div>
@push('scriptsTop')
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
        let $permission = @json($permission);
        let $directories = @json($directories);
        function show_preg_match($list, $path = '',$permission,$role){
            $html = "";
            $_path = $path;
            for (let i in $list){
                $directory = $list[i];
                $__path = $_path+$directory.name+'/';
                if(
                    $permission.hasOwnProperty($__path) &&
                    $permission[$__path].hasOwnProperty('role') &&
                    $permission[$__path]['role'].hasOwnProperty('read') &&
                    $permission[$__path]['role']['read'].hasOwnProperty($role)
                ){
                    $html+= $directory['name']+"(/";
                    if($directory['children'].length > 0 && $directory['level'] < 2){
                        $html+="|/([^/]+|"+show_preg_match($directory['children'], $__path,$permission,$role)+")";
                    }else{
                        $html+='|/.+';
                    }
                    $html+=")|";
                }
            }
            return $html.trim('|');
        }

        function change(self){
            let status = $(self).is(":checked");
            let val = $(self).val();
            $(self).closest('.permission').find('.main tbody tr input[pos="'+val+'"]').each(function () {
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
                    let parent = data.instance.get_node(data.selected[0]).parents;
                    console.log(parent);
                    let folder = [];
                    for(let i = parent.length-2; i >= 0 ; i--){
                        folder.push($("#"+parent[i]+"_anchor").text());
                    }
                    folder.push(data.instance.get_node(data.selected[0]).text);
                    selected = "/"+folder.join('/')+"/";
                    $("#elf_premission [name='path']").val(selected);
                    $(".permission").addClass('selected');
                    $("#elf_premission .selected .main").mask("{!! z_language('Waiting...') !!}");
                    $('#elf_premission form input:checkbox').each(function () {
                        $(this).prop('checked',false);
                    });
                    $.ajax({
                        type: "POST",
                        url:'{!! route('backend:configuration:action') !!}',
                        data: {"act": "get", name:selected,'type':"Elfinder:permission"},
                        success: function (data) {
                            console.log(data);
                            $('#main').closest('form').zoe_inputs('set',data);
                            $("#elf_premission .selected .main").unmask();
                        }
                    });
                }
            }).jstree();

            Events['media'].push(function () {
               return new Promise(function (resolve, reject) {
                   let dataForm =  $('#main').closest('form').zoe_inputs('get');
                   $("#elf_premission .selected .main").mask("{!! z_language('Waiting...') !!}");
                   $.ajax({
                       type: "POST",
                       url:'{!! route('backend:configuration:action') !!}',
                       data: {"act": "save", data: dataForm,name:selected,'type':"Elfinder:permission"},
                       success: function (data) {
                           $("#elf_premission .selected .main").unmask();
                       }
                   });
               });
            });

        });
    </script>
@endpush
