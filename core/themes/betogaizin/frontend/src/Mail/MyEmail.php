<?php
namespace BetoGaizinTheme\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class MyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data = [];
    public $subject = "";
    public $lang = '';
    public $results = [];
    public function __construct($alias,$data)
    {
        $this->results = Cache::remember('mail:Plugin:Contact:Email:'.$alias,60 , function () use($alias) {
            $results = DB::table('email_template')->where('alias',$alias)->where('id_key','Plugin:Contact:Email')->get()->keyBy('lang_code')->all();
            return $results;
        });
        $this->data = $data;
    }
    public function build()
    {
        if(isset($this->results[app()->config_language['lang']])){
            $info = $this->results[app()->config_language['lang']];
            $theme = app()->getTheme();
            return $this->view( $theme.'::emails.booking_'.$info->lang_code)
                ->from(config('mail.username'),$info->name)
                ->subject($info->subject)
                ->with($this->data);
        }
    }
}