<?php
namespace PluginFaq;
use Zoe\Module as ZModule;
class Plugin extends ZModule
{
    public static $configName = "Faq:Control";
    public static $configOption = "core:plugin:Faq:Control:List";
    public static $configRouter = "backend:plugin:Faq:Control";

    public function Init()
    {

    }
}