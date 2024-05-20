<?php

namespace App\Http\Controllers;

use App\Models\Grooming; 
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class GroomingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groomings = Grooming::all();
        return view('grooming.index', compact('groomings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('grooming.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'foto_produk' => 'required|image|mimes:jpeg,png,jpg,gif',
            'nama_produk' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'required|array', // Kategori sekarang merupakan array
            'kategori.*.nama' => 'required', // Validasi untuk setiap kategori
            'kategori.*.harga' => 'required|numeric', // Validasi untuk setiap kategori
            'kategori.*.diskon' => 'numeric', // Validasi untuk setiap kategori
        ]);

        // Simpan foto_produk
        $foto_produk = $request->file('foto_produk')->store('produk');

        // Simpan data produk
        $grooming = Grooming::create([
            'foto_produk' => $foto_produk,
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
        ]);

        // Simpan kategori
        foreach ($request->kategori as $kategoriData) {
            $kategori = new Kategori([
                'nama' => $kategoriData['nama'],
                'harga' => $kategoriData['harga'],
                'diskon' => $kategoriData['diskon'] ?? 0, // Jika diskon tidak diset, maka 0
            ]);

            $kategori->harga_final = $kategori->harga - ($kategori->harga * ($kategori->diskon / 100));

            $grooming->kategoris()->save($kategori);
        }

        return redirect()->route('grooming.index')
                        ->with('success', 'Produk Grooming berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $grooming = Grooming::findOrFail($id);
        return view('grooming.show', compact('grooming'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $grooming = Grooming::findOrFail($id);
        return view('grooming.edit', compact('grooming'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'foto_produk' => 'required',
            'nama_produk' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'required',
            'harga' => 'required',
            'diskon' => 'required',
        ]);

        $grooming = Grooming::findOrFail($id);
        $grooming->update($request->all());

        return redirect()->route('grooming.index')
                        ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $grooming = Grooming::findOrFail($id);
        $grooming->delete();

        return redirect()->route('grooming.index')
                        ->with('success', 'Produk berhasil dihapus.');
    }
}
