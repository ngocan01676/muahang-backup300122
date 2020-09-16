<?php

namespace ShopJa\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderExcelModel extends Model
{
    protected $table = 'shop_order_excel_session';
    protected $fillable = [];

    public function GetDetails(){
        return DB::table('shop_order_excel')->where('session_id',$this->id)->get()->all();
    }
    public function ShowAll($user_id){
        $lists = DB::table('shop_order_excel_session')->where('admin_id',$user_id)->where('status',1)->get()->all();
        $datas = [];
        foreach ($lists as $key=>$value){
           $shop_order_excel =  DB::table('shop_order_excel')->where('session_id',$value->id)->get()->all();
           foreach ($shop_order_excel as $_key=>$_value){
               $datas[] = $_value;
           }
        }
        return $datas;
    }
}
