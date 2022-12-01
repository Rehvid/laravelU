<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Status') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="table-view-wrapper" class="bg-white shadow-xl sm:rounded-lg">
                @if (isset($status))
                    <livewire:statuses.status-form :status="$status" :editMode="true" />
                @else
                    <livewire:statuses.status-form :editMode="false" />
                @endif
            </div>
        </div>
    </div>

</x-app-layout>
