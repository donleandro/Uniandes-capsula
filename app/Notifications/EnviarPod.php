<?php

namespace App\Notifications;


use App\Correo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EnviarPod extends Notification
{
    use Queueable;

    private $image;
    private $pod;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( $pod , $image)
    {
        $this->image = $image;
        $this->pod = $pod;
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
      // dd($this->image);
        return (new MailMessage)
                    ->line('Un mensaje de tu "yo" del pasado...')
                    ->line('Ha viajado en el tiempo y llega a ti un año después...')
                    ->action($this->image, url(\Config::get('app.url')."/storage/".$this->image))
                    ->line($this->pod->mensaje);
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
