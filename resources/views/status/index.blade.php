<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Statusy') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-button primary label="Dodaj status" href="{{ route('status.create') }}"></x-button>
            <div id="table-view-wrapper" class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <livewire:statuses.statuses-table-view />
            </div>
        </div>
    </div>

</x-app-layout>
