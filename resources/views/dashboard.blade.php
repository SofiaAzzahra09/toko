<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg ml-64 p-6">
                <div class="text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    <br>
                    Welcome, {{ auth()->user()->nama_user }}!
                </div>
                    @hasrole('owner')
                        <form method="GET" action="{{ route('dashboard') }}">
                            <label for="id_cabang" class="block text-gray-700 dark:text-gray-300 font-medium">Pilih Cabang:</label>
                            <select name="id_cabang" id="id_cabang" class="block w-full max-w-xs mt-2 p-2 rounded-md border border-gray-300 dark:border-gray-700">
                                <option value="">-- Pilih Cabang --</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id_cabang }}" {{ request('branch_id') == $branch->id_cabang ? 'selected' : '' }}>
                                        {{ $branch->alias }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-md">
                                Tampilkan Statistik
                            </button>
                        </form>

                        @if ($branch)
                            <div class="mt-6">
                                <h3 class="text-lg text-white text-center font-semibold">Statistik Cabang</h3>
                                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">
                                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                                        <h4 class="font-medium text-gray-800 dark:text-gray-200">Total Produk</h4>
                                        <p class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $totalProduk }}</p>
                                    </div>
                                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                                        <h4 class="font-medium text-gray-800 dark:text-gray-200">Total Penjualan</h4>
                                        <p class="text-xl font-bold text-gray-900 dark:text-gray-100">Rp {{ number_format($totalPenjualan, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endhasrole
            </div>
        </div>
    </div>
</x-app-layout>
