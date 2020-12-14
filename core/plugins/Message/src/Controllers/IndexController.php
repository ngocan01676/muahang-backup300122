<?php
namespace PluginMessage\Controllers;
use Admin\Http\Models\PageModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
class IndexController extends \Zoe\Http\ControllerBackend
{
    public function list(Request $request)
    {
        return $this->render('index.list', [

        ],'pluginMessage');
    }
}