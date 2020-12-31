<?php
namespace MissTerryTheme\Http\Controllers;
use Illuminate\Support\Facades\DB;

class HomeController extends \Zoe\Http\ControllerFront
{
    public function getLists()
    {
        return $this->render('home.list', []);
    }
    public function getRoom(){
        return $this->render('home.room', []);
    }
    public function getPricing(){
        return $this->render('home.pricing', []);
    }
    public function getRoomDetail($slug){

        $results = DB::table('miss_room')->get()->where('status',1)->where('slug',$slug)->all();

        if(count($results)  == 1){

            $result = array_pop($results);

            $images = DB::table('plugin_gallery')
                ->where('name','GalleryComposer')
                ->where('key_group','MissTerry::form.room')->where('key_id',$result->id)->get()->all();

            $result->prices = json_decode($result->prices,true);
            $result->times = json_decode($result->times,true);
            if(isset($this->_language['lang'])){
                $translation = DB::table('miss_room_translation')->where('lang_code',$this->_language['code'])->where('room_id',$result->id)->get()->all();

                if(isset($translation[0])){
                    $result->title = $translation[0]->title;
                    $result->description = $translation[0]->description;
                    $result->content = $translation[0]->content;
                }
            }
            if(isset($images[0])){
                $images[0]->data = unserialize($images[0]->data);
                $result->images =  $images[0];
            }else{
                $result->images = [];
            }
            return $this->render('home.detail', ['result'=> $result]);
        }else{
            redirect('/error/404');
        }
    }
}