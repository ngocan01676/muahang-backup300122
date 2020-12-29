<?php
namespace MissTerryTheme\OurRoom;
use Illuminate\Support\Facades\DB;
function Main(){
    return DB::table('miss_room')->where('status',1)->get()->all();
}