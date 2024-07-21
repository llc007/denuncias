<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use App\Models\DenunciaAdjunto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DenunciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $denuncias = Denuncia::all();
        //dd($denuncias);

        $denunciasActivas = Denuncia::whereIn('estado', ['Nueva', 'En curso'])->get();
        $denunciasHistorial = Denuncia::whereIn('estado', ['Finalizada', 'Descartada'])->get();

        return view('denuncias.index', compact('denunciasActivas', 'denunciasHistorial'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('denuncias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'anonima' => 'required|boolean',
            'tipo_denuncia' => 'required|string|max:255',
            'donde_sucedio' => 'required|string',
            'cuando_sucedio' => 'required|date',
            'descripcion_hecho' => 'required|string',
            'adjuntos.*' => 'nullable|file|mimes:jpg,png,pdf,doc,docx|max:2048',
        ]);

        $userId = Auth::id();
        $numDenuncias = Denuncia::all()->count() + 1;

        // Formatear el ID del usuario y el número de denuncias a 3 cifras cada uno
        $userIdFormatted = str_pad($userId, 3, '0', STR_PAD_LEFT);
        $numDenunciasFormatted = str_pad($numDenuncias, 3, '0', STR_PAD_LEFT);
        $folio = $userIdFormatted . $numDenunciasFormatted;

        $pin = Str::random(8);

        $denuncia = Denuncia::create([
            'anonima' => $request->get('anonima'),
            'tipo_denuncia' => $request->get('tipo_denuncia'),
            'donde_sucedio' => $request->get('donde_sucedio'),
            'cuando_sucedio' => $request->get('cuando_sucedio'),
            'descripcion_hecho' => $request->get('descripcion_hecho'),
            'estado' => 'Nueva', // Estado inicial
            'folio' => $folio,
            'pin' => $pin,
            'user_id' => Auth::id(),
        ]);

        if ($request->hasFile('adjuntos')) {
            foreach ($request->file('adjuntos') as $archivo) {
                $path = $archivo->store('adjuntos');
                DenunciaAdjunto::create([
                    'denuncia_id' => $denuncia->id,
                    'archivo' => $path,
                ]);
            }
        }

        return redirect()->route('denuncias.index')
            ->with('success', 'Denuncia creada exitosamente. Guarda este folio: ' . $folio . ' y pin: ' . $pin);
    }


    /**
     * Display the specified resource.
     */
    public function show(Denuncia $denuncia)
    {
        //
        return view('denuncias.show', compact('denuncia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Denuncia $denuncia)
    {
        //
        return view('denuncias.edit', compact('denuncia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Denuncia $denuncia)
    {
        $request->validate([
            'anonima' => 'required|boolean',
            'tipo_denuncia' => 'required|string|max:255',
            'donde_sucedio' => 'required|date',
            'cuando_sucedio' => 'required|date',
            'descripcion_hecho' => 'required|string',
            'estado' => 'required|string',
            'adjuntos.*' => 'nullable|file|mimes:jpg,png,pdf,doc,docx|max:2048',
        ]);

        $denuncia->update([
            'anonima' => $request->get('anonima'),
            'tipo_denuncia' => $request->get('tipo_denuncia'),
            'donde_sucedio' => $request->get('donde_sucedio'),
            'cuando_sucedio' => $request->get('cuando_sucedio'),
            'descripcion_hecho' => $request->get('descripcion_hecho'),
            'estado' => $request->get('estado'),
        ]);

        if ($request->hasFile('adjuntos')) {
            foreach ($request->file('adjuntos') as $archivo) {
                $path = $archivo->store('adjuntos');
                DenunciaAdjunto::create([
                    'denuncia_id' => $denuncia->id,
                    'archivo' => $path,
                ]);
            }
        }

        return redirect()->route('denuncias.index')
            ->with('success', 'Denuncia actualizada exitosamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Denuncia $denuncia)
    {
        $denuncia->delete();

        return redirect()->route('denuncias.index')
            ->with('success', 'Denuncia eliminada exitosamente.');
    }
}
