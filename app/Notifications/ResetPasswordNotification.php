<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $url = route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);

        $expire = (int) config('auth.passwords.users.expire', 15);

        return (new MailMessage)
            ->subject('Petunjuk Reset Kata Sandi - CurhatAman')
            ->greeting('Halo ' . $notifiable->name . ',')
            ->line('Kami menerima permintaan untuk mengatur ulang kata sandi akun CurhatAman Anda.')
            ->action('Reset Kata Sandi Sekarang', $url)
            ->line("Tautan reset ini akan kadaluarsa dalam waktu {$expire} menit.")
            ->line('Jika Anda tidak merasa meminta pemulihan akun ini, tidak ada tindakan lebih lanjut yang perlu dilakukan.');
    }
}
