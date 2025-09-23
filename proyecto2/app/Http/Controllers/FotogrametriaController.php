<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fotogrametria;
use App\Models\Aviso;
class FotogrametriaController extends Controller
{
    public function index() {
        $fotogramas = Fotogrametria::latest()->take(5)->get();
        $aviso = Aviso::latest()->first(); //Ultimo aviso (primero)
        return view('fotogrametria.index', compact('fotogramas', 'aviso'));
    }

    public function store(Request $request) {

        if($request->has('imagen')) {
            $foto = new Fotogrametria();
            $foto->imagen = $request->input('imagen'); //Base 64 directo
            $foto->save();
            return response()->json(['message' => 'Fotograma guardado con exito']);
        }
        return response()->json(['message' => 'No se recibió imagen'], 400);
    }
}
