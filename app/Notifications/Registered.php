<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class Registered extends Notification
{
    use Queueable;

    public static $doge;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public static $createUrlCallback;

    /**
     * create a new notification instance
     *
     * @param $doge
     */
    public function __construct($doge)
    {
        self::$doge = $doge;
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
        $verificationUrl = $this->verificationUrl($notifiable);
        return (new MailMessage)
            ->subject('New Registration')
            ->view('mail.registered', [
                "name"  => $notifiable->name,
                "code"  => $notifiable->code,
                "email" => $notifiable->email,
                "doge" => (object)[
                    "wallet" => self::$doge->wallet,
                ],
                "url" => $verificationUrl
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        if (static::$createUrlCallback) {
            return call_user_func(
                static::$createUrlCallback,
                $notifiable
            );
        }
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification())
            ]
        );
    }
}
