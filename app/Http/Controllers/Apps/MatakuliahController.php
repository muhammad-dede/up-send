<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_matakuliah = Matakuliah::orderBy('id', 'desc')->get();
        return view('app.matakuliah.index', compact('data_matakuliah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.matakuliah.create');
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
            'kode' => 'required|string|max:30|unique:matakuliah,kode',
            'nama' => 'required|string|max:255',
        ]);

        Matakuliah::create([
            'kode' => strtoupper($request->kode),
            'nama' => ucwords($request->nama),
        ]);

        return redirect()->route('matakuliah.index')->with('success', 'Berhasil ditambahkan!');
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
        $matakuliah = Matakuliah::findOrFail($id);
        return view('app.matakuliah.edit', compact('matakuliah'));
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
            'kode' => 'required|string|max:30|unique:matakuliah,kode,' . $id . ',id',
            'nama' => 'required|string|max:255',
        ]);

        Matakuliah::where('id', $id)->update([
            'kode' => strtoupper($request->kode),
            'nama' => ucwords($request->nama),
        ]);

        return redirect()->route('matakuliah.index')->with('success', 'Berhasil diubah!');
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
