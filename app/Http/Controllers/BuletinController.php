<?php

namespace App\Http\Controllers;

use App\Models\Buletin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\RedirectResponse;

class BuletinController extends Controller
{
    //
    public function index()
    {
        $buletin = Buletin::latest()->get();

        return view('admin.buletin.index', compact('buletin'));
    }

    public function store(Request $request)
    {

        $file = $request->file('file');
        $file->storeAs('public/buletin', $file->hashName());

        Buletin::create([
            'edisi' => $request->edisi,
            'tanggal' => $request->tanggal,
            'file' => $file->hashName()
        ]);

        return redirect('/admin/buletin')->with('success', 'Alhamdulillah, buletin berhasil tersimpan');

    }


    public function update(Request $request, $id) : RedirectResponse
    {

        $buletin = Buletin::findOrFail($id);

        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $file->storeAs('public/buletin', $file->hashName());

            Storage::delete('public/buletin/'.$buletin->file);

            $buletin->update([

                'file' => $file->hashName(),
                'edisi' => $request->edisi,
                'tanggal' => $request->tanggal,

            ]);
        }else{
            $buletin->update([
                'edisi' => $request->edisi,
                'tanggal' => $request->tanggal,
            ]);


        }
        return redirect('/admin/buletin')->with('success', 'Alhamdulillah, buletin berhasil diperbarui!');
    }

    public function hapus($id): RedirectResponse
    {
        //get post by ID
        $buletin = Buletin::findOrFail($id);

        //delete image
        Storage::delete('public/buletin/'. $buletin->file);

        //delete post
        $buletin->delete();

        $title = 'Hapus Data!';
        $text = "Apakah anda yakin menghapus data terpilih?";
        confirmDelete($title, $text);

        //redirect to index
        return redirect(route('buletin.index'))->with('success', 'Alhamdulillah, data buletin berhasil dihapus!');
    }

    public function buletin_list()
    {
        $buletin = Buletin::latest()->get();

        return view('buletin.buletin', compact('buletin'));
    }

}
