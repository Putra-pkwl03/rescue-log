<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PengirimanInventaris extends Model
{
    use HasFactory;

    protected $table = 'pengiriman_inventaris';

    protected $fillable = [
        'pengajuan_id',       // Tambahan: Menghubungkan ke tabel pengajuan
        'stok_inventaris_id',
        'posko_id',
        'jumlah_dikirim',
        'status_distribusi',  // Tambahan: 'Dalam Pengiriman', 'Diterima di Posko'
        'estimasi_waktu',     // Tambahan: Teks estimasi waktu sampai
        'waktu_diterima',     // Tambahan: Timestamp saat konfirmasi
        'keterangan',
    ];

    protected $casts = [
    'jumlah_dikirim' => 'double',
    'waktu_diterima' => 'datetime',
];

    /**
     * Relasi ke Pengajuan Logistik
     */
    public function pengajuan()
{
    return $this->belongsTo(PengajuanKebutuhan::class, 'pengajuan_id');
}

    /**
     * Relasi ke Stok Inventaris (Barang Gudang)
     */
    public function stokInventaris()
    {
        return $this->belongsTo(StokInventaris::class, 'stok_inventaris_id');
    }

    /**
     * Relasi ke Posko
     */
    public function posko()
    {
        return $this->belongsTo(Posko::class, 'posko_id');
    }

    /**
     * Relasi ke User (Petugas Lapangan / Pengirim)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Helper Method: Cek apakah transaksi ini masih boleh di-edit atau di-hapus (Maksimal 20 Menit)
     * 
     * @return bool
     */
    public function canBeEditedOrDeleted(): bool
    {
        return $this->created_at->addMinutes(20)->isFuture();
    }

    /**
     * Helper Method: Mendapatkan sisa waktu (dalam menit / detik) sebelum opsi edit/delete dikunci
     * 
     * @return int Sisa menit
     */
    public function sisaWaktuMenit(): int
    {
        if (!$this->canBeEditedOrDeleted()) {
            return 0;
        }

        return max(0, (int) now()->diffInMinutes($this->created_at->addMinutes(20), false));
    }
}