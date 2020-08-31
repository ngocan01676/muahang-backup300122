<?php
namespace ShopJa\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use \ShopJa\Http\Models\OrderModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
class OrderExcelController extends \Zoe\Http\ControllerBackend
{
    public function init()
    {
        $this->data['language'] = config('zoe.language');
        $this->data['nestables'] = config_get("category", "shop-ja:japan:category");
        $this->data['configs'] = config_get("config", "shopja");
        $this->data['current_language'] = isset($this->data['configs']['shopja']['language']['default']) ? $this->data['configs']['shopja']['language']['default'] : "en";




    }
    public function getCrumb()
    {
        $this->breadcrumb(z_language("Quản lý đơn hàng"), route('backend:shop_ja:order:list'));
        return $this;
    }
    public function store(Request $request){
        $data = $request->all();
        if(isset($data['act'])){
            if($data['act'] == "cache"){
                $k = Auth::user()->id.':'.$data['type'].':'.$data['name'].':'.$data['id'];
                if(Cache::put($k,$data['data'] , 60*60*2)){
                    return response()->json(['key'=>$k,'data'=>json_decode(Cache::get($k),true)]);
                }
            }else if($data['act'] == "save"){

            }
        }
    }
    public function list(){

    }
    private function GetCache($type,$id){

        $this->data['excels_data'] = [

        ];

        $names  = ['YAMADA','FUKUI','KOGYJA','KURICHIKU','OHGA'];

        foreach ($names as $name){
            $key = Auth::guard()->user()->id.':'.$type.':'.$name;
            $k = $key.':'.$id;
            if(Cache::has($k)){
                $val = Cache::get($k);
            }else{
                $val ='[]';
            }
            if(Cache::has($key)){
               $dataKey =  Cache::get($key);
            }else{
               $dataKey = rand();
               Cache::put($key,$dataKey , 60*60*24);
            }
            $this->data['excels_data'][$name] = [
                'data'=>$val ? json_decode($val) : '[]',
                'key'=> $dataKey
            ];
        }
    }
    public function create(){
        $this->GetCache('create',0);
        return $this->render('order-excel.create');
    }
    public function edit(){

    }
}
