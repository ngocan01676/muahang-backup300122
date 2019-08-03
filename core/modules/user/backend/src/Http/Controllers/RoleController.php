<?php
namespace User\Http\Controllers;
use \User\Http\Model\Role;
class RoleController extends \Zoe\Http\ControllerBackend{
    public function list(){
        $allRoles  = Role::all();
        return view('user::controller.role.list',[
            'lists'=>$allRoles
        ]);
    }
}