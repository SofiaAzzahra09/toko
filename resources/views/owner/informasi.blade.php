<x-layout>
    <div class="flex">
        <div class="ml-64 w-full bg-gray-50 dark:bg-gray-700 p-6 rounded-md shadow-md">
            <h3 class="text-center text-xl font-semibold text-gray-800 dark:text-gray-100">Data Cabang dan Pengguna</h3>
            
            @foreach ($branches as $branch)
                <div class="mt-6">
                    <div class="mb-4">
                        <h4 class="text-lg font-medium text-gray-800 dark:text-gray-100">{{ $branch->alias }} ({{ $branch->nama_cabang }})</h4>
                        <p class="text-gray-600 dark:text-gray-400">Telepon: {{ $branch->telepon }}</p>
                        <p class="text-gray-600 dark:text-gray-400">Alamat: {{ $branch->alamat }}</p>
                    </div>

                    <div class="overflow-x-auto max-w-full mt-4">
                        <table class="table-auto min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                            <thead class="bg-gray-200 dark:bg-gray-900">
                                <tr>
                                    <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-300">Nama</th>
                                    <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-300">Peran</th>
                                    <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-300">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($branch->usersStore as $user)
                                    <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $user->nama_user }}</td>
                                        <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $user->peran }}</td>
                                        <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $user->email }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
