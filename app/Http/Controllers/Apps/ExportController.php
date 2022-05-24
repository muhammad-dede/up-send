<?php

namespace App\Http\Controllers\Apps;

use App\Exports\ExportAbsensi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;

class ExportController extends Controller
{
    public function exportExcelAbsensi($id_absensi)
    {
        return Excel::download(new ExportAbsensi($id_absensi), 'Rekap-Absensi.xlsx');
    }
}
