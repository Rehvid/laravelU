<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Zespoły') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8">

            <div id="table-view-wrapper" class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @can('teams.store')
                    <div class="flex justify-end m-4">
                        <x-button primary label="Dodaj Zespół" href="{{ route('team.create') }}"></x-button>
                    </div>
                @endcan
                <livewire:teams.teams-table-view />
            </div>
        </div>
    </div>

</x-app-layout>
