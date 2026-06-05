<?php

namespace App\Http\Controllers;

use DOMDocument;
use App\Models\User;
use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index()
    {

        $resource = Resource::latest()->get();

        return view('admin.resource.index', compact('resource'));

    }

    public function create()
    {
        $user = User::latest()->get();

        return view('admin.resource.tambah', compact('user'));
    }

    public function store(Request $request)
    {

        Resource::create([
            'prodi' => $request->prodi,
            'resource' => $request->resource
        ]);

        return redirect('/admin/resource')->with('success', 'Alhamdulillah, resource guide berhasil tersimpan');

    }

    public function edit($id)
    {
        $resource = Resource::find($id);

        return view('admin.resource.edit', compact('resource'));
    }

    public function update(Request $request, $id)
    {
        $eresource = Resource::find($id);

        $eresource->update([
            'prodi' => $request->prodi,
            'resource' => $request->resource
        ]);

        return redirect('/admin/resource')->with('success', 'Alhamdulillah, resource berhasil diperbarui!');

    }

    public function hapus($id)
    {
        //get post by ID
        $resource = Resource::findOrFail($id);
        $resource->delete();

        $title = 'Hapus Data!';
        $text = "Apakah anda yakin menghapus data terpilih?";
        confirmDelete($title, $text);

        //redirect to index
        return redirect(route('resource.index'))->with('success', 'Alhamdulillah, data berhasil dihapus!');
    }

    public function resource_list()
    {
        $resource = Resource::latest()->get();

        return view('resource.resource', compact('resource'));
    }

    public function resource_detail(Request $request, $slug)
    {
        $resource = Resource::where('slug','=',$slug)->first();

        return view('resource.detail', compact('resource'));
    }

}
