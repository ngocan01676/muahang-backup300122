<?php
namespace MissTerryTheme\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use User\Http\Model\Member;
use Illuminate\Support\Facades\Hash;
use Validator;
class UserController extends \Zoe\Http\ControllerFront
{
    public function storeInfo(Request $request){
        $data = $request->all();
        $filter = [
            'name' => 'required|max:255',
        ];
        $user = Auth('frontend')->user();
        if ($user) {
            $model = Member::find($user->id);
            $type = 'edit';
            if(!empty($data['password_1']) || !empty($data['password_2'])){
                $filter['password_1'] = 'required|min:6';
                $filter['password_2'] = 'required|min:6';
                $filter['password_current'] = 'required|min:6';
            }
            if($model->name != $data['name']){
                $filter['name'].= '|unique:user';
            }
            if(isset($data['phone']) && !empty($data['phone'])){
                $filter['phone']= 'required|max:15';
            }
            if($model->phone != $data['phone']){
                $filter['phone']= '|unique:user';
            }
            $validator = Validator::make($data,$filter, [
            ]);
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $count = 0;
            if(isset( $filter['password_current'])){
                if (!Hash::check($data['password_current'], $model->password)) {
                    $count++;
                    $validator->getMessageBag()->add('password_current', z_language('Mật khẩu cũ không đúng'));
                }
            }
            if(isset($data['password_1']) && isset($data['password_2']) &&  $data['password_1'] !=  $data['password_2']){
                $count++;
                $validator->getMessageBag()->add('password_1', z_language('Mật khẩu không khớp'));
            }

            try {
                if($count == 0){
                    if(isset($filter['name']))
                    $model->name = $data['name'];
                    $model->fullname = $data['fullname'];
                    if($model->phone != $data['phone']) {
                        $model->phone = $data['phone'];
                    }
                    if(isset($filter['password_1']))
                        $model->password = Hash::make( $data['password_1']);
                    $model->save();
                    $request->session()->flash('success', $type == "create"?z_language('User is added successfully'):z_language('User is updated successfully'));
                    return back();
                }
            }catch (\Exception $ex){
                $validator->getMessageBag()->add('name', $ex->getMessage());
            }
            return back()
                ->withErrors($validator)
                ->withInput();
        }
    }

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
        $user = Auth('frontend')->user();
        $this->addDataGlobal("Blog-featured-style",  2);
        $this->addDataGlobal("Blog-featured-background",  'theme/missterry/images/IMG_2769-1.jpg');
        $this->addDataGlobal("Blog-featured-title",  z_language('MY ACCOUNT'));
        $this->addDataGlobal("User-Menu-Router",$request->route()->getName());
        $item = DB::table('user')->where('id',$user->id)->get()->all();
        return $this->render('user.info',['item'=>isset($item[0])?$item[0]:null]);
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

        $results = $results->offset($start)->limit($limit)->orderBy('id','desc')->get()->all();

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
    public function get_chat(){
        return $this->render('user.chat',[]);
    }
}