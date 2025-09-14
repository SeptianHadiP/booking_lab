<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailSubmitSchedule extends Notification
{
    use Queueable;
 protected $schedule;
    /**
     * Create a new notification instance.
     */
    public function __construct($schedule)
    {
         $this->schedule = $schedule;
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
       return (new MailMessage)
                    ->subject('Jadwal Praktikum Berhasil Diajukan')
                    ->greeting('Halo ' . $notifiable->name . '!')
                    ->line('Jadwal praktikum "' . $this->schedule->judul_praktikum . '" berhasil ditambahkan.')
                    ->line('Tanggal: ' . $this->schedule->tanggal_praktikum)
                    ->line('Waktu: ' . $this->schedule->waktu_praktikum)
                    ->line('Laboratorium: ' . $this->schedule->laboratorium->nama_ruangan)
                    ->action('Lihat Jadwal', url('/schedulings'))
                    ->line('Terima kasih.');
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
