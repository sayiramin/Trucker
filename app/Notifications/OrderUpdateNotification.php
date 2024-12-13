<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderUpdateNotification extends Notification
{
    use Queueable;

    public function __construct(public Order $order) {}

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Order Status Has Been Updated')
            ->line('The status of your order #' . $this->order->id . ' has been updated to ' . $this->order->status . '.')
            ->action('View Order', url('/orders/' . $this->order->id))
            ->line('Thank you for using our application!');
    }
}
