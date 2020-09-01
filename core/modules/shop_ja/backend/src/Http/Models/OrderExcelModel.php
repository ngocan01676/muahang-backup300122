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
}
