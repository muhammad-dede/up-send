<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\KelasDetail;
use Illuminate\Http\Request;

class ScanController extends Controller
{
    public function index()
    {
        return view('app.scan-qr.index');
    }

    public function search(Request $request)
    {
        $kelas_detail = KelasDetail::where('qr_code', $request->qr_code)->with(['mahasiswa', 'kelas'])->first();
        $kelas = Kelas::with(['matkul', 'user'])->where('id', $kelas_detail->id_kelas)->first();
        if ($kelas_detail) {
            return response()->json(['kelas_detail' => $kelas_detail, 'kelas' => $kelas]);
        } else {
            return response()->json(['failed' => 'QR Code tidak dikenali!']);
        }
    }
}
