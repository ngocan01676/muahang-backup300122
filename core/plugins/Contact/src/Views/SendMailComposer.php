<?php
namespace PluginContact\Views;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Mail;
use MissTerryTheme\Mail\MyEmail;
class SendMailComposer extends \Zoe\Views\ComposerView
{
    public function init()
    {
        $this->config($this);
    }
    public function compose(View $view){
        $data = $view->getData();

        if($view->name() == $data['view']){
            $request = request();
            $id = (int)base_64_de($request->id)/10000;
            $miss_booking = DB::table('miss_booking')->where('id',$id)->get()->all();

            if(isset($miss_booking[0])){
                $to_email = $miss_booking[0]->email;
                $results = DB::table('miss_room')->where('status',1)->where('id',$miss_booking[0]->room_id)->get()->all();
                if(isset($results[0])){
                    $result = $results[0];
                    $translation = DB::table('miss_room_translation')->where('lang_code',app()->site_language)->where('room_id',$result->id)->get()->all();
                    if(isset($translation[0])){
                        $result->title = $translation[0]->title;
                        $result->description = $translation[0]->description;
                        $result->content = $translation[0]->content;
                        $result->address = $translation[0]->address;
                        $result->info = $translation[0]->info;
                    }else{
                        $result->title = "";
                        $result->description = "";
                        $result->content = "";
                        $result->info = "";
                        $result->address  = "";
                    }
                    $data = [
                        'fullname'=>$miss_booking[0]->fullname,
                        'phone'=>$miss_booking[0]->phone,
                        'booking_date'=>$miss_booking[0]->booking_date,
                        'booking_time'=>$miss_booking[0]->booking_time,
                        'price'=>$miss_booking[0]->price,
                        'count'=>$miss_booking[0]->count,
                        'title'=>$result->title,
                        'email'=>$miss_booking[0]->email,
                        'address'=>$result->address,
                    ];

                   // Mail::to($to_email)->send(new MyEmail('booking',$data));

                }
            }
        }
    }
}