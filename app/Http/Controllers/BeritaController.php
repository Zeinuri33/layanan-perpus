<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\User;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {

        $berita = Berita::latest()->get();

        return view('admin.berita.index', compact('berita'));

    }

    public function create()
    {
        $user = User::latest()->get();

        return view('admin.berita.tambah', compact('user'));
    }

    public function store(Request $request)
    {
        $isi = $request->isi;

        $dom = new DOMDocument();
        $dom->loadHTML($isi, LIBXML_NOERROR);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            $data = base64_decode(explode(',',explode(';',$img->getAttribute('src'))[1])[1]);
            $image_name = "/berita_img/" . time(). $key. '.png';
            file_put_contents(public_path().$image_name, $data);

            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        $isi = $dom->saveHTML();

        $gambar = $request->file('gambar');
        $gambar->storeAs('public/gambar', $gambar->hashName());

        Berita::create([
            'gambar' => $gambar->hashName(),
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'isi' => $isi,
        ]);

        return redirect('/admin/berita')->with('success', 'Alhamdulillah, berita berhasil tersimpan');

    }

    public function edit($id)
    {
        $berita = Berita::find($id);
        $user = User::latest()->get();

        return view('admin.berita.edit', compact('berita', 'user'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::find($id);

        $isi = $request->isi;

        $dom = new DOMDocument();
        $dom->loadHTML($isi, LIBXML_NOERROR);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {

            if (strpos($img->getAttribute('src'), 'data:image/') ===0) {

                $data = base64_decode(explode(',',explode(';',$img->getAttribute('src'))[1])[1]);
                $image_name = "/berita_img/" . time(). $key. '.png';
                file_put_contents(public_path().$image_name, $data);

                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }

        $isi = $dom->saveHTML();


        if ($request->hasFile('gambar')) {

            $gambar = $request->file('gambar');
            $gambar->storeAs('public/gambar', $gambar->hashName());

            Storage::delete('public/gambar/'.$berita->gambar);

            $berita->update([
                'gambar' => $gambar->hashName(),
                'judul' => $request->judul,
                'penulis' => $request->penulis,
                'isi' => $isi,
            ]);

        }else{

            $berita->update([
                'judul' => $request->judul,
                'penulis' => $request->penulis,
                'isi' => $isi,
            ]);
        }


        return redirect('/admin/berita')->with('success', 'Alhamdulillah, berita berhasil diperbarui!');

    }

    public function hapus($id)
    {
        //get post by ID
        $berita = Berita::findOrFail($id);

        //delete image
        Storage::delete('public/gambar/'. $berita->gambar);

        //delete post
        $berita->delete();

        $title = 'Hapus Data!';
        $text = "Apakah anda yakin menghapus data terpilih?";
        confirmDelete($title, $text);

        //redirect to index
        return redirect(route('berita.index'))->with('success', 'Alhamdulillah, data berhasil dihapus!');

    }

    public function berita_list()
    {
        $berita = Berita::latest()->get();

        return view('berita.berita', compact('berita'));
    }

    public function berita_detail(Request $request, $slug)
    {
        $berita = Berita::where('slug','=',$slug)->first();
        $list   = Berita::latest()->paginate(5);

        return view('berita.detail', compact('berita', 'list'));
    }
}
