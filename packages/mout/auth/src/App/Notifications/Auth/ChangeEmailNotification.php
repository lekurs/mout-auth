<?php

namespace App\Notifications\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

class ChangeEmailNotification extends Notification
{
    use Queueable;

    /**
     * @var string
     */
    protected $email;

    /**
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(config('app.name') . ' - ' . trans('laravel-auth::laravel-auth.change.email.subject'))
            ->line(trans('laravel-auth::laravel-auth.change.email.line'))
            ->action(trans('laravel-auth::laravel-auth.change.email.cta'), $this->verifyRoute($notifiable))
            ->line(trans('laravel-auth::laravel-auth.change.email.warn'));
    }

    /**
     * Returns the Reset URl to send in the Email
     *
     * @param AnonymousNotifiable $notifiable
     * @return string
     */
    protected function verifyRoute($notifiable): string
    {
        return URL::temporarySignedRoute('email.verify', 60 * 60, [
            'id' => $notifiable->getKey(),
            'email' => $this->email,
            'hash' => sha1($notifiable->getEmailForVerification()),
        ]);
    }
}
