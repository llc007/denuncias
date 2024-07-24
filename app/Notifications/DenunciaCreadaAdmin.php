<?php

// app/Notifications/DenunciaCreadaAdmin.php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DenunciaCreadaAdmin extends Notification
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
            ->subject('Nueva Denuncia Creada')
            ->greeting('Hola Administrador')
            ->line('Se ha creado una nueva denuncia.')
            ->action('Ver Denuncia', url('/admin/denuncias/' . $this->denuncia->id))
            ->line('Gracias por utilizar nuestro sistema.');
    }
}
