<?php
namespace Admin\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DashboardController extends \Zoe\Http\ControllerBackend {
    public function list(){
       return $this->render('dashboard.list');
    }
    public function option(Request $request){
        $items = $request->all();
        if(isset($items['act'])){
            if($items['act'] == 'get'){
                return view('backend::configs.option',['configs'=>$items['configs']]);
            }else if($items['act'] == 'save'){
                DB::table('config')->updateOrInsert(
                        [
                            'name' => $items['name'],
                            'type' => 'option'
                        ],
                 ['data' => serialize($items['data'])]);
            }
        }
    }
}