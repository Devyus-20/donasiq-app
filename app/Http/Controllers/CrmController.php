<?php

namespace App\Http\Controllers;

use App\Models\DonasiCash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CrmController extends Controller
{
    /**
     * Tampilkan halaman input donasi cash
     */
    public function inputCash()
    {
        $donasi = DonasiCash::with(['inputBy', 'receivedBy'])
            ->where('input_by', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('crm.input_cash', compact('donasi'));
    }

    /**
     * Simpan data donasi cash
     */
    public function storeCash(Request $request)
    {
        $validated = $request->validate([
            'donatur' => 'required|string|max:255|regex:/^[a-zA-Z\s\.]+$/',
            'jumlah' => 'required|numeric|min:1000|max:999999999',
            'peruntukan' => 'nullable|in:Zakat,Infak,Sedekah,Program Khusus,Lainnya',
            'keterangan' => 'nullable|string|max:500'
        ], [
            'donatur.required' => 'Nama donatur wajib diisi.',
            'donatur.regex' => 'Nama donatur hanya boleh berisi huruf, spasi, dan titik.',
            'jumlah.required' => 'Jumlah donasi wajib diisi.',
            'jumlah.min' => 'Jumlah donasi minimal Rp 1.000.',
            'jumlah.max' => 'Jumlah donasi terlalu besar.',
            'peruntukan.in' => 'Peruntukan yang dipilih tidak valid.',
            'keterangan.max' => 'Keterangan maksimal 500 karakter.'
        ]);

        try {
            DB::beginTransaction();

            DonasiCash::create([
                'donatur' => $validated['donatur'],
                'jumlah' => $validated['jumlah'],
                'peruntukan' => $validated['peruntukan'] ?? null,
                'keterangan' => $validated['keterangan'] ?? null,
                'status' => 'pending',
                'input_by' => Auth::id()
            ]);

            DB::commit();

            return back()->with('success', 'Donasi cash dari ' . $validated['donatur'] . ' sebesar Rp ' . number_format($validated['jumlah'], 0, ',', '.') . ' berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'Gagal menyimpan data donasi. Silakan coba lagi.');
        }
    }

    /**
     * Tampilkan halaman validasi transfer bank
     */
    public function validasiTransfer()
    {
        // Ambil semua donasi yang statusnya disetor (belum divalidasi keuangan)
        $transfers = DonasiCash::with(['inputBy', 'receivedBy'])
            ->where('status', 'pending') // status yang menunggu validasi
            ->orderBy('created_at', 'desc')
            ->get();

        return view('crm.validasi_transfer', compact('transfers'));
    }

    /**
     * Proses validasi transfer
     */
    public function confirmTransfer($id)
    {
        try {
            $donasi = DonasiCash::findOrFail($id);

            // Cek status agar tidak bisa divalidasi lebih dari sekali
            if ($donasi->status !== 'pending') {
                return back()->with('error', 'Donasi ini tidak dapat divalidasi.');
            }

            $donasi->update([
                'status' => 'diterima_keuangan',
                'received_by' => Auth::id(),
                'tanggal_diterima' => now()
            ]);

            return back()->with('success', 'Donasi dari ' . $donasi->donatur . ' berhasil divalidasi!');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memvalidasi donasi.');
        }
    }

    /**
     * Tampilkan riwayat donasi
     */
    public function history(Request $request)
    {
        $query = DonasiCash::with(['inputBy', 'receivedBy'])
            ->where('input_by', Auth::id());

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('peruntukan') && $request->peruntukan != '') {
            $query->where('peruntukan', $request->peruntukan);
        }

        if ($request->has('tanggal_dari') && $request->tanggal_dari != '') {
            $query->whereDate('created_at', '>=', $request->tanggal_dari);
        }

        if ($request->has('tanggal_sampai') && $request->tanggal_sampai != '') {
            $query->whereDate('created_at', '<=', $request->tanggal_sampai);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('donatur', 'like', '%' . $request->search . '%');
        }

        $donasi = $query->orderBy('created_at', 'desc')->paginate(15);

        $stats = [
            'total_donasi' => DonasiCash::where('input_by', Auth::id())->count(),
            'total_nilai' => DonasiCash::where('input_by', Auth::id())->sum('jumlah'),
            'pending' => DonasiCash::where('input_by', Auth::id())->where('status', 'pending')->count(),
            'disetor' => DonasiCash::where('input_by', Auth::id())->where('status', 'disetor')->count(),
        ];

        return view('crm.history', compact('donasi', 'stats'));
    }

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
