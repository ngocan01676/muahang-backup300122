<?php
namespace MissTerryTheme\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
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
            'sex' => 'required|integer|gt:0|lt:4',
            'number' => 'required|integer|gt:0|lt:7',
            'id' => 'required|integer|gt:0',
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
                        'user_id'=>0,
                        'fullname'=>$data['data']['fullname'],
                        'phone'=>$data['data']['phone'],
                        'email'=>$data['data']['email'],
                        'count'=>$data['data']['number'],
                        'sex'=>$data['data']['sex'],
                        'booking_date'=>formatDateYMD($data['data']['date']),
                        'booking_time'=>$data['data']['time'],
                        'status'=>0,
                        'price'=>0,
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
        return '
            BẠN ĐÃ ĐẶT LỊCH THÀNH CÔNG TRÊN HỆ THỐNG!
            Chúng tôi vừa gửi một email thông tin chi tiết qua email cho quý khách. 
            Quý khách vui lòng check email xem lại thông tin và chuẩn bị đến trước giờ chơi 15 phút để làm thủ tục nhận phòng chơi.
            Cám ơn quý khách đã tin tưởng & sử dụng dịch vụ của Miss Terry – Escape Room, Chúc quý khách có những giây phút trải nghiệm thú vị.
            Trân trọng cảm ơn!!
        ';
    }
    public function get_escape_room(){
        return $this->render('home.escape_room');
    }
    public function get_faqs(){
        return $this->render('home.faqs');
    }
    public function get_offer(){
        return $this->render('home.offer');
    }
    public function get_news(){
        return $this->render('home.news');
    }
    public function get_contact(){
        return $this->render('home.contact');
    }
}