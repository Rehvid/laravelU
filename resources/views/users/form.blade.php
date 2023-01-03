<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Przypisanie zespołu') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="table-view-wrapper" class="bg-white shadow-xl sm:rounded-lg">
                @if (isset($user))
                    <livewire:users.user-form :user="$user" :editMode="true" />
                @endif
            </div>
        </div>
    </div>

</x-app-layout>
