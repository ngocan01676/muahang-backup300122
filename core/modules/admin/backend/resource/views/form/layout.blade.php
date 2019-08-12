@php
    $optionGrid = [];
    $girds = array(
        array(
            'option'=>array(
                'cfg'=>array(
                ),
                'stg'=>array(
                    'col'=>array('12'),
                     'gird' => 'body',
                ),
                'opt'=>$optionGrid
            )
        ),
        array(
            'option'=>array(
                'cfg'=>array(),
                'stg'=>array(
                    'col'=>array('6','6')
                ),
                'opt'=>$optionGrid
            )
        ),
        array(
            'option'=>array(
                'cfg'=>array(),
                'stg'=>array(
                    'col'=>array('4','4','4')
                ),
                'opt'=>$optionGrid
            )
        ),
        array(
            'option'=>array(
                'cfg'=>array(),
                'stg'=>array(
                    'col'=>array('9','3')
                ),
                'opt'=>$optionGrid
            )
        )
    );
@endphp
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title"> {!! @z_language(["Layouts"]) !!}</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-xs-2">
                <div id="pluginwrap">
                    <div class="panel-group accordion sidebar-nav clearfix" id="accordion-grid">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="menu-item"
                                       data-toggle="collapse"
                                       data-parent="#accordion-grid"
                                       href="#menu-grid-accordion-grid">Grid</a>
                                </h4>
                            </div>
                            <div id="menu-grid-accordion-grid" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php  foreach ($girds as $gird): ?>
                                            <?php echo Admin\Lib\Layout::rows($gird, false); ?>
                                        <?php
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $widgets = [
                    "system" => [
                        [
                            "name" => "content",
                            "option" => array(
                                'cfg' => array(),
                                'stg' => array(
                                    'system' => "module",
                                    'module' => 'admin',
                                    'type' => 'component',
                                    'status' => 1,
                                    'blade' => 'content',
                                    'view' => 'admin_front'
                                ),
                                'opt' => array()
                            )
                        ],
                        ["name" => "Login",
                            "option" => array(
                                'cfg' => array(
                                    'view' => 'theme::widget.login.form',
                                ),
                                'stg' => array(
                                    'system' => "theme",
                                    'module' => 'zoe',
                                    'type' => 'widget',
                                    'status' => 1,
//                                    'blade' => 'login_form',
                                    "gird" => "main"
                                ),
                                'opt' => array()
                            )],
                        ["name" => "Navbar",
                            "option" => array(
                                'cfg' => array(
                                    'view' => 'theme::widget.navbar.navbar'
                                ),
                                'stg' => array(
                                    'system' => "theme",
                                    'module' => 'zoe',
                                    'type' => 'widget',
                                    'status' => 1
                                ),
                                'opt' => array()
                            )],
                        [
                            "name" => "thumbnail-image",
                            "option" => array(
                                'cfg' => array(
                                    'view' => 'theme::component.thumbnail-image.views.view'
                                ),
                                'stg' => array(
                                    'system' => "theme",
                                    'module' => 'zoe',
                                    'type' => 'component',
                                    'status' => 1,
//                                    'blade' => 'commposer',
                                    'gird' => ['card', 'container'],
                                    'compiler' => []
                                ),
                                'opt' => array()
                            )
                        ]
                    ],
                ];
                foreach ($widgets as $module=>$widget):
                ?>
                <div class="panel-group accordion sidebar-nav clearfix" id="accordion-<?php echo $module; ?>">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="menu-item"
                                   data-toggle="collapse"
                                   data-parent="#accordion-<?php echo $module; ?>"
                                   href="#menu-accordion-<?php echo $module; ?>"><?php echo $module; ?></a>
                            </h4>
                        </div>
                        <div id="menu-accordion-<?php echo $module; ?>" class="panel-collapse collapse">

                            <?php
                            foreach ($widget as $_widget) {
                                $option = $_widget['option'];
//                                $option['stg']['system'] = $module;
                                // $option['stg']['module'] = $module;
                                $option['stg']['name'] = $_widget['name'];
//                                $option['stg']['type'] = 'widget';
                                echo \Admin\Lib\Layout::plugin($option, false);
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php
                $components = app()->getComponents()->info;
                $components_config = app()->getComponents()->config;

                $module = "Component";
                // foreach ($components as $module=>$_components):
                ?>
                <div class="panel-group accordion sidebar-nav clearfix" id="accordion-<?php echo $module; ?>">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="menu-item"
                                   data-toggle="collapse"
                                   data-parent="#accordion-<?php echo $module; ?>"
                                   href="#menu-accordion-<?php echo $module; ?>"><?php echo $module; ?></a>
                            </h4>
                        </div>
                        <div id="menu-accordion-<?php echo $module; ?>" class="panel-collapse collapse">

                            <?php
                            foreach ($components as $name => $component) {
                                $option = $component['option'];
                                $option["stg"]['name'] = $component['name'];
//                                $option["stg"]['system'] = $module;
                                if (isset($components_config[$name])) {
                                    //$option['cfg'] = array_merge();
                                    $_config = $components_config[$name]["configs"];
//                                    dump( $components_config[$name]);
                                    $_cfg = new Zoe\Config($components_config[$name]["cfg"]);
                                    foreach ($_config as $__config) {
                                        $_prefix = "";
                                        if (isset($__config["prefix"])) {
                                            if (empty($__config["prefix"])) {
                                                $__data = $__config["data"];
                                            } else {
                                                $__data = [$__config["prefix"] => $__config["data"]];
                                            }
                                        } else {
                                            $__data = $__config["data"];
                                        }
                                        $_cfg->add(["config" => $__data]);
                                    }
                                    if (isset($components_config[$name]["compiler"])) {
                                        $_cfg->add(["compiler" => $components_config[$name]["compiler"]]);
                                    }
                                    $_cfg->add(["data" => []]);
                                    $option["cfg"] = $_cfg->getArrayCopy();
                                    $option["opt"] = $components_config[$name]["data"];
                                }
//                                dump($option);
                                echo \Admin\Lib\Layout::plugin($option, false);
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php //endforeach; ?>

                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-bordered table-responsive">

                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xs-10 no-padding">
                <div class="col-xs-12" style="min-height: 300px;margin-top: 10px">
                    <div class="screen">
                        <div class="toolbar">
                            <div class="buttons clearfix">
                                <span class="left red"></span>
                                <span class="left yellow"></span>
                                <span class="left green"></span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="id" value="{{$model->id}}">
                    <div id="layout" UriConfig="{{route('backend:layout:ajax:form_config')}}">
                        <div class="demo" id="layout_demo" UrlSettingWidget="">
                            <?php echo \Admin\Lib\Layout::render($content['data'], $content['widget']); ?>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <BR>
                        <button url="{{route('backend:layout:ajax')}}" type="button" class="btn btn-primary btn-md"
                                id="saveLayout">Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .formSettingWidget, .formSettingGird {
        display: none;
    }

    .screen .start {
        position: absolute;
        width: 100%;
        left: 0px;
        top: 0px;
        z-index: 99;
    }

    .screen .start > span {
        display: block;
        background: #34495E;
        padding: 10px 20px;
        width: 450px;
        color: #fff;
        font-size: 13px;
        text-transform: uppercase;
        text-align: center;
        margin: 170px auto 0px;
    }

    .screen .toolbar {
        background: #3c8dbc;
        height: 35px;
        padding: 0px 0px 0px 11px;
        border-radius: 5px;
    }

    .screen .toolbar .buttons {
        float: left;
        height: 13px;
        margin-top: 11px;
    }

    .screen .toolbar .title {
        font-size: 14px;
        color: #000;
        text-align: center;
        margin-right: 80px;
        padding-top: 5px;
        font-weight: bold;
    }

    .screen .toolbar .left {
        display: block;
        width: 13px;
        height: 13px;
        float: left;
        border-radius: 13px;
        margin-right: 6px;
    }

    .screen .toolbar .left.red {
        background: #E74C3C;
    }

    .screen .toolbar .left.yellow {
        background: #F4A62A;
    }

    .screen .toolbar .left.green {
        background: #16A085;
    }

</style>
@push('scripts')
    <script src="{{asset('module/admin/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('module/admin/asset/bootpopup/bootpopup.js')}}"></script>
    <script src="{{asset('module/admin/asset/zoe.jquery.inputs.js')}}"></script>
    <script src="{{asset('module/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.2/codemirror.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.2/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.2/addon/mode/overlay.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.2/addon/runmode/runmode.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.2/mode/php/php.js"></script>

    <script src="{{asset("module/admin/asset/codemirror/mustache.js")}}"></script>
    <script src="{{asset("module/admin/asset/multi-select/js/jquery.multi-select.js")}}"></script>
    <script src="{{asset('module/admin/controller/layout/layout.js')}}"></script>
@endpush
@push('links')
    <link rel="stylesheet" href="{{asset('module/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
    <link rel="stylesheet" href="{{asset('module/admin/controller/layout/style.css')}}">
    <link rel="stylesheet" href="{{asset("module/admin/asset/multi-select/css/multi-select.css")}}">
    <style>
        .CodeMirror {
            border: 1px solid black;
        }

        iframe {
            margin: 10px auto;
            display: block; /* iframes are inline by default */
            background: #ffffff;
            border: 1px solid #dedede; /* Reset default border */
            height: 50vh; /* Viewport-relative units */
            width: 100%;
        }</style>
@endpush