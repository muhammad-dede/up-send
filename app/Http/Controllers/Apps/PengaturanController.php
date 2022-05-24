<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class PengaturanController extends Controller
{
    public function akun()
    {
        return view('app.pengaturan.akun');
    }

    public function akunUpdate(Request $request)
    {

        if ($request->file('avatar')) {
            $request->validate([
                'avatar' => 'required|mimes:png,jpeg,jpg,gif|max:1024',
            ]);
        }

        $request->validate([
            'nama' => 'required|max:255|string',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id() . ',id',
        ]);

        if ($request->password) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);
        }

        User::where('id', auth()->user()->id)->update([
            'nama' => ucwords(strtolower($request->nama)),
            'email' => strtolower($request->email),
        ]);

        if ($request->password) {
            User::where('id', auth()->user()->id)->update([
                'password' => Hash::make($request->password),
            ]);
        }

        if ($request->file('avatar')) {
            if (auth()->user()->avatar !== 'blank.png') {
                File::delete('public/assets/image/user-avatar/' . auth()->user()->avatar);
            }

            $avatar = 'avatar-' . auth()->id() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('assets/image/user-avatar'), $avatar);

            User::where('id', auth()->id())->update([
                'avatar' => $avatar,
            ]);
        } else {
            $avatar = auth()->user()->avatar;
            User::where('id', auth()->id())->update([
                'avatar' => $avatar,
            ]);
        }

        return redirect()->back()->with('success', 'Berhasil diubah!');
    }
}
