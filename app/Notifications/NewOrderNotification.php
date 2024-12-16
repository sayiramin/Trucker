<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewOrderNotification extends Notification
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     */
    public function __construct($order)
    {
        $this->order = $order; // Pass order data
    }

    /**
     * Get the delivery channels.
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the database representation.
     */
    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'customer_name' => $this->order->user->name,
            'customer_email' => $this->order->user->email,
            'order_weight' => $this->order->weight,
            'pickup_address' => $this->order->pickup_address,
            'delivery_address' => $this->order->delivery_address,
            'message' => 'A new order has been placed.'
        ];
    }
}
