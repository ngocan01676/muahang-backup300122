<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
class Backend extends Authenticatable
{
    use Notifiable;
    public $guard = 'backend';
    protected $table = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function IsAcl($permission){
        if(empty($permission) || $this->username =="admin"){
            return true;
        }
        Cache::remember('role:'.$this->guard, 60, function()
        {
            return DB::table('role')
                ->select()->where('guard_name',$this->guard)->get();
        });
        $permissions = Cache::remember('permissions:'.$this->guard.":".$this->role_id, 60, function()
        {
            return DB::table('permissions')
                ->select()->where('role_id',$this->role_id)->get();
        });
        return $permissions->contains("name",$permission);
    }
    public function keyCache(){
        return $this->guard.":".$this->roleId;
    }
}
