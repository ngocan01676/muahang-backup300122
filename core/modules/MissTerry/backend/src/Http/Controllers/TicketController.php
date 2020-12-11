<?php
namespace MissTerry\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use MissTerry\Http\Models\Room\RoomModel;
class RoomController extends \Zoe\Http\ControllerBackend
{
    public function init()
    {
        $this->data['language'] = config('zoe.language');
        $this->data['nestables'] = config_get("category", "blog:category");
        $this->data['configs'] = config_get("config", "blog");
        $this->data['current_language'] =
            isset($this->data['configs']['room']['language']['default']) ? $this->data['configs']['room']['language']['default'] : "vi";
    }

    public function getCrumb()
    {
        $this->breadcrumb('List Room', ('backend:miss_terry:room:list'));
        return $this;
    }
}