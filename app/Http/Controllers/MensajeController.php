<?php
namespace App\Http\Controllers;

use App\Models\Mensaje;
use App\Models\MensajeAdjunto;
use Illuminate\Http\Request;

class MensajeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'contenido' => 'required|string',
            'denuncia_id' => 'required|exists:denuncias,id',
            'adjuntos.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        $mensaje = Mensaje::create([
            'contenido' => $request->contenido,
            'usuario_id' => auth()->id(),
            'denuncia_id' => $request->denuncia_id,
        ]);

        if ($request->hasFile('adjuntos')) {
            foreach ($request->file('adjuntos') as $archivo) {
                $path = $archivo->store('public/adjuntos');
                MensajeAdjunto::create([
                    'archivo' => $path,
                    'mensaje_id' => $mensaje->id,
                ]);
            }
        }

        return back()->with('success', 'Mensaje enviado.');
    }
}
