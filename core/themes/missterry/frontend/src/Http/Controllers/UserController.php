<?php
namespace MissTerryTheme\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class UserController extends \Zoe\Http\ControllerFront
{
    public function getdashboard(Request $request)
    {
        $this->addDataGlobal("Blog-featured-style",  2);
        $this->addDataGlobal("Blog-featured-background",  'theme/missterry/images/IMG_2769-1.jpg');
        $this->addDataGlobal("Blog-featured-title",  z_language('MY ACCOUNT'));
        $this->addDataGlobal("User-Menu-Router",$request->route()->getName());
        return $this->render('user.dashboard',[]);
    }
    public function getinfo(Request $request)
    {
        $this->addDataGlobal("Blog-featured-style",  2);
        $this->addDataGlobal("Blog-featured-background",  'theme/missterry/images/IMG_2769-1.jpg');
        $this->addDataGlobal("Blog-featured-title",  z_language('MY ACCOUNT'));
        $this->addDataGlobal("User-Menu-Router",$request->route()->getName());
        return $this->render('user.info',[]);
    }
    public function getorders(Request $request){
        $this->addDataGlobal("Blog-featured-style",  2);
        $this->addDataGlobal("Blog-featured-background",  'theme/missterry/images/IMG_2769-1.jpg');
        $this->addDataGlobal("Blog-featured-title",  z_language('MY ACCOUNT'));
        $this->addDataGlobal("User-Menu-Router",$request->route()->getName());
        return $this->render('user.orders',[]);
    }
}