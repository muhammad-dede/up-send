<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\KelasDetail;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class KelasController extends Controller
{
    public function index()
    {
        if (auth()->user()->roles->pluck('name')->toArray()[0] == 'admin') {
            $data_kelas = Kelas::with(['matkul', 'user'])->orderBy('id', 'desc')->get();
        } else {
            $data_kelas = Kelas::with(['matkul', 'user'])->where('id_user', auth()->id())->orderBy('id', 'desc')->get();
        }
        return view('app.kelas.index', compact('data_kelas'));
    }

    public function create()
    {
        return view('app.kelas.create');
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator_kelas = Validator::make($request->all(), [
                'kelas' => 'required|string|max:255',
                'id_matkul' => 'required|string',
                'semester' => 'required|numeric|digits_between:0,11',
                'sks' => 'required|numeric|digits_between:0,11',
            ]);
            if ($validator_kelas->fails()) {
                return response()->json(['error' => $validator_kelas->errors()->toArray()]);
            }

            if ($request->npm && $request->nama && $request->jenis_kelamin) {
                $validator_data_mahasiswa = Validator::make($request->all(), [
                    'npm.*' => 'required|numeric|digits_between:0,15',
                    'nama.*' => 'required|string|max:255',
                    'jenis_kelamin.*' => 'required|string|max:255',
                    'aktif.*' => 'required|string|max:255',
                ]);
                if ($validator_data_mahasiswa->fails()) {
                    return response()->json(['error' => $validator_data_mahasiswa->errors()->toArray()]);
                }
            }

            $kelas = Kelas::create([
                'kelas' => ucwords($request->kelas),
                'id_matkul' => $request->id_matkul,
                'semester' => $request->semester,
                'sks' => $request->sks,
                'id_user' => auth()->id(),
            ]);

            if ($request->npm && $request->nama && $request->jenis_kelamin) {
                $npm = $request->npm;
                $nama = $request->nama;
                $jenis_kelamin = $request->jenis_kelamin;
                $aktif = $request->aktif;
                for ($count_mahasiswa = 0; $count_mahasiswa < count($npm); $count_mahasiswa++) {
                    $mahasiswa = Mahasiswa::where('npm', $npm[$count_mahasiswa])->first();
                    if ($mahasiswa) {
                        $id_mahasiswa = $mahasiswa->id;
                    } else {
                        $mahasiswa = Mahasiswa::create([
                            'npm' => $npm[$count_mahasiswa],
                            'nama' => $nama[$count_mahasiswa],
                            'jk' => $jenis_kelamin[$count_mahasiswa],
                        ]);
                        $id_mahasiswa = $mahasiswa->id;
                    }
                    $data = array(
                        'id_kelas' => $kelas->id,
                        'id_mahasiswa' => $id_mahasiswa,
                        'qr_code'  => Str::random(20),
                        'aktif' => $aktif[$count_mahasiswa],
                    );
                    $insert_data_mahasiswa[] = $data;
                }
                KelasDetail::insert($insert_data_mahasiswa);
            }

            return response()->json(['success' => 'Successfully']);
        }

        return redirect()->route('kelas.index')->with('success', 'Berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kelas = Kelas::with(['kelas_detail', 'matkul', 'user'])->findOrFail($id);
        return view('app.kelas.edit', compact('kelas'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {

            $validator_kelas = Validator::make($request->all(), [
                'kelas' => 'required|string|max:255',
                'id_matkul' => 'required|string',
                'semester' => 'required|numeric|digits_between:0,11',
                'sks' => 'required|numeric|digits_between:0,11',
            ]);
            if ($validator_kelas->fails()) {
                return response()->json(['error' => $validator_kelas->errors()->toArray()]);
            }

            if ($request->npm && $request->nama && $request->jenis_kelamin) {
                $validator_data_mahasiswa = Validator::make($request->all(), [
                    'npm.*' => 'required|numeric|digits_between:0,15',
                    'nama.*' => 'required|string|max:255',
                    'jenis_kelamin.*' => 'required|string|max:255',
                    'aktif.*' => 'required|string|max:255',
                ]);
                if ($validator_data_mahasiswa->fails()) {
                    return response()->json(['error' => $validator_data_mahasiswa->errors()->toArray()]);
                }
            }

            Kelas::where('id', $id)->update([
                'kelas' => ucwords($request->kelas),
                'id_matkul' => $request->id_matkul,
                'semester' => $request->semester,
                'sks' => $request->sks,
                'id_user' => auth()->id(),
            ]);

            if ($request->npm && $request->nama && $request->jenis_kelamin) {
                $npm = $request->npm;
                $nama = $request->nama;
                $jenis_kelamin = $request->jenis_kelamin;
                $aktif = $request->aktif;
                for ($count_mahasiswa = 0; $count_mahasiswa < count($npm); $count_mahasiswa++) {
                    // cari mahasiswa
                    $mahasiswa = Mahasiswa::where('npm', $npm[$count_mahasiswa])->first();
                    if ($mahasiswa) {
                        $id_mahasiswa = $mahasiswa->id;
                    } else {
                        $mahasiswa = Mahasiswa::create([
                            'npm' => $npm[$count_mahasiswa],
                            'nama' => $nama[$count_mahasiswa],
                            'jk' => $jenis_kelamin[$count_mahasiswa],
                        ]);
                        $id_mahasiswa = $mahasiswa->id;
                    }

                    $kelas_detail = KelasDetail::where('id_kelas', $id)->where('id_mahasiswa', $id_mahasiswa)->first();
                    if ($kelas_detail) {
                        if ($kelas_detail->qr_code) {
                            $qr_code = $kelas_detail->qr_code;
                        } else {
                            $qr_code = Str::random(20);
                        }
                    } else {
                        $qr_code = Str::random(20);
                    }

                    KelasDetail::updateOrCreate(['id_kelas' => $id, 'id_mahasiswa' => $id_mahasiswa], [
                        'id_mahasiswa' => $id_mahasiswa,
                        'qr_code' => $qr_code,
                        'aktif' => $aktif[$count_mahasiswa],
                    ]);

                    $data_mahasiswa[] = $id_mahasiswa;
                }

                KelasDetail::where('id_kelas', $id)->whereNotIn('id_mahasiswa', $data_mahasiswa)->delete();
            } else {
                KelasDetail::where('id_kelas', $id)->delete();
            }

            return response()->json(['success' => 'Successfully']);
        }

        return redirect()->route('kelas.index')->with('success', 'Berhasil diubah!');
    }

    public function show($id)
    {
        $kelas = Kelas::with(['kelas_detail'])->find($id);
        return view('app.kelas.show', compact('kelas'));
    }

    public function cetak($qr_code)
    {
        $kelas_detail = KelasDetail::where('qr_code', $qr_code)->first();
        if ($kelas_detail) {
            return view('app.kelas.cetak', compact('kelas_detail'));
        } else {
            return abort('404');
        }
    }
}
