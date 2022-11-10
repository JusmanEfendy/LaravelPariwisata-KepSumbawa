<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    public function index()
    {
        $kabupaten = Kabupaten::all()->sortBy('nama');
        return view('admin.kabupaten.index', compact('kabupaten'));
    }

    public function create()
    {
        return view('admin.kabupaten.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
        ]);

        $input = $request->all();
        Kabupaten::create($input);

        return redirect()->route('admin.kabupaten')
            ->with('success', 'Kabupaten Berhasil Dibuat');
    }

    public function edit($id)
    {
        $kabupaten = Kabupaten::find($id);
        return view('admin.kabupaten.edit', compact('kabupaten'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
        ]);

        $input = $request->all();
        $kabupaten = Kabupaten::find($id);
        $kabupaten->update($input);

        return redirect()->route('admin.kabupaten')
            ->with('success', 'Kabupaten berhasil di perbarui');
    }

    public function destroy($id)
    {
        Kabupaten::find($id)->delete();
        return redirect()->route('admin.kabupaten')
            ->with('success', 'Kabupaten berhasil dihapus');
    }
}
