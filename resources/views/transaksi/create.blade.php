@extends('layouts.app')

@section('title', 'Transaksi')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header">
                Form Transaksi
            </div>
            <div class="card-body">
                <form action="{{ $transaksi ? route('transaksi.update', $transaksi->no_transaksi) : route('transaksi.store') }}" method="POST" id="formTransaksi">
                    @csrf
                    @if ($transaksi)
                        @method('PUT')
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal Transaksi</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" required value="{{ $transaksi ? $transaksi->tanggal : date('Y-m-d') }}"> 
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kode_barang" class="form-label">Nama Barang</label>
                                <select class="form-select @error('kode_barang') is-invalid @enderror" id="kode_barang" name="kode_barang">
                                    <option value="">Pilih Barang</option>
                                    @foreach ($barangs as $barang)
                                        <option value="{{ $barang->kode_barang }}" {{ $transaksi && $transaksi->kode_barang === $barang->kode_barang ? 'selected' : '' }} data-stok="{{ $barang->stok_akhir }}">
                                            {{ $barang->nama_barang }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kode_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jenis" class="form-label">Jenis</label>
                                <select class="form-select @error('jenis') is-invalid @enderror" id="jenis" name="jenis">
                                    <option value="">Pilih Jenis</option>
                                    <option value="masuk" {{ $transaksi && $transaksi->jenis === 'masuk' ? 'selected' : '' }}>Masuk</option>
                                    <option value="keluar" {{ $transaksi && $transaksi->jenis === 'keluar' ? 'selected' : '' }}>Keluar</option>
                                </select>
                                @error('jenis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah" value="{{ $transaksi ? $transaksi->jumlah : '' }}">
                                @error('jumlah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan Deskripsi">{{ $transaksi ? $transaksi->deskripsi : '' }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('transaksi.index') }}'">Kembali</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('javascript')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('formTransaksi');
        const jenisSelect = document.getElementById('jenis');
        const barangSelect = document.getElementById('kode_barang');
        const jumlahInput = document.getElementById('jumlah');

        form.addEventListener('submit', function (event) {
            // Ambil value jenis dan jumlah
            const jenis = jenisSelect.value;
            const jumlah = parseInt(jumlahInput.value) || 0;

            // Jika jenisnya keluar, lakukan pengecekan stok
            if (jenis === 'keluar') {
                // Ambil option barang yang sedang dipilih
                const selectedOption = barangSelect.options[barangSelect.selectedIndex];
                
                // Ambil data-stok dari option tersebut
                const stokTerkini = parseInt(selectedOption.getAttribute('data-stok')) || 0;
                console.log(`Stok terkini: ${stokTerkini}, Jumlah keluar: ${jumlah}`);

                // Cek apakah jumlah lebih besar dari stok terkini
                if (jumlah > stokTerkini) {
                    // Tampilkan alert
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal menyimpan!',
                        text: `Jumlah barang keluar (${jumlah}) melebihi stok terkini (${stokTerkini}).`,
                    });
                    
                    // Cegah form disubmit
                    event.preventDefault();
                    
                    // Fokuskan kembali kursor ke input jumlah
                    jumlahInput.focus();
                }
            }
        });
    });
</script>
@endpush