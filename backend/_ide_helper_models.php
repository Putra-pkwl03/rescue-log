<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $jenis_bencana
 * @property string $lokasi_bencana
 * @property numeric|null $koordinat_operasional_lat
 * @property numeric|null $koordinat_operasional_lng
 * @property string $tanggal_aktivasi
 * @property string|null $tanggal_selesai
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bencana newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bencana newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bencana query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bencana whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bencana whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bencana whereJenisBencana($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bencana whereKoordinatOperasionalLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bencana whereKoordinatOperasionalLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bencana whereLokasiBencana($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bencana whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bencana whereTanggalAktivasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bencana whereTanggalSelesai($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bencana whereUpdatedAt($value)
 */
	class Bencana extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $external_id
 * @property string $sumber_api
 * @property string $jenis_bencana
 * @property string $wilayah
 * @property string|null $magnitude
 * @property string|null $kedalaman
 * @property string|null $potensi
 * @property numeric $latitude
 * @property numeric $longitude
 * @property \Illuminate\Support\Carbon $waktu_kejadian
 * @property array<array-key, mixed>|null $raw_payload
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BencanaPending newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BencanaPending newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BencanaPending query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BencanaPending whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BencanaPending whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BencanaPending whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BencanaPending whereJenisBencana($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BencanaPending whereKedalaman($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BencanaPending whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BencanaPending whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BencanaPending whereMagnitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BencanaPending wherePotensi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BencanaPending whereRawPayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BencanaPending whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BencanaPending whereSumberApi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BencanaPending whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BencanaPending whereWaktuKejadian($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BencanaPending whereWilayah($value)
 */
	class BencanaPending extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nama_kabupaten_kota
 * @property string $alamat_kantor
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bpbd newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bpbd newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bpbd query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bpbd whereAlamatKantor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bpbd whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bpbd whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bpbd whereNamaKabupatenKota($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bpbd whereUpdatedAt($value)
 */
	class Bpbd extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nama_posko
 * @property string $tipe_posko
 * @property int|null $parent_id
 * @property int|null $bpbd_id
 * @property int|null $bencana_id
 * @property string|null $kode_undangan
 * @property string|null $lokasi
 * @property numeric|null $latitude
 * @property numeric|null $longitude
 * @property int|null $kapasitas_maksimal
 * @property string $penanggung_jawab
 * @property string|null $kontak_hp
 * @property int $jumlah_petugas
 * @property string|null $foto
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Bencana|null $bencana
 * @property-read \App\Models\Bpbd|null $bpbd
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Posko> $children
 * @property-read int|null $children_count
 * @property-read Posko|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posko komando()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posko newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posko newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posko query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posko subPosko()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posko whereBencanaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posko whereBpbdId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posko whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posko whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posko whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posko whereJumlahPetugas($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posko whereKapasitasMaksimal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posko whereKodeUndangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posko whereKontakHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posko whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posko whereLokasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posko whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posko whereNamaPosko($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posko whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posko wherePenanggungJawab($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posko whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posko whereTipePosko($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Posko whereUpdatedAt($value)
 */
	class Posko extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $role
 * @property int|null $bpbd_id
 * @property int|null $posko_id
 * @property-read \App\Models\Bpbd|null $bpbd
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Posko|null $posko
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereBpbdId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePoskoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

