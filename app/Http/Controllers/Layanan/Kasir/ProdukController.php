<?php

namespace App\Http\Controllers\Layanan\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Layanan\Kasir\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    //
    public function index()
    {
        $produk = Produk::latest()->get();
        
        return view('admin.Layanan.kasir.produk.index', compact('produk'));
    }

    public function store(Request $request)
    {
        Produk::create($request->all());

        return back()->with('success', 'Produk berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->update($request->all());

        return back()->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return back()->with('success', 'Produk berhasil dihapus');
    }
}
