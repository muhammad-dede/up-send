<?php

namespace App\Exports;

use App\Models\Absensi;
use App\Models\AbsensiDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportAbsensi implements FromView
{
    protected $id_absensi;

    function __construct($id_absensi)
    {
        $this->id_absensi = $id_absensi;
    }

    public function view(): View
    {
        return view('app.export.excel.absensi', [
            'absensi' => Absensi::where('id', $this->id_absensi)->get(),
            'absensi_detail' => AbsensiDetail::with(['mahasiswa'])->where('id_absensi', $this->id_absensi)->get(),
        ]);
    }
}
