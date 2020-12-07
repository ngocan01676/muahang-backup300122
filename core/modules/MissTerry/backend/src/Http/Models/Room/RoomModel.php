<?php

namespace MissTerry\Http\Models\Room;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RoomModel extends Model
{
    protected $table = 'miss_room';
    protected $fillable = ['views'];

    public $table_translation = "miss_room_translation";

    public function table_translation()
    {
        return DB::table($this->table . "_translation");
    }
}