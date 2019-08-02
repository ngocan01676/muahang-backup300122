@php
    $optionGrid = array(

    );
    $girds = array(
        array(
            'option'=>array(
                'cfg'=>array(),
                'stg'=>array(
                    'col'=>array('12')
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
        <h3 class="box-title"> Layout </h3>
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
                                    <?php  foreach($girds as $gird):?>
                                            <?php echo  Admin\Lib\Layout::rows($gird,false); ?>
                                        <?php
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $module = "demo";
                $namePlugin = "demo";
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
                            $option = array_merge(array(
                                'cfg'=>array(),
                                'stg'=>array(
                                    'system'=>1,'type'=>'plugin','status'=>1
                                ),
                                'opt'=>array('status'=>1,'action'=>'none')
                            ));
                            $option['stg']['system'] = "demo";
                            $option['stg']['module'] = $module;
                            $option['stg']['widget'] = $namePlugin;
                            $option['stg']['type'] = 'plugin';
                            ?>
                            <?php echo \Admin\Lib\Layout::plugin($option,false); ?>
                        </div>
                    </div>
                </div>

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
                    <div id="layout">
                        <div class="demo" id="layout_demo" UrlSettingWidget="">
                            <?php //echo Layout::render($this->data_layout,$OptionModuleWidgetLayout); ?>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <BR>
                        <button url="{{route('backend:layout:ajax')}}" type="button" class="btn btn-primary btn-md" id="saveLayout">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .formSettingWidget,.formSettingGird{
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
        border-radius:5px;
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
    <script src="{{asset('module/admin/controller/layout/layout.js')}}"></script>

@endpush
@push('links')
    <link rel="stylesheet" href="{{asset('module/admin/controller/layout/style.css')}}">
@endpush