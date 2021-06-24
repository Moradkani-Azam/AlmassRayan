<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StatusUpdate extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if($this->order->status == 0) {
            $text = 'New order is added by '. $this->order->user->name .'. Please check your Panel';
            $url ='/admin/orders/' . $this->order->id;
        } elseif($this->order->status == 1) {
            $text = 'Your Order with id: ' . $this->order->id . ' and title: ' . $this->order->title . ' is  priced.' .' Please check your Panel';
            $url = 'orders/'. $this->order->id;
        } elseif($this->order->status == -1) {
            $text = 'Your Order with id: ' . $this->order->id . ' and title: ' . $this->order->title . ' is  Rejectd.';
            $url = 'orders/'. $this->order->id;
        }

        return (new MailMessage)
                    ->subject('Order Status')
                    ->line($text)
                    ->action('Go to panel', url($url))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
