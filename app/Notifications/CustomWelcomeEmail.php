<?php

namespace App\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
class CustomWelcomeEmail extends Notification
{
    use Queueable;
    protected $user;
    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
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
    {// generate link verifikasi email
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            ['id' => $this->user->id, 'hash' => sha1($this->user->email)]
        );
        //  $loginUrl = url('/login');
         return (new MailMessage)
            ->subject('Selamat Datang di LabSchedule 🎉')
            ->greeting('Halo, ' . $this->user->name . ' 👋')
            ->line('Terima kasih telah bergabung dengan aplikasi **LabSchedule**!')
            ->line('Berikut adalah detail akun Anda:')
            ->line('📧 Email: ' . $this->user->email)
            ->line('👤 Username: ' . $this->user->username)
            // ->line('🔑 Password: ' . $this->user->username) // *Sebaiknya password jangan dikirim via email demi keamanan*
            ->line('Silakan klik tombol di bawah untuk melakukan verifikasi email:')
            ->action('Verifikasi Email', $verificationUrl)
            ->line('Terima kasih, dan sampai jumpa di aplikasi LabSchedule! 🚀');

            // ->line('Klik tombol di bawah untuk Login ke app:')
            // ->action('Login Sekarang', $loginUrl)
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
