<?php
namespace MissTerryTheme\Http\Controllers;
class HomeController extends \Zoe\Http\ControllerFront
{
    public function getLists()
    {
        return $this->render('home.list', []);
    }
    public function getRoom(){
        return $this->render('home.room', []);
    }
    public function getPricing(){
        return $this->render('home.pricing', []);
    }
    public function getRoomDetail(){
        return $this->render('home.detail', []);
    }
}