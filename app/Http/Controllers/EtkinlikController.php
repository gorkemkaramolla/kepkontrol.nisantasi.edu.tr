<?php

namespace App\Http\Controllers;

use App\Models\Etkinlik;
use Illuminate\Http\Request;

class EtkinlikController extends Controller
{
    public function index()
    {
        return Etkinlik::all();
    }

    public function store(Request $request)
    {
        /*return Etkinlik::create($request->all());*/
    }

    public function show(Request $request, $id)
    {
        $query = Etkinlik::where('OGR_NO', $id);
        // Check if query parameters are provided
        if ($request->has('AYNI_FAKULTE')) {
            $query->where('AYNI_FAKULTE', 'Fakülte/MYO içi');
        } else if ($request->has('FARKLI_FAKULTE')) {
            $query->where('AYNI_FAKULTE', 'Fakülte/MYO dışı');
        }
        if ($request->has('TAMAMLANDI')) {
            $query->where('KATILIM', 'Tamamlandı');
        } else if ($request->has('TAMAMLANMADI')) {
            $query->where('KATILIM', '');
        }
        $etkinlik = $query->get();
        return response()->json($etkinlik);
    }

    public function update(Request $request, $id)
    {
        /*$etkinlik = Etkinlik::findOrFail($id);
        $etkinlik->update($request->all());
        return $etkinlik;*/
    }

    public function destroy($id)
    {
        /*$etkinlik = Etkinlik::findOrFail($id);
        $etkinlik->delete();
        return response()->json(null, 204);*/
    }
}
