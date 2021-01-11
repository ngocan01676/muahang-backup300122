<?php
namespace MissTerryTheme\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends \Zoe\Http\ControllerFront
{
    public function getdashboard(Request $request)
    {
        $this->addDataGlobal("Blog-featured-style",  2);
        $this->addDataGlobal("Blog-featured-background",  'theme/missterry/images/IMG_2769-1.jpg');
        $this->addDataGlobal("Blog-featured-title",  z_language('MY ACCOUNT'));
        $this->addDataGlobal("User-Menu-Router",$request->route()->getName());
        return $this->render('user.dashboard',[]);
    }
    public function getinfo(Request $request)
    {
        $this->addDataGlobal("Blog-featured-style",  2);
        $this->addDataGlobal("Blog-featured-background",  'theme/missterry/images/IMG_2769-1.jpg');
        $this->addDataGlobal("Blog-featured-title",  z_language('MY ACCOUNT'));
        $this->addDataGlobal("User-Menu-Router",$request->route()->getName());
        return $this->render('user.info',[]);
    }
    public function getorders(Request $request){
        $this->addDataGlobal("Blog-featured-style",  2);
        $this->addDataGlobal("Blog-featured-background",  'theme/missterry/images/IMG_2769-1.jpg');
        $this->addDataGlobal("Blog-featured-title",  z_language('MY ACCOUNT'));
        $this->addDataGlobal("User-Menu-Router",$request->route()->getName());

        $miss_room = DB::table('miss_room')->where('status',1)->get()->keyBy('id')->all();

        $config_language = app()->config_language;
        $translation = [];
        if(isset($config_language['lang'])){

            $translation = DB::table('miss_room_translation')->where('lang_code',$config_language['lang'])->get()->keyBy('room_id')->all();
            foreach ($miss_room as $key=>$value){
                if(isset($translation[$value->id])){
                    $value->title = $translation[$value->id]->title;
                    $value->address = $translation[$value->id]->address;
                    $value->info = $translation[$value->id]->info;
                    $value->description = $translation[$value->id]->description;
                    $value->content = $translation[$value->id]->content;
                }
            }
        }
        $user = Auth('frontend')->user();

        $results = DB::table('miss_booking')->where('email',$user->email);

        $total_records = $results->count();

        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 5;
        $total_page = ceil($total_records / $limit);
        if ($current_page > $total_page){
            $current_page = $total_page;
        }
        else if ($current_page < 1){
            $current_page = 1;
        }
        $start = ($current_page - 1) * $limit;
        $results = $results->offset($start)->limit($limit)->get()->all();

        return $this->render('user.orders',['results'=>$results,'rooms'=>$miss_room,
            'pagination'=>[
            'current_page'=>$current_page,
            'total_page'=>$total_page,
        ]]);
    }
    public function get_announce(){

        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $total_page = 0;

        $models = DB::table('announce')->where('status',1);
        $total_records = $models->count();
        $limit = 8;
        $total_page = ceil($total_records / $limit);
        if ($current_page > $total_page){
            $current_page = $total_page;
        }
        else if ($current_page < 1){
            $current_page = 1;
        }
        $start = ($current_page - 1) * $limit;
        $results = $models->offset($start)->limit($limit)->get()->all();
        $config_language = app()->config_language;
        $translation = [];
        if(isset($config_language['lang'])){
            $translation = DB::table('announce_translation')->where('lang_code',$config_language['lang'])->get()->keyBy('_id')->all();
            foreach ($results as $key=>$value){
                if(isset($translation[$value->id])){
                    $value->title = $translation[$value->id]->title;
                    $value->message = $translation[$value->id]->message;
                }
            }
        }
        return $this->render('user.announce',[
            'results'=>$results,
            'pagination'=>[
                'current_page'=>$current_page,
                'total_page'=>$total_page,
            ]
        ]);
    }
}