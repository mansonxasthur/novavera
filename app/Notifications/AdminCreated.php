<?php

namespace App\Notifications;

use App\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AdminCreated extends Notification
{
    use Queueable;


    public $user;
    public $password;

    /**
     * Create a new notification instance.
     *
     * @param Admin $user
     * @param string $password
     */
    public function __construct(Admin $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
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
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Welcome ' . $this->user->name)
            ->from('no-reply@novaverarealestate.com')
            ->markdown('mail.admin.create', ['user' => $this->user, 'password' => $this->password]);
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
