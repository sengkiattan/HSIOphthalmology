<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class PushDemo extends Notification
{
    use Queueable;
    public $title;
    public $body;
    public $queue_no;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title = null, $body = null, $queue_no = null)
    {
        $this->title = $title;
        $this->body = $body;
        $this->queue_no = $queue_no;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title($this->title)
            ->body($this->body)
            ->action('View Details', 'view_detail')
            ->data(['url' => route('searchQueue', $this->queue_no)]);
    }
}
