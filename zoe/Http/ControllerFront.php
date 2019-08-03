<?php
namespace Zoe\Http;
class ControllerFront extends Controller
{
    public function render($view){
        return $this->_render($view,"backend");
    }
}
