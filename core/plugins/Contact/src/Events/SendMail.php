<?php
namespace PluginContact\Events;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
class SendMail
{
    use SerializesModels;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }
    public function broadcastOn()
    {
        return [];
    }
}