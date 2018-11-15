<?php

namespace App\Notifications;

use App\Comment;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class DynamicNotifications extends Notification implements ShouldQueue
{
    use Queueable;

    private $model;

    private $table;

    private $message;

    private $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $model, $message)
    {
        $explode = explode('\\', $model);

        $this->user = $user;
        $this->message = $message;
        $this->model = $model;
        $this->table = str_plural(strtolower($explode[ count($explode) - 1 ]));
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'table' => $this->table
        ];
    }


    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'table' => $this->table,
            'message' => $this->message
        ]);
    }


    public function broadcastOn()
    {
        if (! auth()->user()->notificationsOn()) {
            return false;
        }
        return [
            new Channel('created')
        ];
    }
}
