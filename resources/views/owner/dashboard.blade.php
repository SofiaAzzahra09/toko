<x-app-layout>
    <x-slot name="header">
        {{-- <x-nav-link :href="route('dashboard', ['branchId' => $branch->id_cabang])">
            {{ __('Dashboard') }}
        </x-nav-link> --}}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg ml-64">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    <br>
                    Anda sedang melihat informasi untuk <strong>{{ $branch->alias }}</strong>.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
