<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Satuan;

class PaketController extends Controller
{
    public function index()
    {
        $data = Paket::with('satuan')->paginate();
        $satuans = Satuan::all();
        // dd($data->toArray());

        return view('paket.index', compact('data', 'satuans'));
    }
    public function filter(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $data = Paket::whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->get();
        $satuans = Satuan::all();
        return view('paket.index', compact('data', 'satuans'));
    }

    public function create()
    {
        $satuans = Satuan::all();
        return view('paket.index', compact('satuans'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'paket_kuota' => 'required',
            'berat' => 'required',
            'harga' => 'required',
            'satuan_unit' => 'required',
            'cabang' => 'required',
        ]);

        Paket::create($validatedData);

        return redirect()->route('paket.index')
            ->with('success', 'Paket berhasil ditambahkan.');
    }

    public function nonaktif($id)
    {
        $Paket = Paket::findOrFail($id);

        $Paket->update([
            'status' => 'Nonaktif',
        ]);

        return redirect()->route('paket.index')->with('success', 'Data Paket berhasil dinonaktifkan.');
    }

    public function aktif($id)
    {
        $Paket = Paket::findOrFail($id);

        $Paket->update([
            'status' => 'Aktif',
        ]);

        return redirect()->route('paket.index')->with('success', 'Data Paket berhasil diaktifkan.');
    }
}
