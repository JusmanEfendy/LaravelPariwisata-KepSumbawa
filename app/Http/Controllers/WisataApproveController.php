<?php

namespace App\Http\Controllers;

use App\Models\WisataApprove;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class WisataApproveController extends Controller
{
    public function index()
    {
        $wisataApprove = WisataApprove::orderBy('nama', 'asc')->paginate(5);
        $roles = auth()->user()->roles->first()->name;
        dd($roles);
        return view('admin.permintaan-wisata.index', compact('wisataApprove'));

        // LANJUT DISINI BESOK
    }
}
