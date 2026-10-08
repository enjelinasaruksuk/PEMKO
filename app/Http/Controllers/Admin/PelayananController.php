<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KomponenPelayanan;
use Illuminate\Http\Request;

class PelayananController extends Controller
{
    public function index()
    {
        $komponenList = KomponenPelayanan::latest()->get();

        return view('pages.admin.pelayanan.index', compact('komponenList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_komponen' => 'required|string|max:255',
            'kategori' => 'required|in:Penyampaian,Pengelolaan',
        ]);

        KomponenPelayanan::create($request->only('nama_komponen', 'kategori'));

        return redirect()->route('admin.pelayanan.index')->with('success', 'Komponen berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_komponen' => 'required|string|max:255',
            'kategori' => 'required|in:Penyampaian,Pengelolaan',
        ]);

        $komponen = KomponenPelayanan::findOrFail($id);
        $komponen->update($request->only('nama_komponen', 'kategori'));

        return redirect()->route('admin.pelayanan.index')->with('success', 'Komponen berhasil diperbarui.');
    }

    public function destroy($id)
    {
        KomponenPelayanan::findOrFail($id)->delete();

        return redirect()->route('admin.pelayanan.index')->with('success', 'Komponen berhasil dihapus.');
    }
}