<?php
namespace ShopJa\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends \Admin\Http\Controllers\DashboardController
{

    public function list(Request $request)
    {
        $this->breadcrumb(z_language("QL CTV"), route('backend:dashboard:list'));
        $this->breadcrumb(z_language("Thông tin"), "");

        $date_start = $request->get('date_start','');
        $date_end = $request->get('date_end','');
        $categorys = config_get("category", "shop-ja:product:category");
        $this->data['analytics']['category'] = [];
        $user_id = null;

        if(!is_null($request->id)){
            $user_id = base64_decode($request->id);
        }else if(!Auth::user()->IsAcl("dashboard:all")){
            $user_id = Auth::user()->id;
        }
        foreach($categorys as $category){
            if($category['name'] == "SIM"){
                continue;
            }
            $query = DB::table('shop_order_excel')
                ->where('fullname','!=','')
                ->where('company',$category['name']);
            if(!is_null($user_id)){
                $query->where('admin_id',$user_id);
            }
            if(!empty($date_start) && !empty($date_end)){
                $query->where('updated_at','>=',$date_start." 00:00:00");
                $query->where('updated_at','<=',$date_end." 23:59:59");
            }

            $this->data['analytics']['category'][$category['name']] = [];

            $this->data['analytics']['category'][$category['name']]['count'] = $query->count();

            $price = DB::table('shop_order_excel')
                ->where('fullname','!=','')
                ->where('company',$category['name'])
                ->where('updated_at','>=',$date_start." 00:00:00")
                ->where('updated_at','<=',$date_end." 23:59:59");

            if(!is_null($user_id)){
                $price->where('admin_id',$user_id);
            }
            $this->data['analytics']['category'][$category['name']]['price'] =  $price->sum('order_price');
        }

        $this->data['analytics']['total'] = DB::table('shop_order_excel')
            ->where('fullname','!=','');

        if(!is_null($user_id)){
            $this->data['analytics']['total']->where('admin_id',$user_id);
        }
        if(!empty($date_start) && !empty($date_end)){
            $this->data['analytics']['total']->where('updated_at','>=',$date_start." 00:00:00");
            $this->data['analytics']['total']->where('updated_at','<=',$date_end." 23:59:59");
        }
        $this->data['analytics']['total'] = $this->data['analytics']['total']->count();

        $this->data['analytics']['success'] = DB::table('shop_order_excel')
            ->where('fullname','!=','')->where('status',1);
        if(!is_null($user_id)){
            $this->data['analytics']['success']->where('admin_id',$user_id);
        }
        if(!empty($date_start) && !empty($date_end)) {

            $this->data['analytics']['success']->where('updated_at', '>=', $date_start . " 00:00:00");
            $this->data['analytics']['success']->where('updated_at', '<=', $date_end . " 23:59:59");
        }
        $this->data['analytics']['success'] =  $this->data['analytics']['success']->where('status',1)->count();

        $this->data['analytics']['padding'] = DB::table('shop_order_excel')
            ->where('fullname','!=','')
           ;
        if(!is_null($user_id)){
            $this->data['analytics']['padding']->where('admin_id',$user_id);
        }
        if(!empty($date_start) && !empty($date_end)) {

            $this->data['analytics']['padding']->where('updated_at', '>=', $date_start . " 00:00:00");
            $this->data['analytics']['padding']->where('updated_at', '<=', $date_end . " 23:59:59");
        }
        $this->data['analytics']['padding'] = $this->data['analytics']['padding']->where('status',2)->count();
        $this->data['analytics']['cancel'] = DB::table('shop_order_excel')
            ->where('fullname','!=','')
            ;
        if(!is_null($user_id)){
            $this->data['analytics']['cancel']->where('admin_id',$user_id);
        }
        if(!empty($date_start) && !empty($date_end)) {
            $this->data['analytics']['cancel']->where('updated_at', '>=', $date_start . " 00:00:00");
            $this->data['analytics']['cancel']->where('updated_at', '<=', $date_end . " 23:59:59");
        }
        $this->data['analytics']['cancel'] = $this->data['analytics']['cancel']->where('status',2)->count();

        $this->data['analytics']['today'] = DB::table('shop_order_excel')
            ->where('fullname','!=','')
            ->where('updated_at','>=',$date_start." 00:00:00")
            ->where('updated_at','<=',$date_end." 23:59:59");
        if(!is_null($user_id)){
            $this->data['analytics']['today']->where('admin_id',$user_id);
        }
        $this->data['analytics']['today'] =  $this->data['analytics']['today']->count();

        $this->data['analytics']['price'] = DB::table('shop_order_excel')
            ->where('fullname','!=','')
            ->where('updated_at','>=',$date_start." 00:00:00")
            ->where('updated_at','<=',$date_end." 23:59:59");

        if(!is_null($user_id)){
            $this->data['analytics']['price']->where('admin_id',$user_id);
        }
        $this->data['analytics']['price'] =  $this->data['analytics']['price']->sum('order_price');

        return $this->render('dashboard.user',[]);
    }

}