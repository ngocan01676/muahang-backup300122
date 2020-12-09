<?php

namespace MissTerry\Http\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BookingModel extends Model
{
    protected $table = 'miss_booking';
    protected $fillable = [];

    public function table_translation()
    {
        return DB::table($this->table . "_translation");
    }
}