<?php
namespace MissTerry\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use MissTerry\Http\Models\BookingModel;
class BookingController extends \Zoe\Http\ControllerBackend
{
    public function init()
    {
        $this->data['language'] = config('zoe.language');
        $this->data['nestables'] = config_get("category", "blog:category");
        $this->data['configs'] = config_get("config", "blog");

        $this->data['current_language'] =
            isset($this->data['configs']['room']['language']['default']) ? $this->data['configs']['room']['language']['default'] : config('zoe.default_lang');

        $select = [
            'room.*',

            'rt.title'
        ];
        $miss_room = DB::table('miss_room as room');
        $miss_room->join('miss_room_translation as rt', 'rt.room_id', '=', 'room.id');
        $miss_room->where('rt.lang_code',  $this->data['current_language'] );
        $miss_room->select($select);
        $this->data['miss_room'] = $miss_room->get()->keyBy('id')->all();
    }
    public function getCrumb()
    {
        $this->breadcrumb('List Room',('backend:miss_terry:booking:list'));
        return $this;
    }
    public function user(Request $request){
        $user_id = $request->id;
        $user_name = base_64_de($request->username);
        $this->breadcrumb(z_language('Membership'), ('backend:member:list'))
            ->breadcrumb(z_language('Info Booking : :USERNAME',['USERNAME'=>$user_name]),'backend:'.\ModuleMissTerry\Module::$key.':booking:user');

        $search = $request->query('search', "");
        $status = $request->query('status', "");
        $this->data['key'] = "core:module:miss_terry:booking:user";
        $config = config_get('option',  $this->data['key']);
        $data = $request->query();
        $page = null;
        if (isset($data['action'])) {
            $page = 1;
        }
        $parameter = $data;
        $route = [];
        $item = isset($config['pagination']['item']) ? $config['pagination']['item'] : 20;
        $select = [];
        $models = DB::table('miss_booking as b');
        $models->where('user_id',$user_id);
//        $models->where('	user_id',$user_id);

//        if (isset($search) && !empty($search) || isset($parameter["filter"]['name']) && !empty($parameter['filter']['name']) && $search = $parameter['filter']['name']) {
//
//            $models->where('title', 'like', '%' . $search . '%');
//        }

        if (isset($parameter["filter"]['room']) && !empty($parameter['filter']['room'])) {
            $models->where('room_id', $parameter['filter']['room']);
        }
        if (!empty($status) || $status != "") {
            $models->where('status', $status);
        }
        if (!isset($parameter['order_by'])) {
            $parameter['order_by']['col'] = 'id';
            $parameter['order_by']['type'] = 'desc';
        } else {
            if (isset($parameter['action'])) {
                $parameter['order_by']['type'] = isset($parameter['order_by']['type']) && $parameter['order_by']['type'] == "desc" ? "asc" : "desc";
            }
        }
        if (isset($parameter['action'])) {
            unset($parameter['action']);
        }
        $lang = $this->data['current_language'];
        $models = $models->paginate($item, ['*'], 'page', $page);
        $models->appends($parameter);

        $miss_room = $this->data['miss_room'];
        $miss_user = DB::table('user')->get()->keyBy('id')->all();


        $this->data['analytics'] = [];

        $date_start = "";
        $date_end = "";

        $count = DB::table('miss_booking')->where('user_id',$user_id)->where('status',1);

        if(!empty($date_start) && !empty($date_end)){
            $count->where('created_at','>=',$date_start.' 00:00:00');
            $count->where('created_at','<=',$date_end.' 00:00:00');
        }

        $this->data['analytics']['count'] = $count->count('id');

        $count = DB::table('miss_booking')->where('user_id',$user_id)->where('status',1);
        if(!empty($date_start) && !empty($date_end)){
            $count->where('created_at','>=',$date_start.' 00:00:00');
            $count->where('created_at','<=',$date_end.' 00:00:00');
        }
        $this->data['analytics']['price'] = $count->sum('price');
        $this->data['analytics']['cash'] = DB::table('miss_user_meta')->where('user_id')->select('coin')->limit(1)->get()->all();

        return $this->render('booking.user', [
            'models' => $models,
            "route" => $route,
            'parameter' => $parameter,
            'callback' => [
                "get_room" => function ($model) use ($lang,$miss_room) {
                    if(isset($miss_room[$model->room_id])){
                        return $miss_room[$model->room_id]->title;
                    }
                    return z_language('Empty');
                },
                "get_user" => function ($model) use ($lang,$miss_user) {
                    if($model->user_id > 0){
                        return $miss_user[$model->user_id]->name;
                    }
                    return $model->fullname;
                }
            ],
        ],'MissTerry');
    }
    public function booking(Request $request){
        $results = DB::table('miss_room')->where('status',1)->get()->all();
        $config_language = app()->config_language;
        $translation = [];
        if(isset($config_language['lang'])){

            $translation = DB::table('miss_room_translation')->where('lang_code',$config_language['lang'])->get()->keyBy('room_id')->all();
            foreach ($results as $key=>$value){
                $prices = json_decode($value->prices,true);
                $value->prices = [];

                foreach ($prices as $k=>$v){
                    $value->prices[$k] = $v;
                    $value->prices[$k]['keys'] = explode('-',$k);
                }

                if(empty($value->prices_event)){
                    $value->prices_event = [];
                }else{
                    $prices_event = json_decode($value->prices_event,true);
                    $value->prices_event = [];
                    foreach ($prices_event as$k=>$v){
                        if(!isset($result->prices_event[$v['date']])){
                            $value->prices_event[$v['date']] = [];
                        }
                        $value->prices_event[$v['date']][$k] = $v;
                        $value->prices_event[$v['date']][$k]['keys'] = explode('-',$v['user']);
                    }
                }
                if(isset($translation[$value->id])){
                    $value->title = $translation[$value->id]->title;
                    $value->slug = empty($translation[$value->id]->slug) || is_null($translation[$value->id]->slug)  ?$value->slug:$translation[$value->id]->slug;
                    $value->address = $translation[$value->id]->address;
                    $value->info = $translation[$value->id]->info;
                    $value->description = $translation[$value->id]->description;
                    $value->content = $translation[$value->id]->content;
                }
            }
        }
        return $this->render('booking.booking', [
            'data'=>['results'=>$results]
        ]);
    }
    public function list(Request $request){
        $this->getCrumb();
        $search = $request->query('search', "");
        $status = $request->query('status', "");
        $this->data['key'] = "core:module:miss_terry:booking";
        $config = config_get('option',  $this->data['key']);
        $data = $request->query();

        $page = null;
        if (isset($data['action'])) {
            $page = 1;
        }
        $parameter = $data;
        $route = [];
        $item = isset($config['pagination']['item']) ? $config['pagination']['item'] : 20;

        $select = [];

        $models = DB::table('miss_booking as b');

        if (isset($search) && !empty($search) || isset($parameter["filter"]['fullname']) && !empty($parameter['filter']['fullname']) && $search = $parameter['filter']['fullname']) {

            $models->where('fullname', 'like', '%' . $search . '%');
        }

        if (isset($parameter["filter"]['room']) && !empty($parameter['filter']['room'])) {
            $models->where('room_id', $parameter['filter']['room']);
        }
        if (!empty($status) || $status != "" || isset($parameter["filter"]['status']) && !empty($parameter['filter']['status']) && $status = $parameter['filter']['status']) {
            if($status == 2){
                $status = 0;
            }
            if($status!="all"){
                $models->where('status', $status);
            }
        }
        if (!isset($parameter['order_by'])) {
            $parameter['order_by']['col'] = 'id';
            $parameter['order_by']['type'] = 'desc';

        } else {
            if (isset($parameter['action'])) {
                $parameter['order_by']['type'] = isset($parameter['order_by']['type']) && $parameter['order_by']['type'] == "desc" ? "asc" : "desc";
            }
        }
        if (isset($parameter['action'])) {
            unset($parameter['action']);
        }
        $lang = $this->data['current_language'];
        $models->orderBy($parameter['order_by']['col'], $parameter['order_by']['type']);
//        $models->select([]);
        $models = $models->paginate($item, ['*'], 'page', $page);
        $models->appends($parameter);

        $miss_room = $this->data['miss_room'];

        $miss_user = DB::table('user')->get()->keyBy('id')->all();
        $current_language =  $this->data['current_language'];

        return $this->render('booking.list', [
            'models' => $models,
            "route" => $route,
            'parameter' => $parameter,
            'callback' => [
                "get_room" => function ($model) use ($lang,$miss_room,$current_language) {
                    if(isset($miss_room[$model->room_id])){
                       $translation = DB::table('miss_room_translation')->where('room_id',$model->room_id)->where('lang_code',$current_language)->get()->all();
                       if(isset($translation[0])){
                            return $translation[0]->title;
                       }
                       return z_language('Empty Lang');
                    }
                    return z_language('Empty');
                },
                "get_user" => function ($model) use ($lang,$miss_user) {
                    if($model->user_id > 0){
                        return $miss_user[$model->user_id]->name;
                    }
                    return $model->fullname;
                }
            ],
        ]);
    }
    public function create()
    {
        $this->getCrumb()->breadcrumb('Create Booking', ('backend:miss_terry:booking:create'));
        return $this->render('booking.create', ['item' => []]);
    }
    public function edit($id)
    {
        $this->getCrumb()->breadcrumb(z_language('Edit Booking'), ('backend:miss_terry:booking:edit'));
        $model = BookingModel::find($id);
        return $this->render('booking.edit', ["model" => $model]);
    }
    public function store(Request $request)
    {
        $data = $request->all();
        if(isset($data['act']) && isset($data['data']) ){

            $date = explode('/',$data['data']['booking_date']);
            $results = [];
            if($data['act'] == 'check_all_date'){
                $results = DB::table('miss_booking')
                    ->where('booking_date',$date[2].'-'.$date[1].'-'.$date[0])
                    ->where('room_id',$data['data']['room_id'])
                    ->where('status',1);
                if(isset($data['data']['id']) && $data['data']['id'] >0 ){
                    $results->where('id','!=',$data['data']['id']);
                }
                $results = $results->get()->all();
                return response()->json(['status'=>count($results)==0,'results'=>$results]);
            }else{
                $results = DB::table('miss_booking')
                    ->where('booking_time',$data['data']['booking_time'])
                    ->where('booking_date',$date[2].'-'.$date[1].'-'.$date[0])
                    ->where('room_id',$data['data']['room_id'])
                    ->where('status',1);
                if(isset($data['data']['id']) && $data['data']['id'] >0 ){
                    $results->where('id','!=',$data['data']['id']);
                }
                $results = $results->get()->all();
                return response()->json(['status'=>count($results)==0,'results'=>isset($results[0])?$results[0]:[]]);
            }

        }
        $validator = Validator::make($data, [
            'fullname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'count' => 'required',
            'room_id' => 'required',
            'booking_date' => 'required',
            'price' => 'required',
        ], [
            'image.required' => 'The Image is Required.',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        if (isset($data['id']) && !empty($data['id'])) {
            $model = BookingModel::find($data['id']);
        } else {
            $model = new BookingModel();
        }

        $model->fullname = isset($data['fullname'])?$data['fullname']:"";
        $model->phone = isset($data['phone'])?$data['phone']:"";
        $model->email = isset($data['email'])?$data['email']:"";
        $model->count = isset($data['count'])?$data['count']:"";
        $model->room_id = isset($data['room_id'])?$data['room_id']:"";
        $date = explode('/',$data['booking_date']);
        $model->booking_date = $date[2].'-'.$date[1].'-'.$date[0];
        $model->booking_time = isset($data['booking_time'])?$data['booking_time']:"";
        $model->price = isset($data['price'])?$data['price']:"";
        $model->sex = isset($data['sex'])?$data['sex']:"";
        $model->status = isset($data['status'])?$data['status']:"";

        DB::beginTransaction();
        try {
            $model->save();
            DB::commit();
            return back();
        } catch (\Exception $ex) {
            $validator->getMessageBag()->add('id', $ex->getMessage());
            DB::rollBack();
        }
        return back()
            ->withErrors($validator)
            ->withInput();
    }
}