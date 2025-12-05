<?php

namespace App\Http\Controllers;

use App\Models\Daerah;
use Illuminate\Http\Request;

class DaerahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $dataDaerah = Daerah::all();
        return view('superadmin.daerah.index', compact('dataDaerah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'nama_daerah' => 'required|string|max:255',
            ],
            [
                'nama_daerah.required' => 'Nama daerah wajib diisi.',
                'nama_daerah.string' => 'Nama daerah harus berupa teks.',
                'nama_daerah.max' => 'Nama daerah maksimal 255 karakter.',
            ]
        );

        Daerah::create([
            'nama_daerah' => $request->nama_daerah,
        ]);
        return redirect()->route('superadmin.daerah.index')->with('success', 'Daerah berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Daerah $daerah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Daerah $daerah)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Daerah $daerah, $id)
    {
        //
        $request->validate(
            [
                'nama_daerah' => 'required|string|max:255',
            ],
            [
                'nama_daerah.required' => 'Nama daerah wajib diisi.',
                'nama_daerah.string' => 'Nama daerah harus berupa teks.',
                'nama_daerah.max' => 'Nama daerah maksimal 255 karakter.',
            ]
        );

        $daerah = Daerah::findOrFail($id);

        $daerah->update([
            'nama_daerah' => $request->nama_daerah,
        ]);

        return redirect()->route('superadmin.daerah.index')->with('success', 'Daerah berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Daerah $daerah, $id)
    {
        // ambil data, kalau tidak ada -> 404
        $daerah = Daerah::findOrFail($id);

        // hapus data
        $daerah->delete();

        // redirect dengan pesan sukses
        return redirect()->route('superadmin.daerah.index')
            ->with('success', 'Data daerah berhasil dihapus.');
    }
}
