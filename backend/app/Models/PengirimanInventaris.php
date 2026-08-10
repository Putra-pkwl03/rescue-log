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
        'stok_inventaris_id',
        'posko_id',
        'user_id',
        'jumlah_dikirim',
        'keterangan',
    ];

    /**
     * Relasi ke Stok Inventaris (Barang Gudang)
     */
    public function stokInventaris()
    {
        return $table = $this->belongsTo(StokInventaris::class, 'stok_inventaris_id');
    }

    /**
     * Relasi ke Posko Komando
     */
    public function posko()
    {
        return $this->belongsTo(Posko::class, 'posko_id');
    }

    /**
     * Relasi ke User (Petugas Pengirim)
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
        // Mengembalikan true jika selisih created_at dengan waktu sekarang kurang dari atau sama dengan 20 menit
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