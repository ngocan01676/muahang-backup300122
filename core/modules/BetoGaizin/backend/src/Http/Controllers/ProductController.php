<?php
namespace BetoGaizin\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use MissTerry\Http\Models\BookingModel;
class ProductController extends \Zoe\Http\ControllerBackend
{
    public function init()
    {
        $this->data['language'] = config('zoe.language');
        $this->data['configs'] = config_get("config", "system");
        $this->data['current_language'] =
            isset($this->data['configs']['core']['site_language']) ?
                $this->data['configs']['core']['site_language'] :
                config('zoe.default_lang');
    }
    public function list(){

    }
    public function create(){
        return $this->render('product.create');
    }
    public function edit(){
        return $this->render('product.edit');
    }
    public function status(){

    }
}