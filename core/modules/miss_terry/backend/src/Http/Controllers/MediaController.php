<?php
namespace MissTerry\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use MissTerry\Http\Models\Room\RoomModel;
class MediaController extends \Zoe\Http\ControllerBackend
{
    public function init()
    {

    }

    public function getCrumb()
    {
        return $this;
    }
    public function list(){

    }
}