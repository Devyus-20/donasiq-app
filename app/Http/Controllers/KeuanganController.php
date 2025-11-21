<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonasiCash; // pastikan model ini ada

class KeuanganController extends Controller
{
    public function uploadMutasiForm()
    {
        return view('keuangan.upload_mutasi'); // buat view sesuai kebutuhan
    }

    public function processMutasi(Request $request)
    {
        // proses upload mutasi bank
        return back()->with('success', 'Mutasi berhasil diupload');
    }

    public function validasiMutasi()
    {
        return view('keuangan.validasi_mutasi');
    }

    public function terimaSetoranForm()
    {
        return view('keuangan.terima_setoran');
    }

    public function terimaSetoran(Request $request)
    {
        // proses penerimaan setoran cash
        return back()->with('success', 'Setoran berhasil diterima');
    }

    public function laporan()
    {
        // ambil data dari tabel donasi_cash
        $laporan = DonasiCash::all();

        // lempar data ke view
        return view('keuangan.laporan', compact('laporan'));
    }
}
