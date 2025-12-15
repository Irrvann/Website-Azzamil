<?php

namespace App\Http\Controllers;

use App\Models\Reviewer;
use Illuminate\Http\Request;

class ReviewerController extends Controller
{
    //
    public function index()
    {
        $dataReviewer = Reviewer::paginate(10);
        return view('shared.reviewer.index', compact('dataReviewer'));
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'nama' => 'required|string|max:255',
            ],
            [
                'nama.required' => 'Nama reviewer wajib diisi.',
                'nama.string' => 'Nama reviewer harus berupa teks.',
                'nama.max' => 'Nama reviewer maksimal 255 karakter.',
            ]
        );

        Reviewer::create([
            'nama' => $request->nama,
        ]);
        return redirect()->route('superadmin.reviewer.index')->with('success', 'Reviewer berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        //
        $request->validate(
            [
                'nama' => 'required|string|max:255',
            ],
            [
                'nama.required' => 'Nama reviewer wajib diisi.',
                'nama.string' => 'Nama reviewer harus berupa teks.',
                'nama.max' => 'Nama reviewer maksimal 255 karakter.',
            ]
        );

        $reviewer = Reviewer::findOrFail($id);  
        $reviewer->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('superadmin.reviewer.index')->with('success', 'Reviewer berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // ambil data, kalau tidak ada -> 404
        $reviewer = Reviewer::findOrFail($id);

        // hapus data
        $reviewer->delete();

        // redirect dengan pesan sukses
        return redirect()->route('superadmin.reviewer.index')
            ->with('success', 'Data reviewer berhasil dihapus.');
    }
}
