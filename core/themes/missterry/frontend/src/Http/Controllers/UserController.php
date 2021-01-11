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

        $results = DB::table('miss_booking')->where('email',$user->email)->get()->all();
        return $this->render('user.orders',['results'=>$results,'rooms'=>$miss_room]);
    }
    public function get_announce(){
        return $this->render('user.announce',[]);
    }
}