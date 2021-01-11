<?php
namespace MissTerryTheme\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $theme = config_get('theme', "active");
        return $this->view($theme.'::emails.booking')
            ->from('tigoncms@gmail.com','Missterry')
            ->subject('this is test email subject')
            ->with([
                'FULL_NAME'     => "anh trung",
                'ADDRESS'     => "dong anh ha noi",
            ]);
//        return $this
//             ->from('Missterry',"Missterry")
//            ->subject("test email")
//            ->html("<p> Your E-mail has been sent successfully. </p>");
    }
}