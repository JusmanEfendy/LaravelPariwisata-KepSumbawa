<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:kategori-list|kategori-create|kategori-edit|kategori-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:kategori-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:kategori-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:kategori-delete', ['only' => ['destroy']]);
    }

    public function index()
    {

        $kategori = Kategori::all()->sortBy('nama');
        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required'
            // 'icons' => 'required'
        ]);
        $input = $request->all();
        Kategori::create($input);

        return redirect()->route('admin.kategori')
            ->with('success', 'kategori created successfully');
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);

        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',

        ]);

        $input = $request->all();

        $kategori = Kategori::find($id);
        $kategori->update($input);

        return redirect()->route('admin.kategori')
            ->with('success', 'kategori berhasil di perbarui');
    }

    public function destroy($id)
    {
        Kategori::find($id)->delete();
        return redirect()->route('admin.kategori')
            ->with('success', 'kategori berhasil dihapus');
    }
}
