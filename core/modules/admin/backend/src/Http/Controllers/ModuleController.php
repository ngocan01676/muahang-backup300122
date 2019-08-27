<?php

namespace Admin\Http\Controllers;

use Admin\Http\Models\PageModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ModuleController extends \Zoe\Http\ControllerBackend
{
    public function getCrumb()
    {
        $this->breadcrumb(z_language("Module"), route('backend:module:list'));
        return $this;
    }
    function getDirContents($dir, $filter = '', &$results = array())
    {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                if (empty($filter) || preg_match($filter, $path)) $results[] = $path;
            } elseif ($value != "." && $value != "..") {
                $this->getDirContents($path, $filter, $results);
            }
        }
        return $results;
    }

    private function CreateModuleObject($module){
        $config_zoe = config('zoe');
        $relativePath = base_path($config_zoe['structure']['module']).DIRECTORY_SEPARATOR.$module;
        require_once $relativePath . '/Module.php';
        $name = 'Module' . ucwords($module);
        $class = '\\' . $name . '\\Module';
        return new $class();
    }
    public function ajax(Request $request)
    {
        $data  = $request->all();
        $response = ["status"=>false];
        if(isset($data["act"])){
            switch ($data["act"]){
                case "install":
                    DB::beginTransaction();
                    try{
                            $module = $data['module'];
                            $object = $this->CreateModuleObject($module);

                            if($object){
                                $object->install();
                                $name = 'Module' . ucwords($module);
                                $class = '\\' . $name . '\\Module';
                                DB::table('module')->updateOrInsert(['name'=>$module],[
                                    'version'=>$class::$version,
                                    'data'=>serialize($data?$data:[]),
                                    'status'=>1,
                                    'create_at'=>date('Y-m-d H:i:s')
                                ]);
                            }
                            $response['status'] = true;
                    }catch (\Exception $ex){
                        DB::rollBack();
                        $response['status'] = $ex->getMessage();
                    }
                    break;
                case "uninstall":
                    DB::beginTransaction();
                    try{
                        $module = $data['module'];
                        $object = $this->CreateModuleObject($module);
                        if($object){
                            $object->uninstall();
                            DB::table('module')->where('name',$module)->delete();
                            $response['status'] = true;
                        }
                    }catch (\Exception $ex){
                        DB::rollBack();
                        $response['status'] = $ex->getMessage();
                    }
                    break;
                case "remove":

                    break;
            }
        }
        return response()->json($response);
    }
    public function list()
    {

        $config_zoe = config('zoe');
        $relativePath = base_path($config_zoe['structure']['module']);
        $lists_folder = scandir($relativePath);
        $array = [];
        $modules = $config_zoe['modules'];

        foreach ($lists_folder as $module){
            if($module=="." || $module==".."){
                continue;
            }
            if(file_exists($relativePath.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR."Module.php")){
                require_once $relativePath.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR."Module.php";
                if (in_array($module,$modules)) {
                    $name = ucwords($module);
                } else {
                    $name = 'Module' . ucwords($module);
                }
                $class = '\\' . $name . '\\Module';
                if(class_exists($class)){
                    $array[$module] =[
                        "name"=>$class::$name?$class::$name:$module,
                        "description"=>$class::$description?$class::$description:$module,
                        "version"=>$class::$version,
                        "author"=>$class::$author,
                    ];
                }
            }
        }

        $this->data['lists'] = $array;
        $this->data['lists_install'] =  collect(DB::table('module')->select()->where('status', 1)->get())->keyBy('name');
        return $this->render('module.list');
    }
}