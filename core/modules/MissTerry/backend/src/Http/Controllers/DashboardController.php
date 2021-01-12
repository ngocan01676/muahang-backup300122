<?php
namespace MissTerry\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use User\Http\Model\Permission;
use User\Http\Model\Role;
use Admin\Http\Controllers\DashboardController as DashboardC;

class DashboardController extends DashboardC{
    public function list(Request $request){
        return $this->render('dashboard.list',[],'MissTerry');
    }
}