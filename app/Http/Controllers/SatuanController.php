<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Satuan;

class SatuanController extends Controller
{
    public function index()
    {
        $satuans = Satuan::all();
        return view('satuan.index', compact('satuans'));
    }

    public function create()
    {
        return view('satuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'satuan_unit' => 'required',
            'deskripsi' => 'required',
        ]);

        Satuan::create([
            'satuan_unit' => $request->satuan_unit,
            'deskripsi' => $request->deskripsi,
            'status' => 'Aktif',
        ]);

        return redirect()->route('satuan.index')->with('success', 'Satuan berhasil ditambahkan');
    }

    public function show($id)
    {
        $satuan = Satuan::findOrFail($id);
        return view('satuan.show', compact('satuan'));
    }

    public function edit($id)
    {
        $satuan = Satuan::findOrFail($id);
        return view('satuan.edit', compact('satuan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'satuan_unit' => 'required',
            'deskripsi' => 'required',
        ]);

        $satuan = Satuan::findOrFail($id);
        $satuan->update([
            'satuan_unit' => $request->satuan_unit,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('satuan.index')->with('success', 'Satuan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $satuan = Satuan::findOrFail($id);
        $satuan->delete();

        return redirect()->route('satuan.index')->with('success', 'Satuan berhasil dihapus');
    }

    public function nonaktif($id)
    {
        $satuan = Satuan::findOrFail($id);

        $satuan->update([
            'status' => 'Nonaktif',
        ]);

        return redirect()->route('satuan.index')->with('success', 'Data satuan berhasil dinonaktifkan.');
    }

    public function aktif($id)
    {
        $satuan = Satuan::findOrFail($id);

        $satuan->update([
            'status' => 'Aktif',
        ]);

        return redirect()->route('satuan.index')->with('success', 'Data satuan berhasil diaktifkan.');
    }
}
