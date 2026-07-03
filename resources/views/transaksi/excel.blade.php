<table>
    <thead>
        <tr>
            <th style="font-weight: bold; text-align: center;">No</th>
            <th style="font-weight: bold; text-align: center;">No Transaksi</th>
            <th style="font-weight: bold; text-align: center;">Nama Barang</th>
            <th style="font-weight: bold; text-align: center;">Tanggal</th>
            <th style="font-weight: bold; text-align: center;">Jenis</th>
            <th style="font-weight: bold; text-align: center;">Jumlah</th>
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
                <td>{{ $item->jumlah }}</td>
            </tr>
        @endforeach
    </tbody>
</table>