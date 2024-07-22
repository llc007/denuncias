<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MensajeAdjunto extends Model
{
    use HasFactory;

    protected $fillable = [
        'archivo',
        'mensaje_id',
    ];

    public function mensaje()
    {
        return $this->belongsTo(Mensaje::class);
    }
}

