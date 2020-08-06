<?php

namespace User\Http\Controllers;

use Illuminate\Http\Request;
use \User\Http\Model\Role;

class RoleController extends \Zoe\Http\ControllerBackend
{
    public function list()
    {
        $allRoles = Role::all();
        return $this->render('role.list', [
            'lists' => $allRoles
        ], 'user');
    }
    public function permission($id,$guard,Request $request)
    {
        $modelRole = new Role();
        if($request->isXmlHttpRequest()){
            $post = $request->all();
            $modelRole->SaveData($id,$guard,isset($post['data'])?$post['data']:[]);
            return $post;
        }
        return $this->render('role.premission', [
            'user_permissions' => $modelRole->GetPermissions($id),
            'global_permissions' => app()->getPermissions(),
            'id'=>$id,
            'guard'=>$guard,
        ], 'user');
    }
}

