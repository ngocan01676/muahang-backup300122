<?php

namespace User\Http\Controllers;
class UserController extends \Zoe\Http\ControllerBackend
{
    public function list()
    {
        return $this->render('user.list', [], 'user');
    }
}