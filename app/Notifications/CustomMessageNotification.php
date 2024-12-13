<?php

// app/Notifications/CustomMessageNotification.php
namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomMessageNotification extends Notification
{
    use Queueable;

    public function __construct(public $message, public Order $order) {}

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Message Regarding Your Order')
            ->line($this->message)
            ->action('View Order', url('/orders/' . $this->order->id));
    }
}
