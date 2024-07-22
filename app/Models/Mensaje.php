<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    protected $fillable = [
        'contenido',
        'usuario_id',
        'denuncia_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function denuncia()
    {
        return $this->belongsTo(Denuncia::class);
    }

    public function adjuntos()
    {
        return $this->hasMany(MensajeAdjunto::class);
    }
}
