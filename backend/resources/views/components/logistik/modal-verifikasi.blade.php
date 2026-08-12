@props(['pengajuan'])

<div class="modal fade" id="modalVerifikasi-{{ $pengajuan->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-clipboard-check text-primary me-2"></i>Verifikasi Pengajuan #{{ $pengajuan->kode_pengajuan }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('komando.logistik.update-status', $pengajuan->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="modal-body p-4">
                    {{-- Info Pengirim & Bencana --}}
                    <div class="row g-3 mb-4 p-3 bg-light rounded-3 border">
                        <div class="col-md-6">
                            <small class="text-muted d-block">Asal Posko Lapangan:</small>
                            <span class="fw-bold text-dark">{{ $pengajuan->posko->nama_posko ?? '-' }}</span>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Kejadian Bencana:</small>
                            <span class="fw-bold text-dark">{{ $pengajuan->bencana->jenis_bencana ?? '-' }}</span>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Tanggal Pengajuan:</small>
                            <span>{{ \Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->translatedFormat('d F Y, H:i') }}</span>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Petugas Pengaju:</small>
                            <span>{{ $pengajuan->user->name ?? '-' }}</span>
                        </div>
                    </div>

                    {{-- Tabel Detail Barang --}}
                    <h6 class="fw-bold mb-3"><i class="bi bi-box-seam me-2"></i>Daftar Logistik Diminta</h6>
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Barang</th>
                                    <th class="text-center" style="width: 130px;">Jumlah Diminta</th>
                                    <th class="text-center" style="width: 160px;">Jumlah Disetujui</th>
                                    <th>Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengajuan->details as $index => $detail)
                                <tr>
                                    <td>
                                        <span class="fw-semibold">{{ $detail->barang->nama_barang ?? 'Barang N/A' }}</span>
                                        @if($detail->keterangan)
                                            <small class="text-muted d-block">{{ $detail->keterangan }}</small>
                                        @endif
                                    </td>
                                    <td class="text-center fw-bold text-primary">{{ $detail->jumlah_diminta }}</td>
                                    <td>
                                        <input type="hidden" name="items[{{ $index }}][id]" value="{{ $detail->id }}">
                                        <input type="number" 
                                               name="items[{{ $index }}][disetujui]" 
                                               class="form-control form-control-sm text-center fw-bold" 
                                               value="{{ $pengajuan->status == 'pending' ? $detail->jumlah_diminta : $detail->jumlah_disetujui }}" 
                                               min="0" 
                                               max="{{ $detail->jumlah_diminta }}"
                                               {{ $pengajuan->status !== 'pending' ? 'readonly' : '' }}>
                                    </td>
                                    <td class="text-muted">{{ $detail->satuan }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Status Approval & Catatan --}}
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Keputusan Verifikasi <span class="text-danger">*</span></label>
                            <select name="status" class="form-select" required {{ $pengajuan->status !== 'pending' ? 'disabled' : '' }}>
                                <option value="disetujui" {{ $pengajuan->status == 'disetujui' ? 'selected' : '' }}>Disetujui Sepenuhnya</option>
                                <option value="disetujui_sebagian" {{ $pengajuan->status == 'disetujui_sebagian' ? 'selected' : '' }}>Disetujui Sebagian</option>
                                <option value="ditolak" {{ $pengajuan->status == 'ditolak' ? 'selected' : '' }}>Tolak Pengajuan</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Catatan Komando / Alasan Penolakan</label>
                            <textarea name="catatan_komando" class="form-control" rows="3" placeholder="Masukkan catatan opsional untuk Posko Lapangan..." {{ $pengajuan->status !== 'pending' ? 'readonly' : '' }}>{{ $pengajuan->catatan_komando }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    @if($pengajuan->status === 'pending')
                        <button type="submit" class="btn btn-primary fw-semibold">
                            <i class="bi bi-save me-1"></i> Simpan Verifikasi
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>