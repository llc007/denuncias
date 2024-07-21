<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DenunciaAdjunto extends Model
{
    use HasFactory;

    protected $fillable = [
        'denuncia_id',
        'archivo',
    ];

    public function denuncia()
    {
        return $this->belongsTo(Denuncia::class);
    }
}
