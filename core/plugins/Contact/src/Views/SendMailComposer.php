<?php
namespace PluginContact\Views;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
class SendMailComposer extends \Zoe\Views\ComposerView
{
    public function init()
    {
        $this->config($this);
    }
    public function compose(View $view){
       // $data = $view->getData();
       // dd($data);
      //  Mail::to($to_email)->send(new MyEmail('booking',$data));
    }
}