<?php
namespace MissTerryTheme\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
class HomeController extends \Zoe\Http\ControllerFront
{
    public $config_language = [];
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->config_language = app()->config_language;
    }

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
            $prices = json_decode($result->prices,true);
            $result->prices = [];
            foreach ($prices as $key=>$value){
                $result->prices[$key] = $value;
                $result->prices[$key]['keys'] = explode('-',$key);
            }
            if(empty($result->prices_event)){
                $result->prices_event = [];
            }else{
                $prices_event = json_decode($result->prices_event,true);
                $result->prices_event = [];
                foreach ($prices_event as $key=>$value){
                    $result->prices_event[$key] = $value;
                    $result->prices_event[$key]['keys'] = explode('-',$key);
                }
            }
            $result->times = json_decode($result->times,true);
            if(isset($this->_language['lang'])){
                $translation = DB::table('miss_room_translation')->where('lang_code',$this->_language['code'])->where('room_id',$result->id)->get()->all();

                if(isset($translation[0])){
                    $result->title = $translation[0]->title;
                    $result->description = $translation[0]->description;
                    $result->content = $translation[0]->content;
                    $result->address = $translation[0]->address;
                    $result->info = $translation[0]->info;
                }else{
                    $result->title = "";
                    $result->description = "";
                    $result->content = "";
                    $result->info = "";
                    $result->address  = "";
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
    public function action_register_room(Request $request){
        $data = $request->all();
        $validator = Validator::make($data['data'], [
            'fullname' => 'required|max:255',
            'phone' => 'required|max:15',
            'time' => 'required|regex:/(\d+\:\d+)/',
            'date' => 'required|date_format:d-m-Y',
            'email' => 'required|email|max:255',
//            'sex' => 'required|integer|gt:0|lt:4',
            'number' => 'required|integer|gt:0|lt:7',
            'id' => 'required|integer|gt:0',
            'price' => 'required|integer|gt:0',
        ]);
        $rules = [];

        if ($validator->passes()) {
            DB::beginTransaction();
            try{
                $booking_date = formatDateYMD($data['data']['date']);
                $count = DB::table('miss_booking')
                    ->where('room_id',$data['data']['id'])
                    ->where('booking_date',$booking_date)
                    ->where('booking_time',$data['data']['time'])
                    ->count();
                if($count == 0){
                    $id = DB::table('miss_booking')->insertGetId([
                        'room_id'=>$data['data']['id'],
                        'user_id'=>auth('frontend')->user()?auth('frontend')->user()->id:0,
                        'fullname'=>$data['data']['fullname'],
                        'phone'=>$data['data']['phone'],
                        'email'=>$data['data']['email'],
                        'count'=>$data['data']['number'],
                        'sex'=>isset($data['data']['sex'])?$data['data']['sex']:0,
                        'booking_date'=>formatDateYMD($data['data']['date']),
                        'booking_time'=>$data['data']['time'],
                        'status'=>0,
                        'price'=>$data['data']['price'],
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s'),
                    ]);
                    $response =  response()->json(['success' => $data,'id'=>$id,'uri'=>router_frontend_lang('home:register_room_oke',['slug'=>Str::slug($data['data']['fullname']),'id'=>base_64_en($id*10000)])]);
                    DB::commit();
                    return $response;
                }else{
                    return response()->json(['errors' => [
                        'fullname'=>[z_language('Thơi gian :DATE :TIME đã có người đặt',['DATE'=>$booking_date,"TIME"=>$data['data']['time']])]], 'data_rules' => $rules]);
                }
            }catch (\Exception $ex){
                DB::rollBack();
                return response()->json(['errors' => ['fullname'=>[$ex->getMessage()]], 'data_rules' => $rules]);
            }
        }else{
            return response()->json(['errors' => $validator->errors(), 'data_rules' => $rules]);
        }
        return json_encode($data);
    }
    public function register_room_oke($slug,$id){
        $id = (int)base_64_de($id)/10000;
        $results = DB::table('miss_booking')->where('id',$id)->get()->all();
        if(isset($results[0])){

        }
        $this->addDataGlobal("Blog-featured-background",  'uploads/room/background/background.png');
        return $this->render('home.register_room_oke');
    }
    public function get_escape_room(){
        return $this->render('home.escape_room');
    }
    public function get_faqs(){
        $results = DB::table('plugin_faq')->where('status',1)->get()->all();
        $config_language = app()->config_language;
        if(isset($config_language['lang'])){
            $translation = DB::table('plugin_faq_translation')->where('lang_code',$config_language['lang'])->get()->keyBy('_id')->all();
            $this->addDataGlobal("Blog-featured-title",z_language('Frequently Asked Questions'));
            $this->addDataGlobal("Blog-featured-style",2);
            $this->addDataGlobal("Blog-featured-background", '/theme/missterry/images/IMG_2769-1.jpg');
            foreach ($results as $key=>$value){
                if(isset($translation[$value->id])){
                    $value->title = $translation[$value->id]->title;
                    $value->content = $translation[$value->id]->content;
                }
            }
        }
        return $this->render('home.faqs',['results'=>$results]);
    }
    public function get_offer(){

        if(isset($this->config_language['lang'])){
            $results = DB::table('categories_translation')->where('_id',50)->where('lang_code',$this->config_language['lang'])->get()->all();

            $this->addDataGlobal("Blog-featured-title",$results[0]->name);

            $models = DB::table('blog_post')->where('blog_post.category_id',$results[0]->_id);
            $models->join('blog_post_translation as rt', 'rt._id', '=', 'blog_post.id');
            $models->where('lang_code',$this->config_language['lang']);
            $total_records = $models->count();

            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            $limit = 4;
            $total_page = ceil($total_records / $limit);
            if ($current_page > $total_page){
                $current_page = $total_page;
            }
            else if ($current_page < 1){
                $current_page = 1;
            }

            $start = ($current_page - 1) * $limit;
            $results = $models->offset($start)->limit($limit)->get()->all();

            return $this->render('home.offer',[
                'results'=>$results,
                'pagination'=>[
                    'current_page'=>$current_page,
                    'total_page'=>$total_page,
                ]
            ]);
        }
    }
    public function get_news(){
        if(isset($this->config_language['lang'])){
            $results = DB::table('categories_translation')->where('_id',12)->where('lang_code',$this->config_language['lang'])->get()->all();

            $this->addDataGlobal("Blog-featured-title",$results[0]->name);
            $this->addDataGlobal("Blog-featured-style",2);
            $this->addDataGlobal("Blog-featured-background", '/theme/missterry/images/IMG_2769-1.jpg');
            $models = DB::table('blog_post')->where('blog_post.category_id',$results[0]->_id);
            $models->join('blog_post_translation as rt', 'rt._id', '=', 'blog_post.id');
            $models->where('lang_code',$this->config_language['lang']);
            $total_records = $models->count();

            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            $limit = 4;
            $total_page = ceil($total_records / $limit);
            if ($current_page > $total_page){
                $current_page = $total_page;
            }
            else if ($current_page < 1){
                $current_page = 1;
            }

            $start = ($current_page - 1) * $limit;
            $results = $models->offset($start)->limit($limit)->get()->all();

            return $this->render('home.blog-list',[
                'results'=>$results,
                'pagination'=>[
                    'current_page'=>$current_page,
                    'total_page'=>$total_page,
                ]
            ]);
        }
        return $this->render('home.news');
    }
    public function get_contact(){
        return $this->render('home.contact');
    }
    public function get_blog_people_talk_about_about($slug){

        $config_language = app()->config_language;
        $result = [];
        if(isset($config_language['lang'])){
            $db = DB::table('blog_post_translation')->where('slug',$slug)->get()->all();
            if(count($db) > 0){
                $results = DB::table('blog_post')->where('id',$db[0]->_id)->get()->all();
                if(isset($results[0])){
                    $result = $results[0];
                    $result->title = $db[0]->title;
                    $result->content = $db[0]->content;
                    $result->slug = $db[0]->content;
                    $this->addDataGlobal("Blog-featured-title",$result->title);
                }
            }
        }
        return $this->render('home.blog-item',['result'=>$result,'url'=>url()->current()]);
    }
    public function get_blog_item($slug){

        $config_language = app()->config_language;
        $result = [];
        if(isset($config_language['lang'])){
            $db = DB::table('blog_post_translation')->where('slug',$slug)->get()->all();
            if(count($db) > 0){
                $results = DB::table('blog_post')->where('id',$db[0]->_id)->get()->all();
                if(isset($results[0])){
                    $result = $results[0];
                    $result->title = $db[0]->title;
                    $result->content = $db[0]->content;
                    $result->slug = $db[0]->content;
                    $this->addDataGlobal("Blog-featured-title",$result->title);
                }
            }
        }
        return $this->render('home.blog-item',['result'=>$result,'url'=>url()->current()]);
    }
    public function get_list_blog_category($slug){

      //  $this->addDataGlobal("Blog-featured-title",$result->title);
        if(isset($this->config_language['lang'])){
            $results = DB::table('categories_translation')->where('slug',$slug)->where('lang_code',$this->config_language['lang'])->get()->all();

            $this->addDataGlobal("Blog-featured-style",2);
            $this->addDataGlobal("Blog-featured-background",  'theme/missterry/images/IMG_2769-1.jpg');
            $this->addDataGlobal("Blog-featured-title",$results[0]->name);

            $models = DB::table('blog_post')->where('blog_post.category_id',$results[0]->_id);
            $models->join('blog_post_translation as rt', 'rt._id', '=', 'blog_post.id');
            $models->where('lang_code',$this->config_language['lang']);
            $total_records = $models->count();

            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            $limit = 4;
            $total_page = ceil($total_records / $limit);
            if ($current_page > $total_page){
                $current_page = $total_page;
            }
            else if ($current_page < 1){
                $current_page = 1;
            }

            $start = ($current_page - 1) * $limit;
            $results = $models->offset($start)->limit($limit)->get()->all();

            return $this->render('home.blog-list',[
                'results'=>$results,
                'pagination'=>[
                    'current_page'=>$current_page,
                    'total_page'=>$total_page,
                ]
            ]);
        }
    }
    public function get_franchise(){

        $this->addDataGlobal("Blog-featured-style",  1);
        $this->addDataGlobal("Blog-featured-background",  'theme/missterry/images/IMG_2769-1.jpg');
        $this->addDataGlobal("Blog-featured-height",  '268px');
        $this->addDataGlobal("Blog-featured-title",  z_language('Nhượng quyền thương mại'));
        return $this->render('home.franchise');
    }
    public function get_Tag(){

        $this->addDataGlobal("Blog-featured",  false);

        return $this->render('home.tag');
    }
}