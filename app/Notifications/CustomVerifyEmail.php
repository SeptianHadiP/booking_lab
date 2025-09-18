<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $notifiable->id, 'hash' => sha1($notifiable->email)]
        );

        return (new MailMessage)
        ->subject('Verifikasi Alamat Email Anda')
        ->greeting('Halo ' . $notifiable->name . ',')
        ->line('Terima kasih telah mendaftar di LabSchedule.')
        ->line('Untuk menyelesaikan proses pendaftaran, silakan konfirmasi alamat email Anda dengan mengklik tombol di bawah ini:')
        ->action('Verifikasi Alamat Email', $verificationUrl)
        ->line('Apabila Anda tidak merasa melakukan pendaftaran akun di LabSchedule, abaikan email ini.')
        ->salutation('Hormat kami, Tim LabSchedule');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
