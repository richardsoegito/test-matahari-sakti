@extends('layouts.app')

@section('title', 'Transaksi')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm">
            <div class="card-header">
                Data Master Transaksi
            </div>
            <div class="card-body">
                <button class="btn btn-primary mb-3" onclick="window.location.href='{{ route('transaksi.create') }}'">Tambah Transaksi</button>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <table class="table table-striped-columns">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Transaksi</th>
                            <th>Tanggal</th>
                            <th>Kode Barang</th>
                            <th>Jumlah</th>
                            <th>Jenis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksis as $transaksi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transaksi->no_transaksi }}</td>
                                <td>{{ $transaksi->tanggal }}</td>
                                <td>{{ $transaksi->barang->nama_barang }}</td>
                                <td>{{ $transaksi->jumlah }}</td>
                                <td>{{ ucwords($transaksi->jenis) }}</td>
                                <td>
                                    <a href="{{ route('transaksi.edit', $transaksi->no_transaksi) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('transaksi.destroy', $transaksi->no_transaksi) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-hapus">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('javascript')
<script>
    // Ambil semua tombol dengan class btn-hapus
    const deleteButtons = document.querySelectorAll('.btn-hapus');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault(); 
            
            const form = this.closest('form'); 

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Barang yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush