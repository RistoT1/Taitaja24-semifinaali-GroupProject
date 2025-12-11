<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;
use App\Models\EmailChangeToken;
use Carbon\Carbon;

class EmailChange extends Notification
{
    use Queueable;

    protected $user;
    protected $token;

    public function __construct($user)
    {
        $this->user = $user;

        // Generate a unique token and save it
        $this->token = Str::random(60);
        EmailChangeToken::create([
            'user_id' => $this->user->User_ID,
            'token' => $this->token,
            'expires_at' => Carbon::now()->addMinutes(60),
        ]);
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url(route('email.change', ['token' => $this->token]));

        return (new MailMessage)
            ->subject('Change Your Email')
            ->line('You requested to change your email address.')
            ->action('Change Email', $url)
            ->line('If you did not request this, you can safely ignore this email.');
    }

    public function toArray($notifiable)
    {
        return [];
    }
}

