<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_mahasiswa = Mahasiswa::orderBy('id', 'desc')->get();
        return view('app.mahasiswa.index', compact('data_mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'npm' => 'required|numeric|unique:mahasiswa,npm|digits_between:10,15',
            'nama' => 'required|string|max:255',
            'jk' => 'required|string',
        ]);

        Mahasiswa::create([
            'npm' => $request->npm,
            'nama' => ucwords(strtolower($request->nama)),
            'jk' => $request->jk,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort('404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('app.mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'npm' => 'required|numeric|digits_between:10,15|unique:mahasiswa,npm,' . $id . ',id',
            'nama' => 'required|string|max:255',
            'jk' => 'required|string',
        ]);

        Mahasiswa::where('id', $id)->update([
            'npm' => $request->npm,
            'nama' => ucwords(strtolower($request->nama)),
            'jk' => $request->jk,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return abort('404');
    }
}
