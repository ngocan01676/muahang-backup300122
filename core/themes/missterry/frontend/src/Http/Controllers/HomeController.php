<?php
namespace MissTerryTheme\Http\Controllers;
class HomeController extends \Zoe\Http\ControllerFront
{
    public function getLists()
    {
        return $this->render('home.list', []);
    }
}