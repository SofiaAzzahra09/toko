<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h2 class="text-center">Data Transaksi untuk {{ $branch->alias }}</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kasir</th>
                <th>Produk</th>
                <th>Kategori</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @php $counter = 1; @endphp
            @foreach ($transactions as $transaction)
                @foreach ($transaction->transaksiDetail as $detail)
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td>{{ $transaction->kasir->nama_user }}</td>
                        <td>{{ $detail->produk->nama_produk }}</td>
                        <td>{{ $detail->produk->id_kategori }}</td>
                        <td>Rp {{ number_format($detail->harga_satuan, 2) }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td>Rp {{ number_format($detail->subtotal, 2) }}</td>
                        <td>{{ $transaction->tanggal_transaksi->format('d-m-Y H:i') }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>
