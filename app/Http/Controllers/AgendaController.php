<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        $keyword = trim((string) $request->get('q', ''));

        $agendas = Agenda::query()
            ->when($keyword !== '', function ($query) use ($keyword) {
                $search = mb_strtolower($keyword);

                return $query->where(function ($query) use ($search) {
                    $query->whereRaw('LOWER(agenda_name) LIKE ?', ['%' . $search . '%'])
                        ->orWhereRaw('LOWER(description) LIKE ?', ['%' . $search . '%']);
                });
            })
            ->get()
            ->map(function ($item) {
                return [
                    'id'          => $item->id,
                    'title'       => $item->agenda_name,
                    'description' => $item->description,
                    'start'       => $item->start_date,
                    'end'         => $item->end_date,
                ];
            });

        return response()->json([
            'code' => 200,
            'msg'  => 'Data berhasil diambil',
            'data' => $agendas,
        ]);
    }
}
