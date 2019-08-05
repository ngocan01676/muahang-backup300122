<?php

namespace Zoe\Http;
class ControllerBackend extends Controller
{
    public function render($view, $data = [])
    {
        return $this->_render($view, $data, "backend");
    }
}
