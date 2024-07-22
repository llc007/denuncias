<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    use HasFactory;

    protected $fillable = [
        'anonima',
        'tipo_denuncia',
        'donde_sucedio',
        'cuando_sucedio',
        'descripcion_hecho',
        'estado',
        'folio',
        'pin',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function adjuntos()
    {
        return $this->hasMany(DenunciaAdjunto::class);
    }

    public function mensajes()
    {
        return $this->hasMany(Mensaje::class);
    }

}

