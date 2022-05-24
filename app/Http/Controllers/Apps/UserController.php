<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->orderBy('id', 'desc')->get();
        return view('app.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.user.create');
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
            'nama' => 'required|string|max:255',
            'email' => 'required|email|string|unique:users,email|max:255',
        ]);

        $user = User::create([
            'nama' => ucwords(strtolower($request->nama)),
            'email' => strtolower($request->email),
            'avatar' => 'blank.png',
            'password' => Hash::make('12345678'),
        ]);

        $user->assignRole([2]);

        return redirect()->route('user.index')->with('success', 'Berhasil menambahkan user!');
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
        $user = User::findOrFail($id);
        return view('app.user.edit', compact('user'));
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
            'nama' => 'required|string|max:255',
            'email' => 'required|email|string|unique:users,email,' . $id . ',id|max:255',
        ]);

        User::where('id', $id)->update([
            'nama' => ucwords(strtolower($request->nama)),
            'email' => strtolower($request->email),
        ]);

        return redirect()->route('user.index')->with('success', 'Berhasil mengubah data user');
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
