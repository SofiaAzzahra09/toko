<x-layout>
    <div class="flex">
        <div class="ml-64 w-full bg-gray-50 dark:bg-gray-700 p-6 rounded-md shadow-md">
            <h3 class="text-center text-xl font-semibold text-gray-800 dark:text-gray-100">Data Transaksi untuk {{ $branch->alias }}</h3>
                <div class="flex justify-end space-x-4 mb-4">
                <a href="{{ route('transactions.export.pdf', $branch->id_cabang) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Unduh PDF</a>
                <a href="{{ route('transactions.export.excel', $branch->id_cabang) }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Unduh Excel</a>
                </div>

            <div class="overflow-x-auto max-w-full mt-4">
                <table class="table-auto min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                    <thead class="bg-gray-200 dark:bg-gray-900">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-300">No</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-300">Kasir</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-300">Produk</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-300">Kategori</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-300">Harga Satuan</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-300">Jumlah</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-300">Subtotal</th>
                            <!-- <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-300">Total Harga</th> -->
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-300">Tanggal Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $counter = 1; @endphp
                        @foreach ($transactions as $transaction)
                            @foreach ($transaction->transaksiDetail as $detail)
                                <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $counter++ }}</td> 
                                    <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $transaction->kasir->nama_user }}</td>
                                    <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $detail->produk->nama_produk }}</td>
                                    <!-- <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $detail->produk->kategori ? $detail->produk->kategori->id_kategori : 'Kategori tidak tersedia' }}</td> -->
                                    <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $detail->produk->id_kategori}}</td>
                                    <td class="px-4 py-2 text-gray-700 dark:text-gray-300">Rp {{ number_format($detail->harga_satuan, 2) }}</td>
                                    <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $detail->jumlah }}</td>
                                    <td class="px-4 py-2 text-gray-700 dark:text-gray-300">Rp {{ number_format($detail->subtotal, 2) }}</td>
                                    <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $transaction->tanggal_transaksi->format('d-m-Y H:i') }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
