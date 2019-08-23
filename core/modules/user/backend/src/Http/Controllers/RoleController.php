<?php

namespace User\Http\Controllers;

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
}