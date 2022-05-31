<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\AbsensiDetail;
use App\Models\KelasDetail;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $data_absensi = Absensi::with(['kelas', 'user', 'absensi_detail'])->where('id_user', auth()->id())->get();
        return view('app.absensi.index', compact('data_absensi'));
    }

    public function create()
    {
        return view('app.absensi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required|string',
            'pertemuan_ke' => 'required|numeric',
            'tanggal' => 'required|date',
            'materi_kuliah' => 'required|max:255',
        ]);

        $absensi = Absensi::create([
            'id_kelas' => $request->id_kelas,
            'pertemuan_ke' => $request->pertemuan_ke,
            'tanggal' => $request->tanggal,
            'materi_kuliah' => $request->materi_kuliah,
            'id_user' => auth()->id(),
        ]);

        return redirect()->route('absensi.index')->with('success', 'Berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $absensi = Absensi::where('id', $id)->first();
        return view('app.absensi.edit', compact('absensi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kelas' => 'required|string',
            'pertemuan_ke' => 'required|numeric',
            'tanggal' => 'required|date',
            'materi_kuliah' => 'required|max:255',
        ]);

        Absensi::where('id', $id)->update([
            'id_kelas' => $request->id_kelas,
            'pertemuan_ke' => $request->pertemuan_ke,
            'tanggal' => $request->tanggal,
            'materi_kuliah' => $request->materi_kuliah,
        ]);

        return redirect()->route('absensi.index')->with('success', 'Berhasil diubah!');
    }

    public function show($id)
    {
        $absensi = Absensi::with(['absensi_detail'])->where('id', $id)->first();
        return view('app.absensi.show', compact('absensi'));
    }

    public function getAbsensiDetail($id_absensi)
    {
        $data = AbsensiDetail::where('id_absensi', $id_absensi)->get();
        return view('app.absensi.absensi_detail')->with([
            'data' => $data
        ]);
    }

    public function scanning(Request $request)
    {
        $kelas_detail = KelasDetail::where('qr_code', $request->qr_code)->first();
        if ($kelas_detail) {
            if ($kelas_detail->aktif == 'N') {
                return response()->json(['failed' => 'Status mahasiswa tidak aktif!']);
            } else {
                if ($kelas_detail->id_kelas == $request->id_kelas) {
                    $absensi_detail = AbsensiDetail::updateOrCreate(['id_absensi' => $request->id_absensi, 'id_mahasiswa' => $kelas_detail->id_mahasiswa], [
                        'id_absensi' => $request->id_absensi,
                        'id_mahasiswa' => $kelas_detail->id_mahasiswa,
                        'jam_masuk' => date("H:i:s", strtotime('now')),
                        'keterangan' => 'Hadir',
                    ]);
                    return response()->json(['success' => 'Berhasil melakukan absensi!', 'absensi_detail' => $absensi_detail]);
                } else {
                    return response()->json(['not_matched' => 'Mahasiswa tidak terdaftar dikelas ini!']);
                }
            }
        } else {
            return response()->json(['invalid' => 'QR Code tidak terdaftar!']);
        }
    }

    public function destroyDetail(Request $request, $id)
    {
        AbsensiDetail::where('id', $id)->delete();
        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        Absensi::where('id', $id)->delete();
        AbsensiDetail::where('id_absensi', $id)->delete();

        return redirect()->route('absensi.index')->with('success', 'Berhasil dihapus!');
    }
}
