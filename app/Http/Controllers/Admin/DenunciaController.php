<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Denuncia;
use Illuminate\Http\Request;

class DenunciaController extends Controller
{
    public function index()
    {
        $denuncias = Denuncia::all();
        return view('admin.denuncias.index', compact('denuncias'));
    }

    public function show(Denuncia $denuncia)
    {
        return view('admin.denuncias.show', compact('denuncia'));
    }

    public function edit(Denuncia $denuncia)
    {
        return view('admin.denuncias.edit', compact('denuncia'));
    }

    public function update(Request $request, Denuncia $denuncia)
    {
        $data = $request->validate([
            'estado' => 'required|string',
            // otros campos que se pueden actualizar
        ]);

        $denuncia->update($data);

        return redirect()->route('admin.denuncias.index')->with('success', 'Denuncia actualizada con éxito.');
    }

    public function destroy(Denuncia $denuncia)
    {
        $denuncia->delete();
        return redirect()->route('admin.denuncias.index')->with('success', 'Denuncia eliminada con éxito.');
    }
}
