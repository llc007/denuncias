<?php

// app/Notifications/DenunciaCreadaUsuario.php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DenunciaCreadaUsuario extends Notification
{
    use Queueable;

    public $denuncia;

    public function __construct($denuncia)
    {
        $this->denuncia = $denuncia;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Denuncia Creada')
            ->greeting('Hola ' . $notifiable->name)
            ->line('Tu denuncia ha sido creada exitosamente.')
            ->line('Folio: ' . $this->denuncia->folio)
            ->line('PIN: ' . $this->denuncia->pin)
            ->action('Ver Denuncia', url('/denuncias/' . $this->denuncia->id))
            ->line('Gracias por utilizar nuestro sistema.');
    }
}
