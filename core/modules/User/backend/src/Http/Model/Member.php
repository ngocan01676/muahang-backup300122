<?php

namespace User\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Member extends Authenticatable
{
    protected $table = 'user';
    protected $fillable = [ 'name', 'email', 'password', 'facebook_id' ];
}