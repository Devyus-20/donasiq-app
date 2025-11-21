<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = DB::table('donasi_cash')
            ->selectRaw('donatur, kantor, DATE_FORMAT(created_at, "%Y-%m") as bulan, SUM(jumlah) as total_donasi')
            ->groupBy('donatur', 'kantor', 'bulan')
            ->orderBy('bulan', 'desc')
            ->get();

        return view('keuangan.laporan', compact('laporan'));
    }
}
