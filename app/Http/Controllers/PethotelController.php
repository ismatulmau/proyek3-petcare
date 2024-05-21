<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pethotel;

class PethotelController extends Controller
{
    public function index()
    {
        $pethotels = Pethotel::all();
        return view('pethotel.index', compact('pethotels'));
    }

    public function create()
    {
        return view('pethotel.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'foto_produk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'kategori_nama' => 'required|array',
        'kategori_nama.*' => 'required',
        'kategori_harga.*' => 'required|numeric',
        'kategori_diskon.*' => 'required|numeric', 
        'kategori_total.*' => 'required|numeric', 
    ]);

    $imageName = time().'.'.$request->foto_produk->extension();
    $request->foto_produk->move(public_path('images'), $imageName);

    $pethotel = new Pethotel([
        'foto_produk' => $imageName,
    ]);
    $pethotel->save();

    $kategoriNamas = $request->input('kategori_nama');
    $kategoriHargas = $request->input('kategori_harga');
    $kategoriDiskons = $request->input('kategori_diskon');
    $kategoriTotals = $request->input('kategori_total');

    foreach ($kategoriNamas as $key => $nama) {
        $kategori = [
            'nama' => $nama,
            'harga' => $kategoriHargas[$key],
            'diskon' => $kategoriDiskons[$key],
            'total_harga' => $kategoriTotals[$key],
        ];
        $pethotel->kategoris()->create($kategori);
    }

    return redirect()->route('pethotel.index')->with('success', 'Pethotel created successfully.');
}


    public function show(string $id)
    {
        $pethotel = Pethotel::findOrFail($id);
        return view('pethotel.show', compact('pethotel'));
    }

    public function edit(string $id)
    {
        $pethotel = Pethotel::findOrFail($id);
        return view('pethotel.edit', compact('pethotel'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'foto_produk' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric',
            'diskon' => 'required|numeric',
        ]);

        $pethotel = Pethotel::findOrFail($id);
        $pethotel->update($request->all());

        return redirect()->route('pethotel.index')->with('success', 'Pethotel updated successfully.');
    }

    public function destroy(string $id)
    {
        $pethotel = Pethotel::findOrFail($id);
        $pethotel->delete();

        return redirect()->route('pethotel.index')->with('success', 'Pethotel deleted successfully.');
    }
}
