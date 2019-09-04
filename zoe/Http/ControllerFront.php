<?php
namespace Zoe\Http;
class ControllerFront extends Controller
{

    public function render($view, $data = [], $key = "theme")
    {
        $this->layout = "zoe::layout-7-094bde12-ffeb-4fdc-ae8e-a5c1a80e2d9f";
        $alias = app()->getConfig()['views']['alias'];
        $data = array_merge($this->data, $data);
        $request = request();
        $keyName = app()->getKey("_view_alias");
        $_view_alias = isset($request->route()->defaults[$keyName]) ? $request->route()->defaults[$keyName] : "";

        if (isset($alias['backend'][$_view_alias . ":" . $view])) {
            $keyView = $alias['backend'][$_view_alias . ":" . $view];
        } else if (isset($_view_alias)) {
            $keyView = $_view_alias . '::controller.' . $view;
        } else {
            $keyView = $view;
        }
        return $this->_render($keyView, $data, $key);
    }
}
