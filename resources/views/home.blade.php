@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm">
            <div class="card-body p-5">
                <div class="row mb-5">
                    <div class="col-md-4 mb-md-0 mb-3">
                        <div class="card shadow-sm border-2 border-primary bg-primary text-white">
                            <div class="card-body">
                                <p class="card-title">Total Barang</p>
                                <h4 class="card-text">{{ $barang->count() }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-md-0 mb-3">
                        <div class="card shadow-sm border-2 border-success bg-success text-white">
                            <div class="card-body">
                                <p class="card-title">Total Masuk</p>
                                <h4 class="card-text">{{ $totalMasuk }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-md-0 mb-3">
                        <div class="card shadow-sm border-2 border-danger bg-danger text-white">
                            <div class="card-body">
                                <p class="card-title">Total Keluar</p>
                                <h4 class="card-text">{{ $totalKeluar }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <h4 class="card-title">Daftar Barang</h4>
                <table class="table table-responsive table-bordered mt-4">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Stok Awal</th>
                            <th scope="col">Stok Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->kode_barang }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->stok_awal }}</td>
                                <td class="{{ $item->stok_akhir <= 0 ? 'text-danger' : '' }}">{{ $item->stok_akhir }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="row mt-5">
                    <div class="col-12">
                        <div class="d-flex justify-content-md-between flex-column flex-md-row align-items-md-center mb-3">
                            <h4 class="card-title">Data Transaksi</h4>
                            <a href="{{ route('transaksi.exportExcel') }}" class="btn btn-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-excel" viewBox="0 0 16 16">
                                    <path d="M4 0h5.293a1 1 0 0 1 .707.293l4 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm3.5 1.5a.5.5 0 0 0-.5.5v9.05l-1.875-1.875A.5.5 0 0 0 .875=9H3v3h8v-3h-.875a.5.5 0 0 0-.375.875L9 11.05V2a.5.5 0 0 0-.5-.5h-1zM8 4a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 4zm-2.5.5a.5.5 
0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm5 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"/>
                                </svg> Export Excel
                            </a>
                        </div>
                        <table class="table table-responsive table-bordered">
                            <thead>
                                    <th scope="col">No</th>
                                    <th scope="col">No Transaksi</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->no_transaksi }}</td>
                                        <td>{{ $item->barang->nama_barang }}</td>
                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                        <td>{{ ucwords($item->jenis) }}</td>
                                        <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
