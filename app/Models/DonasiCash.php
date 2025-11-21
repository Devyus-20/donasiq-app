<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DonasiCash extends Model
{
    use HasFactory;

    protected $table = 'donasi_cash';

    protected $fillable = [
        'donatur',
        'jumlah',
        'peruntukan',
        'keterangan',
        'status',
        'input_by',
        'received_by',
        'tanggal_setor',
        'tanggal_diterima',
        'catatan_keuangan'
    ];

    protected $casts = [
        'jumlah' => 'decimal:2',
        'tanggal_setor' => 'datetime',
        'tanggal_diterima' => 'datetime'
    ];

    /**
     * Relasi ke user yang menginput (CRM)
     */
    public function inputBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'input_by');
    }

    /**
     * Relasi ke user keuangan yang menerima
     */
    public function receivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk filter berdasarkan peruntukan
     */
    public function scopeByPeruntukan($query, $peruntukan)
    {
        return $query->where('peruntukan', $peruntukan);
    }

    /**
     * Scope untuk filter berdasarkan user yang input
     */
    public function scopeByInputBy($query, $userId)
    {
        return $query->where('input_by', $userId);
    }

    /**
     * Get formatted jumlah
     */
    public function getFormattedJumlahAttribute()
    {
        return 'Rp ' . number_format($this->jumlah ?? 0, 0, ',', '.');
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending' => 'Menunggu Disetor',
            'disetor' => 'Sudah Disetor',
            'diterima_keuangan' => 'Diterima Keuangan',
            'selesai' => 'Selesai',
            default => 'Unknown'
        };
    }

    /**
     * Get status badge color (untuk view)
     */
    public function getStatusBadgeColorAttribute()
    {
        return match($this->status) {
            'pending' => '#fff3cd',
            'disetor' => '#d1ecf1',
            'diterima_keuangan' => '#d4edda',
            'selesai' => '#cce5ff',
            default => '#e2e3e5'
        };
    }

    /**
     * Validasi transfer (update status)
     */
    public function validateTransfer($userId)
    {
        $this->status = 'diterima_keuangan';
        $this->received_by = $userId;
        $this->tanggal_diterima = now();
        $this->save();
    }

    /**
     * Ambil data transfer yang perlu divalidasi
     */
    public static function pendingTransfers()
    {
        return self::with('inputBy')
            ->where('status', 'disetor') // Hanya yang sudah disetor ke keuangan
            ->orderBy('tanggal_setor', 'desc')
            ->get();
    }
}
