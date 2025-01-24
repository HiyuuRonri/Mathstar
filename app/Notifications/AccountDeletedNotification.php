<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class AccountDeletedNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
{
    return (new MailMessage)
        ->subject('Account Deletion Notice')
        ->line('Your account has been scheduled for deletion.')
        ->line('You have 24 hours to recover your account.')
        ->action('Recover Account', route('account.recover', ['email' => $notifiable->email]))
        ->line('If no action is taken, your account will be permanently deleted.');
}

}
