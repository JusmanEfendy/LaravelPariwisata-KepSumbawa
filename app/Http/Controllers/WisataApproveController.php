<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Models\WisataApprove;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class WisataApproveController extends Controller
{
    public function index()
    {
        $wisataApprove = WisataApprove::where('status', 'pending')->orderBy('nama', 'asc')->paginate(5);
        return view('admin.permintaan-wisata.index', compact('wisataApprove'));
    }

    public function dataPengajuan()
    {
        $dataPengajuanDisetujui = WisataApprove::where('status', 'approved')->orderBy('nama', 'asc')->paginate(5);
        $dataPengajuanDitolak = WisataApprove::where('status', 'rejected')->orderBy('nama', 'asc')->paginate(5);
        return view('admin.permintaan-wisata.dataPengajuan', compact('dataPengajuanDisetujui', 'dataPengajuanDitolak'));
    }

    public function approve($id)
    {
        $wisataPending = WisataApprove::find($id);
        $wisataPending->update(['status' => 'approved']);

        Wisata::create([
            'nama' => $wisataPending->nama,
            'id_kategori' => $wisataPending->id_kategori,
            'id_kecamatan' => $wisataPending->id_kecamatan,
            'id_kabupaten' => $wisataPending->id_kabupaten,
            'id_kelurahan' => $wisataPending->id_kelurahan,
            'fasilitas' => $wisataPending->fasilitas,
            'deskripsi' => $wisataPending->deskripsi,
            'link_sampul' => $wisataPending->link_sampul,
            'lat' => $wisataPending->lat,
            'lng' => $wisataPending->lng,
            'created_at' => $wisataPending->created_at,
        ]);

        return redirect()->route('admin.permintaan-wisata')
            ->with('success', 'Wisata Berhasil ditambahkan');
    }

    public function reject($id)
    {
        $wisataPending = WisataApprove::find($id);
        $wisataPending->update(['status' => 'rejected']);

        return redirect()->route('admin.permintaan-wisata')
            ->with('success', 'Pengajuan WIsata Ditolak');
    }
}
