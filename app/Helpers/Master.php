<?php

function get_matakuliah()
{
    return \App\Models\Matakuliah::orderBy('nama', 'asc')->get();
}

function get_kelas_user($id_user)
{
    return \App\Models\Kelas::where('id_user', $id_user)->get();
}

function get_absensi_user($id_user)
{
    return \App\Models\Kelas::where('id_user', $id_user)->get();
}
