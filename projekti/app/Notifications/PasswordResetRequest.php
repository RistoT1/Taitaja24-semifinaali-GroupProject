<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\PasswordChangeToken;

class PasswordResetRequest extends Notification
{
    use Queueable;

    protected $user;
    protected $token;

    public function __construct($user)
    {
        $this->user = $user;

        // Delete previous tokens
        PasswordChangeToken::where('user_id', $user->User_ID)->delete();

        // Create new token
        $this->token = Str::random(64);

        PasswordChangeToken::create([
            'user_id' => $user->User_ID,
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
        $resetUrl = route('password.show.reset', ['token' => $this->token]);

        return (new MailMessage)
            ->subject('Reset Your Password')
            ->line('Click the button below to reset your password.')
            ->action('Reset Password', $resetUrl)
            ->line('This link will expire in 60 minutes.')
            ->line('If you did not request a password reset, ignore this email.');
    }
}
