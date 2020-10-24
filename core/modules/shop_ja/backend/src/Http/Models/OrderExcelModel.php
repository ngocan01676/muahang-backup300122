<?php

namespace ShopJa\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderExcelModel extends Model
{
    protected $table = 'shop_order_excel_session';
    protected $fillable = [];

    public function GetDetails(){
        $shop_order_excel = DB::table('shop_order_excel')->where('session_id',$this->id)->orderBy('id')->get()->all();
        foreach ($shop_order_excel as $_key=>$_value){
            $datas[] = $_value;
        }
        usort($datas, function ($a,$b){
            return $a->pay_method - $b->pay_method;
        });
        return $datas;
    }
    public function ShowAll($user_id,$date,$company){
//        $lists = DB::table('shop_order_excel_session')
////            ->where('admin_id',$user_id)
//            ->where('status',1)
//            ->where('created_at','>=',$date." 00:00:00")
//            ->where('created_at','<=',$date." 23:59:59")
//            ->get()->all();
        $datas = [];
        $date_last = date('Y-m-d',strtotime('-1 day', strtotime($date)));
      //  foreach ($lists as $key=>$value){
           $shop_order_excel =  DB::table('shop_order_excel')
               ->where('public',1)
               ->where('company', $company )
               ->where('order_create_date','>=',$date_last." 00:00:00")
               ->where('order_create_date','<=',$date." 23:59:59")->orderBy('id')->get()->all();
           foreach ($shop_order_excel as $_key=>$_value){
               $datas[] = $_value;
           }
     //   }
        usort($datas, function ($a,$b){
            return $a->pay_method - $b->pay_method;
        });
        return $datas;
    }
    public function searchAll($user_id,$par = []){

        $shop_order_excel =  DB::table('shop_order_excel');
        if(!empty($par['company'])){
            $shop_order_excel->where('company',$par['company']);
        }
        if(!empty($par['fullname'])){
            $shop_order_excel->where('fullname', 'like', '%'.$par['fullname'].'%');
        }
        if(!empty($par['address'])){
            $shop_order_excel->where('address', 'like', '%'.$par['address'].'%');
        }
        if(!empty($par['zipcode'])){
            $shop_order_excel->where('zipcode', '=', $par['zipcode']);
        }

        $shop_order_excel  = $shop_order_excel->get()->all();
        $datas = [];



        foreach ($shop_order_excel as $_key=>$_value){
            $datas[] = $_value;
        }

        return $datas;
    }
}
