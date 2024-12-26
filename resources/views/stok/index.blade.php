<x-layout>
    <div class="flex">
        <div class="ml-64 w-full bg-gray-50 dark:bg-gray-700 p-6 rounded-md shadow-md">
            <h3 class=" text-center text-xl font-semibold text-gray-800 dark:text-gray-100">Data Produk untuk {{ $branch->alias }}</h3>
                <div class="flex justify-end space-x-4 mb-4">
                    <a href="{{ route('stock.export.pdf', $branch->id_cabang) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Unduh PDF</a>
                    <a href="{{ route('stock.export.excel', $branch->id_cabang) }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Unduh Excel</a>
                </div>
            <div class="overflow-x-auto max-w-full mt-4">
                <table class="table-auto min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                    <thead class="bg-gray-200 dark:bg-gray-900">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-300">No</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-300">Produk</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-300">Kategori</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-300">Stok</th>
                            <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-300">Harga Produk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stocks as $index => $stock)
                            <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                                <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $index + 1 }}</td>
                                <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $stock->produk->nama_produk }}</td>
                                <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $stock->produk->kategori ? $stock->kategori->nama_kategori : 'Kategori tidak tersedia' }}</td>
                                <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $stock->jumlah_stok }}</td>
                                <td class="px-4 py-2 text-gray-700 dark:text-gray-300">Rp {{ number_format($stock->produk->harga_produk, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
